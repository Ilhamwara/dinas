<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class Kegiatan extends Model
{
    //
    protected $table = 'kegiatan';
    protected $primaryKey = 'kegiatan_id';
    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('kegiatan')->encode($this->attributes['kegiatan_id']);
    }

    public function st()
    {
    	return $this->hasMany('\App\SuratTugas', 'id_kegiatan', 'kegiatan_id');
    }

    public function tujuandinas()
    {
    	return $this->belongsTo('\App\TujuanDinas', 'tujuan_id');
    }
}
