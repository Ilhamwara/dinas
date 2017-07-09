<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UangRepresentatif extends Model
{
	protected $table = 'uang_representatif';
	protected $primaryKey = 'id';

	protected $fillable = [
		'uraian_representatif',
		'ur_lukot',
		'ur_dakot'
	];
}
