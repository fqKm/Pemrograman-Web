<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'kelas_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_pelatih',
        'class_name',
        'start_time',
        'end_time',
        'max_capacity',
        'description',
    ];
    public $timestamps = true;

    // Relasi: Kelas dimiliki oleh satu Pelatih
    public function pelatih()
    {
        return $this->belongsTo(Pelatih::class, 'id_pelatih', 'id');
    }
}
