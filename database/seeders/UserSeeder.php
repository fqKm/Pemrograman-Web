<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
 use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Ambil role
        $adminRole = Role::where('name', 'admin')->first();
        $memberRole = Role::where('name', 'member')->first();
        $pelatihRole = Role::where('name', 'pelatih')->first();

        // Buat Admin
        User::create([
            'name' => 'Admin Gym',
            'email' => 'admingym@mail.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567890',
            'role_id' => $adminRole->id,
        ]);

        // Buat Member
        User::create([
            'name' => 'Member Gym',
            'email' => 'membergym@gym.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567891',
            'role_id' => $memberRole->id,
        ]);

        // Buat Pelatih
        User::create([
            'name' => 'Pelatih Gym',
            'email' => 'pelatihgym@gym.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567892',
            'role_id' => $pelatihRole->id,
        ]);
    }
}
