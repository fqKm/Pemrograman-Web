<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
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
// Cari user yang dibuat di UserSeeder (email: membergym@gym.com)
        $userMember = User::where('email', 'membergym@gym.com')->first();

        // Pastikan user ditemukan sebelum membuat data member
        if ($userMember) {
            Member::create([
                'user_id' => $userMember->id, // Ambil ID secara dinamis
                'nama' => $userMember->name,  // Samakan nama dengan data User
                'nomor_hp' => $userMember->phone, // Samakan no hp
                'email' => $userMember->email,
                'tanggal_lahir' => Carbon::create('2000', '10', '31'),
                'tanggal_bergabung' => now(),
                'status' => 'aktif',
                'membership_id' => 1, // Pastikan Membership ID 1 sudah ada di MembershipSeeder
            ]);
        }
    }
}