<?php

namespace Database\Seeders;

use App\Models\Alat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alat = [
            [
                'nama_alat' => 'Dumbell 10kg',
                'tipe' => 'Beban',
                'status' => 'Aktif',
                'tanggal_pembelian' => '10-01-2023',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_alat' => 'Treadmill',
                'tipe' => 'Kardio',
                'status' => 'Aktif',
                'tanggal_pembelian' => '05-11-2022',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_alat' => 'Bench Press Rack',
                'tipe' => 'Kekuatan',
                'status' => 'Dalam Perbaikan',
                'tanggal_pembelian' => '20-08-2022',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        Alat::create($alat);
    }
}
