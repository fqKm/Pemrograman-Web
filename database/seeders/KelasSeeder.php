<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan tabel 'pelatih' sudah memiliki data id_pelatih yang dirujuk (mis. 1..3)
        Kelas::create([
            'pelatih_id' => 1,
            'nama_kelas' => 'Strength Basics',
            'waktu_mulai' => '07:00:00',
            'waktu_selesai' => '08:00:00',
            'kapasitas_maksimum' => 20,
            'deskripsi' => 'Kelas dasar kekuatan.',
        ]);

        Kelas::create([
            'pelatih_id' => 2,
            'nama_kelas' => 'Yoga Flow',
            'waktu_mulai' => '09:00:00',
            'waktu_selesai' => '10:00:00',
            'kapasitas_maksimum' => 15,
            'deskripsi' => 'Vinyasa yoga untuk semua level.',
        ]);
        
        Kelas::create([
            'pelatih_id' => 3,
            'nama_kelas' => 'HIIT Express',
            'waktu_mulai' => '17:30:00',
            'waktu_selesai' => '18:15:00',
            'kapasitas_maksimum' => 25,
            'deskripsi' => 'Latihan interval intensitas tinggi 45 menit.',
        ]);
    }
}
