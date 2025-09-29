<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kemajuan extends Model
{
    use HasFactory;

    protected $table = 'kemajuan';
    protected $primaryKey = 'id';


    protected $fillable = [
        'members_id',
        'nama_latihan',
        'tanggal_workout',
        'jumlah_set',
        'jumlah_repetisi',
        'beban',
        'durasi',
        'catatan'
    ];

    public function alat()
    {
        return $this->belongsToMany(
            Alat::class,
            'kemajuan_alat',
            'kemajuan_id',
            'alat_id'
        );
    }
}
