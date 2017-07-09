<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UangHarianBiasa extends Model
{
    //
	protected $table = 'uang_harian_biasa';
	protected $primaryKey = 'id';

	protected $fillable = [
		'tujuan_id',
		'tujuan_dinas',
		'luar_kota',
		'dalam_kota',
		'diklat'
	];

	public function tujuan()
	{
		return $this->belongsTo('\App\TujuanDinas', 'tujuan_id');
	}
}
