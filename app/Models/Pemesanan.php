<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Kelas;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'pemesanan_id';
    protected $keyType = 'int';
    public $incrementing = 'true';
    public $timestamps = 'true';
    protected $fillable = ['pembayaran_id', 'member_id', 'kelas_id', 'tanggal_pemesanan', 'status'];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
