<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan tabel 'pelatih' sudah memiliki data id_pelatih yang dirujuk (mis. 1..3)
        DB::table('kelas')->insert([
            [
                'trainer_id'   => 1,
                'class_name'   => 'Strength Basics',
                'start_time'   => '07:00:00',
                'end_time'     => '08:00:00',
                'max_capacity' => 20,
                'description'  => 'Kelas dasar kekuatan.',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'trainer_id'   => 2,
                'class_name'   => 'Yoga Flow',
                'start_time'   => '09:00:00',
                'end_time'     => '10:00:00',
                'max_capacity' => 15,
                'description'  => 'Vinyasa yoga untuk semua level.',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'trainer_id'   => 3,
                'class_name'   => 'HIIT Express',
                'start_time'   => '17:30:00',
                'end_time'     => '18:15:00',
                'max_capacity' => 25,
                'description'  => 'Latihan interval intensitas tinggi 45 menit.',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
