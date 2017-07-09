<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class Rincian extends Model
{
    //
    protected $table = 'rincian';
    protected $fillable = ['surat_tugas_id','spd_id','pegawai_id','tujuan_id','ref_id','pagu_id','ref_max','qty','sub','keterangan','created_at','updated_at'];
    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('spd')->encode($this->attributes['spd_id']);
    }

    public function spd()
    {
    	return $this->belongsTo('App\SuratPerjadin', 'spd_id');
    }
}
