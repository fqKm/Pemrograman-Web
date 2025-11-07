<?php

namespace App\Models;

use Carbon\CarbonInterval;
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

//    public function members(): HasMany
//    {
//        return $this->hasMany(Member::class);
//    }

    public function langganan()
    {
        return $this->hasMany(Langganan::class, 'membership_id', 'id');
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'langganan', 'membership_id', 'member_id')
            ->withPivot(['tanggal_bergabung', 'tanggal_berakhir'])
            ->withTimestamps();
    }



    public function getFormattedDurationAttribute()
    {
        $milliseconds = $this->attributes['durasi'];

        if (is_null($milliseconds) || !is_numeric($milliseconds)) {
            return 'N/A';
        }

        $interval = CarbonInterval::milliseconds($milliseconds);

        $interval->cascade();

        // 4. Ubah jadi format manusia
        //    Pilih salah satu:
        //    return $interval->forHumans(); // Hasil: "1 hari", "2 bulan", "5 jam"
        return $interval->forHumans(['short' => false]); // Hasil: "1h", "2bln", "5j"
    }
}
