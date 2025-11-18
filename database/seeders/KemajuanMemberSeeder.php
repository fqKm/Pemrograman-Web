<?php

namespace Database\Seeders;

use App\Models\KemajuanMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KemajuanMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kemajuan_member1 = KemajuanMember::create([
            'kemajuan_id' => 1,
            'member_id' => 1,
            'is_done' => false,
            'deskripsi' => 'Kemajuan member 1',
            'completed_at' => null,
        ]);
    }
}
