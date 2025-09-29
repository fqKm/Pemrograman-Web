<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
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
        'status'
    ];
}
