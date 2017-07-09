<?php

namespace App;

use Hashids;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    //
    protected $table = 'laporan';


    public function spd()
    {
    	return $this->belongsTo('\App\SuratPerjadin', 'id_spd');
    }

    public function st()
    {
    	return $this->belongsTo('\App\SuratTugas', 'surat_tugas_id');
    }
}
