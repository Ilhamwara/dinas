<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengikutSpd extends Model
{
    //
    protected $table = 'pengikut_spd';

   	public function spd()
   	{
   		return $this->belongsTo('\App\SuratPerjadin', 'id_spd');
   	}
}
