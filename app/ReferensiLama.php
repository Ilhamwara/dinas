<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referensi extends Model
{
    //
    protected $table = 'referensi';
    protected $primaryKey = 'id';

    public function jenis()
    {
    	return $this->belongsTo('\App\JenisReferensi', 'jenis_referensi');
    }

    public function tujuan()
    {
    	return $this->belongsTo('\App\TujuanDinas', 'tujuan_id');
    }
}
