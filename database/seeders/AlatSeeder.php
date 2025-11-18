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
                'jumlah' => 10,
                'terpakai' => 0,
                'nama_alat' => 'Dumbell 10kg',
                'tanggal_pembelian' => '2023-01-10',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($alat as $data_alat){
            Alat::create($data_alat);
        };
    }
}
