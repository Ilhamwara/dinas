<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UangPenginapan extends Model
{
    //
	protected $table = 'uang_penginapan';

	protected $primaryKey = 'id';

	protected $fillable = [
		'tujuan_id',
		'tujuan_dinas',
		'eselon_satu',
		'eselon_dua',
		'eselontiga_golempat',
		'eselonempat_goltiga',
		'golongan_satudua'
	];

	public function tujuan()
	{
		return $this->belongsTo('\App\TujuanDinas', 'tujuan_id');
	}
}
