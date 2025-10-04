<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'System Administrator',
                'description' => 'Mengelola semua system',
                'is_active' => true
            ],
            [
                'name' => 'member',
                'display_name' => 'Member',
                'description' => 'Member Gym',
                'is_active' => true
            ],
            [
                'name' => 'pelatih',
                'display_name' => 'Trainer',
                'description' => 'Pelatih Gym',
                'is_active' => true
            ]
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
