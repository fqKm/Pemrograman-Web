<?php

namespace Database\Seeders;

use App\Models\Pemesanan;
use App\Models\Member;
use App\Models\Kelas;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PemesananSeeder extends Seeder
{
    public function run(): void
    {
        $member = Member::first();
        $kelas = Kelas::first();

        Pemesanan::create([
            'member_id' => $member->id,
            'kelas_id' => $kelas->id,
            'pembayaran_id' => null,
            'tanggal_pemesanan'=> Carbon::now()->toDateString(),
            'status' => 'proses'
        ]);
    }
}
