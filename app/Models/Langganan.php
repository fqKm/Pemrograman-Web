<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Langganan extends Model
{
    protected $table = 'langganan';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'tanggal_bergabung',
        'tanggal_berakhir',
        'pembayaran_id',
        'membership_id',
        'member_id'
    ];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id', 'id');

    }
    public function membership()
    {
        return $this->belongsTo(Membership::class, 'membership_id', 'id');

    }

    public function members()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
