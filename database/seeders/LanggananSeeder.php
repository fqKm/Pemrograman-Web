<?php

namespace Database\Seeders;

use App\Models\Langganan;
use App\Models\Membership;
use App\Models\Member;
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
        $member = Member::first();
        if ($member && $membership) {
            Langganan::create([
                'tanggal_bergabung' => now(),
                'tanggal_berakhir' => now()->addMilliseconds($membership->durasi),
                'pembayaran_id' => 1,
                'membership_id' => $membership->id,
                'member_id' => $member->id, // <- ini wajib
            ]);
        }
    }
}