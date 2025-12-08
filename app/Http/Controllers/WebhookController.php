<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Member; // Tambahkan Model Member
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handlePayment(Request $request)
    {
        // 1. Log data yang masuk (Penting untuk debugging)
        Log::info('Webhook received', $request->all());

        // 2. Verifikasi Signature (Keamanan)
        // Pastikan Anda sudah menambahkan 'webhook_secret' di config/services.php dan .env
        $signature = $request->header('X-Webhook-Signature');
        $webhookSecret = config('services.payment.webhook_secret');

        if ($webhookSecret) {
            $payload = $request->all();
            $expectedSignature = hash_hmac('sha256', json_encode($payload), $webhookSecret);

            if (!hash_equals($expectedSignature, $signature)) {
                Log::warning('Invalid webhook signature');
                return response()->json(['error' => 'Invalid signature'], 401);
            }
        }

        // 3. Ambil data event
        $event = $request->input('event'); // Contoh: payment.success
        $data = $request->input('data');
        $externalId = $data['external_id'] ?? $data['order_id'] ?? null;

        // Cari Order berdasarkan order_number
        $order = Order::where('order_number', $externalId)->first();

        if (!$order) {
            Log::warning('Order not found via Webhook', ['external_id' => $externalId]);
            return response()->json(['error' => 'Order not found'], 404);
        }

        // 4. Handle Status Sukses
        if ($event === 'payment.success' || $data['status'] === 'PAID') {
            
            // Cek jika sudah dibayar sebelumnya agar tidak diproses ganda
            if ($order->payment_status === 'paid') {
                return response()->json(['message' => 'Already processed'], 200);
            }

            // Update Status Order
            $order->update([
                'payment_status' => 'paid',
                'paid_at' => now(),
            ]);

            // --- LOGIKA UTAMA: Pisahkan Membership vs Produk ---
            
            // KASUS A: Jika ini Membership
            if ($order->membership_id) {
                $member = Member::where('user_id', $order->user_id)->first();
                if ($member) {
                    $member->update([
                        'status' => 'aktif',
                        'membership_id' => $order->membership_id,
                        'tanggal_bergabung' => now(),
                    ]);
                    Log::info('Member activated via Webhook', ['member_id' => $member->id]);
                }
            } 

            return response()->json(['message' => 'Payment success processed'], 200);
        }

        // 5. Handle Status Gagal / Expired
        if ($event === 'payment.failed' || $data['status'] === 'FAILED') {
            $order->update(['payment_status' => 'failed']);
            Log::info('Payment failed', ['order_id' => $order->id]);
            return response()->json(['message' => 'Processed as failed'], 200);
        }

        if ($event === 'payment.expired' || $data['status'] === 'EXPIRED') {
            $order->update(['payment_status' => 'expired']);
            Log::info('Payment expired', ['order_id' => $order->id]);
            return response()->json(['message' => 'Processed as expired'], 200);
        }

        return response()->json(['message' => 'Event not handled'], 200);
    }
}