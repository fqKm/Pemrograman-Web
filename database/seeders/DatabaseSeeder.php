<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            PelatihSeeder::class,
            KelasSeeder::class,
            MembershipSeeder::class,
            MemberSeeder::class,
            AlatSeeder::class,
            KemajuanSeeder::class,
            PemesananSeeder::class,
            PembayaranSeeder::class,
            LanggananSeeder::class,
            KelasMemberSeeder::class,
            KemajuanMemberSeeder::class,
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
