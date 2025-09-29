<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = Member::take(3)->get();

        $dataPembayaran = [
            [
                'member_id' => $members[0]->member_id,
                'jumlah' => 150000,
                'metode_pembayaran' => 'tunai',
                'waktu_pembayaran' => Carbon::now()->subDays(1)
            ],
            [
                'member_id' => $members[1]->member_id,
                'jumlah' => 200000,
                'metode_pembayaran' => 'transfer',
                'waktu_pembayaran' => Carbon::now()
            ]
        ];

        foreach ($dataPembayaran as $data){
            $pembayaran = Pembayaran::create($data);

            $pemesanan = Pemesanan::where('member_id', $data['member_id'])->where('status', 'proses')->first();
            if($pemesanan){
                $pemesanan->update([
                    'pembayaran_id' => $pembayaran->pembayaran_id,
                    'status' => 'terkonfirmasi'
                ]);
            }
        }
    }
}
