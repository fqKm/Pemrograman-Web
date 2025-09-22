<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $timestamps = true;
    public $incrementing = true;
    public $fillable = [
        'nama',
        'nomor_hp',
        'email',
        'tanggal_lahir',
        'tanggal_bergabung',
        'langganan_id',
        'status'
    ];
    public function langganan()
    {
        return $this->belongsTo(Langganan::class, 'langganan_id', 'id');
    }
}
