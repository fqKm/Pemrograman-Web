<?php

namespace Database\Seeders;

use App\Models\Membership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Membership::create([
            'harga' => 150000.00,
            'durasi' => 30,
            'nama_plan' => 'Diamond',
            'deskripsi' => 'Diamond',
        ]);

        Membership::create([
            'harga' => 100000.00,
            'durasi' => 14,
            'nama_plan' => 'Platinum',
            'deskripsi' => 'Platinum',
        ]);

        Membership::create([
            'harga' => 50000.00,
            'durasi' => 7,
            'nama_plan' => 'Bronze',
            'deskripsi' => 'Bronze',
        ]);
    }
}
