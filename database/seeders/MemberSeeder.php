<?php

namespace Database\Seeders;

use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::create([
            'nama' => 'John Doe',
            'user_id' => 2,
            'nomor_hp' => '0812345678',
            'email' => 'example@gmail.com',
            'tanggal_lahir' => Carbon::create('2000', '10', '31'),
            'tanggal_bergabung' => now(),
            'membership_id' =>  1,
        ]);
    }
}
