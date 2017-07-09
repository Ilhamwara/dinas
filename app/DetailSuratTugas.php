<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSuratTugas extends Model
{
    //
    protected $table = 'detail_surat_tugas';
    protected $primaryKey = 'id';

    public function pegawai()
    {
    	return $this->belongsTo('\App\Pegawai', 'pegawai_id');
    }

    public function st()
    {
    	return $this->belongsTo('\App\SuratTugas', 'surat_tugas_id', 'st_id');
    }
}
