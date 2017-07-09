<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UangTransportasi extends Model
{
     //
	protected $table = 'uang_transport_sekitar';
	protected $primaryKey = 'uts_id';

	protected $fillable = [
		'uts_id',
		'dinas_sekitar',
		'jumlah'
	];

	public function tujuan()
	{
		return $this->belongsTo('\App\TujuanDinas', 'tujuan_id');
	}
}
