<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Membership extends Model
{
    protected $table = 'membership';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'harga',
        'durasi',
        'nama_plan',
        'deskripsi',
    ];

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }
}
