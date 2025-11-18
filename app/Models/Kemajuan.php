<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kemajuan extends Model
{
    use HasFactory;

    protected $table = 'kemajuan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'kelas_id',
        'alat_id',
        'nama_latihan',
        'jumlah_set',
        'jumlah_repetisi',
        'deskripsi'
    ];

    public function alat() : BelongsTo
    {
        return $this->belongsTo(
            Alat::class,
            'alat_id',
            'id',
        );
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
}
