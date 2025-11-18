<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KemajuanMember extends Model
{
    use HasFactory;

    protected $table = 'kemajuan_member';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'kemajuan_id',
        'member_id',
        'is_done',
        'deskripsi',
        'completed_at'
    ];

    public function kemajuan() :BelongsTo{
        return $this->belongsTo(Kemajuan::class, 'kemajuan_id', 'id');
    }
    public function member() :BelongsTo{
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
