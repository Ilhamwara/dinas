<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\Satker;
use App\Pegawai;
use App\SuratTugas;
use App\SuratPerjadin;
use App\DetailSuratTugas;
use Hashids;
use DB;

class MonitoringController extends Controller
{
    //
	public function index(Request $request)
	{
		$instansi = Satker::all();
		$pegawai = [];
		if (null != $request->instansi) {
			$satker = Satker::findOrFail(Hashids::connection('satker')->decode($request->instansi)[0]);
			
			if ($satker) {
				$pegawai = 	Pegawai::where('satker_id', $satker->satker_id)->get();
			}
		}

		$date = new DateTime('now');
		$date->modify('last day of this month');
		$lastDate = $date->format('d');

		$data = '<tr><th rowspan="2" valign="middle">No.</th><th rowspan="2" valign="middle">Nama</th><th colspan="' . $lastDate . '"> Bulan ' . $date->format('F Y') . '</th></tr><tr>';
		for ($i=1; $i <= $lastDate ; $i++) { 
			$data .= '<th>' . $i . '</th>';
		}

		$data .= '</tr>';
		
		for ($n=1; $n <= count($pegawai) ; $n++) {
			$data .= '<tr><td>' . $n . '</td><td class="nm" style="text-align:left; padding-left:8px;">' . $pegawai[$n-1]->nama . '</td>';
			for ($i=1; $i <= $lastDate ; $i++) { 

				$detailSuratTugas = SuratPerjadin::
				with(['st' => function($q){
					$q->where(DB::raw('MONTH(tanggal_awal) = date("m")'))
					->orWhere(DB::raw('MONTH(tanggal_akhir) = date("m")'));
				}])->where('pegawai_id', $pegawai[$n-1]->pegawai_id)->get();
				
				$data .= '<td>';

				if ($detailSuratTugas) {
					foreach ($detailSuratTugas as $key => $value) {
						// $data .= $value;
						if (($i >= substr(SuratTugas::where('st_id', $value->surat_tugas_id)->first()->tanggal_awal, 8, 10)) AND ($i <= substr(SuratTugas::where('st_id', $value->surat_tugas_id)->first()->tanggal_akhir, 8, 10))) {
							$data .= '<a href="' . url('surat-tugas/cetak/' . $value->surat_tugas_id) . '" target="_blank"><i class="fa fa-plane"></i></a>';
						}
					}
				}

				$data .= '</td>';
			}
			$data .= '</tr>';
		}
		
		// echo $data;
		return view('monitoring.index', compact('instansi', 'data'));
	}
}
