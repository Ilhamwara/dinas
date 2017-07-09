<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UangHarianLuar extends Model
{
    //
	protected $table = 'uang_harian_luar';
	protected $primaryKey = 'id';

	protected $fillable = [
		'tujuan_id',
		'negara',
		'satuan',
		'a',
		'b',
		'c',
		'd'
	];

	public function tujuan()
	{
		return $this->belongsTo('\App\TujuanDinasLuarNegeri', 'tujuan_id');
	}
}
