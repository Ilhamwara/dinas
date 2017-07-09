<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;
use App\Laporan;

class SuratTugas extends Model
{
    //
    protected $table = 'surat_tugas';
    protected $primaryKey = 'st_id';
    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('st')->encode($this->attributes['st_id']);
    }

    public function kegiatan()
    {
    	return $this->belongsTo('\App\Kegiatan', 'id_kegiatan', 'kegiatan_id');
    }

    public function detail()
    {
        return $this->hasMany('\App\DetailSuratTugas', 'surat_tugas_id', 'st_id');
    }

    public function spd()
    {
        return $this->hasMany('\App\SuratPerjadin', 'surat_tugas_id', 'st_id');
    }

    public function pagu()
    {
        return $this->belongsTo('\App\Pagu', 'kode_pagu');
    }

    public function perjadin()
    {
    	return $this->hasMany('\App\SuratPerjadin', 'surat_tugas_id');
    }
}
