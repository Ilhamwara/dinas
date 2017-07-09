<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class Pegawai extends Model
{
    //
    protected $table = 'pegawai';
    protected $primaryKey = 'pegawai_id';

	protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('pg')->encode($this->attributes['pegawai_id']);
    }


    public function detail_st()
    {
    	return $this->hasMany('\App\DetailSuratTugas', 'pegawai_id');
    }

    public function user()
    {
        return $this->hasOne('\App\User', 'pegawai_id');
    }
}
