<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengeluaranTerbayar extends Model
{
    //
    protected $table = 'pengeluaran_terbayar';

    protected $fillable = ['spd_id', 'terbayar', 'pagu_id', 'st_id'];

    public function spd()
    {
    	return $this->belongsTo('\App\SuratPerjadin', 'spd_id');
    }
}
