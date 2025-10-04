<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PelatihSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelatih')->insert([
            [
                'nama_pelatih'  => 'Andi Pratama',
                'spesialisasi'  => 'Strength & Conditioning',
                'tanggal_masuk' => Carbon::parse('2023-01-15'),
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nama_pelatih'  => 'Bunga Wulandari',
                'spesialisasi'  => 'Yoga',
                'tanggal_masuk' => Carbon::parse('2023-05-10'),
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nama_pelatih'  => 'Candra Wijaya',
                'spesialisasi'  => 'HIIT',
                'tanggal_masuk' => Carbon::parse('2024-02-01'),
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nama_pelatih'  => 'Dewi Lestari',
                'spesialisasi'  => 'Pilates',
                'tanggal_masuk' => Carbon::parse('2024-07-20'),
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nama_pelatih'  => 'Eko Saputra',
                'spesialisasi'  => 'Functional Training',
                'tanggal_masuk' => Carbon::parse('2025-01-05'),
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
