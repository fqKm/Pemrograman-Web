<?php

namespace Database\Seeders;

use App\Models\Pemesanan;
use App\Models\Member;
use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PemesananSeeder extends Seeder
{
    public function run(): void
    {
        $members = Member::take(3)->get();
        $kelas = Kelas::take(2)->get();

        $dataPemesanan = [
            [
                'member_id' => $members[0]->member_id,
                'kelas_id' => $kelas[0]->kelas_id,
                'pembayaran_id' => null,
                'tanggal_pemesanan'=> Carbon::now()->subDays(2)->toDateString(),
                'status' => 'proses'
            ],
            [
                'member_id' => $members[1]->member_id,
                'kelas_id' => $kelas[1]->kelas_id,
                'pembayaran_id' => null,
                'tanggal_pemesanan'=> Carbon::now()->addDays(1)->toDateString(),
                'status' => 'proses'
            ],
            [
                'member_id' => $members[2]->member_id,
                'kelas_id' => $kelas[0]->kelas_id,
                'pembayaran_id' => null,
                'tanggal_pemesanan'=> Carbon::now()->toDateString(),
                'status' => 'dibatalkan'
            ]
        ];

        foreach ($dataPemesanan as $pemesanan) {
            Pemesanan::create($pemesanan);
        }
    }
}
