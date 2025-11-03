<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Membership;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function confirm(Kelas $product)
    {
        if ($product->stock <= 0) {
            return redirect()->route('customer.products.index')
                ->with('error', 'Produk tidak tersedia.');
        }

        return view('orders.confirm', compact('product'));
    }

    public function process(Kelas $product)
    {
        if ($product->stock <= 0) {
            return redirect()->route('customer.products.index')
                ->with('error', 'Produk tidak tersedia.');
        }

        $expiredHours = (int) config('services.payment.expired_hours', 24);

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'quantity' => 1,
            'price' => $product->price,
            'total_amount' => $product->price,
            'payment_status' => 'pending',
            'expired_at' => now()->addHours($expiredHours),
        ]);

        // Create Virtual Account via Payment Gateway API
        try {
            $response = Http::withHeaders([
                'X-API-Key' => config('services.payment.api_key'),
                'Accept' => 'application/json',
            ])->post(config('services.payment.base_url') . '/virtual-account/create', [
                'external_id' => $order->order_number,
                'amount' => $order->total_amount,
                'customer_name' => auth()->user()->name,
                'customer_email' => auth()->user()->email,
                'customer_phone' => auth()->user()->phone ?? '081234567890',
                'description' => 'Pembayaran ' . $product->name,
                'expired_duration' => $expiredHours,
                'callback_url' => route('orders.success', $order),
                'metadata' => [
                    'product_id' => $product->id,
                    'user_id' => auth()->id(),
                ],
            ]);

            if ($response->successful()) {
                $data = $response->json();

                $order->update([
                    'va_number' => $data['data']['va_number'],
                    'payment_url' => $data['data']['payment_url'],
                ]);

                return redirect()->route('orders.waiting', $order);
            } else {
                $order->update(['payment_status' => 'failed']);
                return redirect()->route('customer.products.index')
                    ->with('error', 'Gagal membuat pembayaran. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            $order->update(['payment_status' => 'failed']);
            return redirect()->route('customer.products.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function waiting(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->isPaid()) {
            return redirect()->route('orders.success', $order);
        }

        if ($order->isExpired()) {
            return redirect()->route('customer.products.index')
                ->with('error', 'Pembayaran telah expired.');
        }

        return view('orders.waiting', compact('order'));
    }

    public function checkStatus(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return response()->json([
            'status' => $order->payment_status,
            'paid_at' => $order->paid_at?->toISOString(),
        ]);
    }

    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if (!$order->isPaid()) {
            return redirect()->route('orders.waiting', $order);
        }

        return view('orders.success', compact('order'));
    }
}
