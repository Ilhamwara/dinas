<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisReferensi extends Model
{
    //
    protected $table = 'jn';
    protected $primaryKey = 'id';

    public function ref()
    {
    	return $this->hasMany('\App\Referensi', 'jenis', 'id');
    }
}
