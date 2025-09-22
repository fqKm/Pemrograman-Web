<?php

namespace Database\Seeders;

use App\Models\Langganan;
use App\Models\Membership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanggananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $membership = Membership::find(1);
        Langganan::create([
            'tanggal_bergabung' => now(),
            'tanggal_berakhir' => now()->addMilliseconds($membership->durasi),
            'pembayaran_id' => 1,
            'membership_id' => $membership->id,
        ]);
    }
}
