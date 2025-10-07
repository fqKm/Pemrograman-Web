<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Member;
use App\Models\Pembayaran;
use App\Models\Kelas;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'pembayaran_id',
        'member_id',
        'kelas_id',
        'tanggal_pemesanan',
        'status'
    ];
    protected $casts = [
        'tanggal_pemesanan' => 'date',
    ];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
