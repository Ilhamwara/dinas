<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referensi extends Model
{
    //
    protected $table = 'ref';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tujuan_id',
        'jenis',
        'kelas',
        'nama',
        'tahun',
        'harga'
    ];

    public function jn()
    {
    	return $this->belongsTo('\App\JenisReferensi', 'jenis', 'id');
    }

    public function tujuan()
    {
    	return $this->belongsTo('\App\TujuanDinas', 'tujuan_id');
    }
}
