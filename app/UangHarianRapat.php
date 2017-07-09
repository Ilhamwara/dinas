<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UangHarianRapat extends Model
{
	protected $table = 'uang_harian_rapat';
	protected $primaryKey = 'id';

	protected $fillable = [
		'tujuan_id',
		'tujuan_dinas',
		'fullboard_lukot',
		'fullboard_dakot',
		'fullhalf_dakot'
	];

	public function tujuan()
	{
		return $this->belongsTo('\App\TujuanDinas', 'tujuan_id');
	}
}
