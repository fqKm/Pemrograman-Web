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

    public function confirm(Membership $membership)
    {
        return view('orders.confirm', compact('membership'));
    }

public function process(Membership $membership)
    {
        $user = Auth::user();
        $expiredHours = 24;

        // Buat Order
        $order = Order::create([
            'user_id' => $user->id,
            'membership_id' => $membership->id, // Pastikan kolom ini ada di tabel orders
            'order_number' => 'MEM-' . strtoupper(Str::random(10)),
            'quantity' => 1,
            'price' => $membership->harga,
            'total_amount' => $membership->harga,
            'payment_status' => 'pending',
            'expired_at' => now()->addHours($expiredHours),
        ]);

        // Integrasi Payment Gateway (Contoh Logika)
        // ... (Logika request HTTP ke Payment Gateway sama seperti sebelumnya) ...
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
                'description' => 'Tiket Kelas: ' . $kelas->nama_kelas, // Gunakan nama_kelas
                'expired_duration' => $expiredHours,
                'callback_url' => route('orders.success', $order),
                'metadata' => [
                    'kelas_id' => $kelas->id,
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
                return redirect()->route('member.dashboard')
                    ->with('error', 'Gagal membuat pembayaran.');
            }
        } catch (\Exception $e) {
            $order->update(['payment_status' => 'failed']);
            return redirect()->route('member.dashboard')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        // Untuk simulasi redirect langsung ke waiting
        return redirect()->route('orders.waiting', $order);
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
