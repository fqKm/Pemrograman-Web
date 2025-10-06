<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alat';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_alat',
        'tipe',
        'status',
        'tanggal_pembelian',
        'tanggal_perawatan_terakhir',
    ];

    public function kemajuan()
    {
        return $this->belongsToMany(
            Kemajuan::class,
            'kemajuan_alat',
            'alat_id',
            'kemajuan_id'
        );
    }
}
