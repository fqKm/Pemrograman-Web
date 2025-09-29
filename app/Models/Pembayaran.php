<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pemesanan;
use App\Models\User;
use App\Models\Langganan;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = 'true';
    public $timestamps = 'true';

    protected $fillable = [
        'members_id',
        'jumlah',
        'metode_pembayaran',
        'waktu_pembayaran'
    ];
    protected $casts = [
        'jumlah' => 'decimal:2',
        'waktu_pembayaran' => 'datetime'
    ];

    public function pemesanan()
    {
        return $this->hasOne(Pemesanan::class, 'pembayaran_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'members_id', 'id');
    }

    public function langganan()
    {
        return $this->hasOne(Langganan::class, 'pembayaran_id');
    }
}
