<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'nama',
        'nomor_hp',
        'email',
        'tanggal_lahir',
        'tanggal_bergabung',
        'status',
        'membership_id'
    ];

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }

    public function kemajuan()
    {
        return $this->hasMany(Kemajuan::class, 'member_id');
    }
}
