<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PengeluaranTerbayar;

class Pagu extends Model
{
    //

    protected $table = 'pagu';
    protected $primaryKey = 'id';

    protected $fillable = [
		'tahun', 
		'anak_satker_id',
		'nm_ppk',
		'nip_ppk',
		'nm_bendahara',
		'nip_bendahara',
		'program',
		'kegiatan',
		'output',
		'akun',
		'uraian_akun',
		'jumlah_pagu',
		'terealisasi_pagu',
		'sisa_pagu'
	];

	public function anakSatker()
	{
		return $this->belongsTo('\App\AnakSatker', 'anak_satker_id');
	}

	public function doBayar()
	{
		$data = [
			'current' => [
				'jumlah_pagu' => $this->attributes['jumlah_pagu'],
				'terealisasi_pagu' => $this->attributes['terealisasi_pagu'],
				'sisa_pagu' => $this->attributes['sisa_pagu']
			]
		];
		
		$terbayar = PengeluaranTerbayar::where('pagu_id', $this->attributes['id'])
			->select(\DB::raw('SUM(terbayar) AS total'))
		->first();

		$data['new'] = [
			'jumlah_pagu' => $this->attributes['jumlah_pagu'],
			'terealisasi_pagu' => $terbayar->total,
			'sisa_pagu' => ($this->attributes['jumlah_pagu'] - $terbayar->total)
		];

		$this->terealisasi_pagu = $terbayar->total;
		$this->sisa_pagu = ($this->jumlah_pagu - $terbayar->total);
		$this->save();

		return $data;
	}
}
