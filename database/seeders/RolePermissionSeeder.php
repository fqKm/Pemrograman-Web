<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
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

        // Permission untuk Admin
        $allPermissions = Permission::all();
        $adminRole->permissions()->attach($allPermissions);

        // Permission untuk Member
        $memberPermissions = Permission::whereIn('name', [
            'lihat_kelas',
            'lihat_daftar_membership',
            'lihat_progress',
            'lihat_akun_member',
            'ubah_akun_member',
            'hapus_akun_member',
            'lihat_alat',
            'lihat_status_pembayaran',
        ])->get();
        $memberRole->permissions()->attach($memberPermissions);

        // Permission untuk Pelatih
        $pelatihPermissions = Permission::whereIn('name', [
            'lihat_kelas',
            'request_kelas',
            'lihat_member_kelas',
            'lihat_progress',
            'ubah_progress',
            'buat_progress',
            'lihat_alat',
            'lihat_akun_pelatih',
            'ubah_akun_pelatih',
        ])->get();
        $pelatihRole->permissions()->attach($pelatihPermissions);
    }
}
