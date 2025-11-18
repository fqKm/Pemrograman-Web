<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Alat;
use App\Models\Kemajuan;
use Illuminate\Database\Seeder;

class KemajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kemajuan1 = Kemajuan::create([
            'kelas_id' => 1,
            'alat_id' => 1,
            'nama_latihan' => 'Dumbell Press',
            'jumlah_set' => 1,
            'jumlah_repetisi' => 2,
            'deskripsi' => 'Dumbell Press Deskripsi',
        ]);

//        $benchRack = Alat::where('nama_alat', 'Bench Press Rack')->first();
//        if ($benchRack) {
//            $kemajuan1->Alat()->attach($benchRack->alat_id);
//        }

//        $kemajuan2 = Kemajuan::create([
//            'member_id' => 1,
//            'nama_latihan' => 'Lari Pagi',
//            'tanggal_workout' => '2025-09-21',
//            'jumlah_set' => 1,
//            'jumlah_repetisi' => 1,
//            'beban' => 0,
//            'durasi' => 45,
//        ]);

//        $treadmill = Alat::where('nama_alat', 'Treadmill')->first();
//        if ($treadmill) {
//            $kemajuan2->Alat()->attach($treadmill->alat_id);
//        }

    }
}
