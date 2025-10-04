<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'pelatih_id',
        'nama_kelas',
        'waktu_mulai',
        'waktu_selesai',
        'kapasitas_maksimum',
        'deskripsi',
    ];
    public $timestamps = true;

    // Relasi: Kelas dimiliki oleh satu Pelatih
    public function pelatih()
    {
        return $this->belongsTo(Pelatih::class, 'pelatih_id', 'id');
    }
}
