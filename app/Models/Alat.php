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
        'id',
        'nama_alat',
        'jumlah',
        'terpakai',
        'tanggal_pembelian'
    ];
}
