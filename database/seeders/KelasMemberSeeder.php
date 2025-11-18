<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $member = Member::find(1);
        $kelas = Kelas::first();
        $member->kelas()->attach($kelas);
    }
}
