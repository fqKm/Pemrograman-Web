<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelatih extends Model
{
    protected $table = 'pelatih';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'nama_pelatih',
        'spesialisasi',
        'tanggal_masuk'];
    public $timestamps = true;
        
    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class, 'pelatih_id');
    }

}
