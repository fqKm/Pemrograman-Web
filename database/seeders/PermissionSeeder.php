<?php

namespace Database\Seeders;

use App\Models\Permission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Kelas
            ['name' => 'request_kelas', 'display_name' => 'Request Pembuatan Kelas', 'group' => 'kelas'],
            ['name' => 'lihat_kelas', 'display_name' => 'Lihat Daftar Kelas', 'group' => 'kelas'],
            ['name' => 'lihat_member_kelas', 'display_name' => 'Melihat Daftar Member Kelas', 'group' => 'kelas'],
            ['name' => 'buat_kelas', 'display_name' => 'Buat Kelas', 'group' => 'kelas'],
            ['name' => 'ubah_kelas', 'display_name' => 'Ubah Kelas', 'group' => 'kelas'],
            ['name' => 'hapus_kelas', 'display_name' => 'Hapus Kelas', 'group' => 'kelas'],

            // Membership
            ['name' => 'lihat_daftar_membership', 'display_name' => 'Melihat Daftar Membership', 'group' => 'membership'],
            ['name' => 'lihat_member_membership', 'display_name' => 'Melihat Member Membership', 'group' => 'membership'],
            ['name' => 'tambah_membership', 'display_name' => 'Menambah Membership', 'group' => 'membership'],
            ['name' => 'ubah_membership', 'display_name' => 'Mengubah Membership', 'group' => 'membership'],
            ['name' => 'hapus_membership', 'display_name' => 'Menghapus Membership', 'group' => 'membership'],

            // Progress Latihan
            ['name' => 'buat_progress', 'display_name' => 'Membuat Progress Latihan', 'group' => 'progress'],
            ['name' => 'lihat_progress', 'display_name' => 'Melihat Progress Latihan', 'group' => 'progress'],
            ['name' => 'ubah_progress', 'display_name' => 'Mengubah Progress Latihan', 'group' => 'progress'],
            ['name' => 'hapus_progress', 'display_name' => 'Menghapus Progress Latihan', 'group' => 'progress'],
            ['name' => 'nilai_progress_member', 'display_name' => 'Menilai Progress Member', 'group' => 'progress'],

            // Inventaris
            ['name' => 'lihat_alat', 'display_name' => 'Melihat Alat Inventaris Gym', 'group' => 'alat'],
            ['name' => 'ubah_alat', 'display_name' => 'Mengubah Alat Inventaris Gym', 'group' => 'alat'],
            ['name' => 'hapus_alat', 'display_name' => 'Menghapus Alat Inventaris Gym', 'group' => 'alat'],
            ['name' => 'tambah_alat', 'display_name' => 'Menambah Alat Inventaris Gym', 'group' => 'alat'],

            // Akun member
            ['name' => 'lihat_akun_member', 'display_name' => 'Melihat Akun Member', 'group' => 'member'],
            ['name' => 'ubah_akun_member', 'display_name' => 'Mengubah Akun Member', 'group' => 'member'],
            ['name' => 'hapus_akun_member', 'display_name' => 'Menghapus Akun Member', 'group' => 'member'],

            // Akun pelatih
            ['name' => 'lihat_akun_pelatih', 'display_name' => 'Melihat Akun Pelatih', 'group' => 'pelatih'],
            ['name' => 'ubah_akun_pelatih', 'display_name' => 'Mengubah Akun Pelatih', 'group' => 'pelatih'],
            ['name' => 'hapus_akun_pelatih', 'display_name' => 'Menghapus Akun Pelatih', 'group' => 'pelatih'],
            ['name' => 'tambah_akun_pelatih', 'display_name' => 'Menambah Akun Pelatih', 'group' => 'pelatih'],

            // Pembayaran
            ['name' => 'lihat_status_pembayaran', 'display_name' => 'Melihat Status Pembayaran', 'group' => 'pembayaran'],
        ];

         foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
