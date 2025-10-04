<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $permission = [
                ['name' => 'request_kelas', 'display_name' => 'Request Pembuatan Kelas', 'group' => 'kelas'],
                ['name' => 'buat_kelas', 'display_name' => 'Buat Kelas', 'group' => 'kelas'],
                ['name' => 'ubah_kelas', 'display_name' => 'Ubah Kelas', 'group' => 'kelas'],
                ['name' => 'hapus_kelas', 'display_name' => 'Hapus Kelas', 'group' => 'kelas'],
                ['name' => 'lihat_kelas', 'display_name' => 'Lihat Daftar Kelas', 'group' => 'kelas'],
                ['name' => 'lihat_member', 'display_name' => 'Lihat Daftar Member Kelas', 'group' => 'kelas'],
                // Membership
                ['name'=> 'tambah_membership', 'display_name' => 'Menambah Membership', 'group' => 'membership'],
                ['name' => 'lihat_daftar_membership', 'display_name' => 'Melihat Daftar Membership', 'group' => 'membership'],
                ['name' => 'lihat_member', 'display_name' => 'Melihat Member Membership', 'group' => 'membership'],
                // Progress Latihan
                ['name' => 'buat_progress', 'display_name' => 'Membuat Progress Latihan', 'group' => 'progress'],
                ['name' => 'lihat_progress', 'display_name' => 'Melihat Progress Latihan', 'group' => 'progress'],
                ['name' => 'view_own_bookings', 'display_name' => 'View Own Bookings', 'group' => 'progress'],
                ['name' => 'cancel_booking', 'display_name' => 'Cancel Booking', 'group' => 'booking'],
                // Check-in/Check-out
                ['name' => 'process_checkin', 'display_name' => 'Process Check-in', 'group' => 'operation'],
                ['name' => 'process_checkout', 'display_name' => 'Process Check-out', 'group' => 'operation'],
                // Payment & Reports
                ['name' => 'handle_payments', 'display_name' => 'Handle Payments', 'group' => 'payment'],
                ['name' => 'view_reports', 'display_name' => 'View Reports', 'group' => 'report'],
            ];
    }
}
