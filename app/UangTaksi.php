<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UangTaksi extends Model
{
    //
	protected $table = 'uang_taksi';
	protected $primaryKey = 'id';

	protected $fillable = [
		'tujuan_id',
		'tujuan_dinas',
		'satuan',
		'jumlah'
	];

	public function tujuan()
	{
		return $this->belongsTo('\App\TujuanDinas', 'tujuan_id');
	}
}
