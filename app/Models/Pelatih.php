<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelatih extends Model
{
    protected $table = 'pelatih';
    protected $primaryKey = 'id_pelatih';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['nama_pelatih', 'spesialisasi', 'tanggal_masuk'];
    public $timestamps = true;
}
