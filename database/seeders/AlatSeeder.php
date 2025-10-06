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
                'tanggal_pembelian' => '2023-01-10',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_alat' => 'Treadmill',
                'tipe' => 'Kardio',
                'status' => 'Aktif',
                'tanggal_pembelian' => '2022-11-05',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_alat' => 'Bench Press Rack',
                'tipe' => 'Kekuatan',
                'status' => 'Dalam Perbaikan',
                'tanggal_pembelian' => '2022-08-20',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($alat as $data_alat){
            Alat::create($data_alat);
        };
    }
}
