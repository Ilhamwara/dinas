<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nominatif extends Model
{
    //
    protected $table = 'nominatif';

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('nominatif')->encode($this->attributes['id']);
    }

    public function st()
    {
    	return $this->belongsTo('\App\SuratTugas', 'st_id');
    }

    public function pegawai()
    {
    	return $this->belongsTo('\App\Pegawai', 'pegawai_id');
    }
}
