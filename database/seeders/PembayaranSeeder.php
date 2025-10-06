<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Member;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $member = Member::first();

        if ($member) {
            $pembayaran = Pembayaran::create([
                'member_id' => $member->id,      // ganti member_id
                'jumlah' => 150000,
                'metode_pembayaran' => 'tunai',
                'waktu_pembayaran' => Carbon::now()
            ]);

            $pemesanan = Pemesanan::where('member_id', $member->id)
                ->where('status', 'proses')
                ->first();

            if ($pemesanan) {
                $pemesanan->update([
                    'pembayaran_id' => $pembayaran->id,
                    'status' => 'terkonfirmasi'
                ]);
            }
        }
    }
}
