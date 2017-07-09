<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;
use Session;
use App\DataTables\PaguDataTable;

use App\Pagu;
use App\AnakSatker;

class PaguController extends Controller
{
    //
    public function index(PaguDataTable $dataTable)
    {
        return $dataTable->render('pagu.index');
    }

    public function create()
    {
    	$anak_satker = AnakSatker::all();
    	return view('pagu.create', compact('anak_satker'));
    }

//Excel
    public function downloadExcel($type)
	{
		$data = Item::get()->toArray();
		return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}

	public function importExcel()
	{
		if(Input::hasFile('import_file')){

			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			
			})->get();
			
			if(!empty($data) && $data->count()){
			
				foreach ($data as $key => $value) {
					$insert = [
						'tahun' => $value->tahun, 
						'anak_satker_id' => $value->anak_satker_id,
						'nm_ppk' => $value->nm_ppk,
						'nip_ppk' => $value->nip_ppk,
						'nm_bendahara' => $value->nm_bendahara,
						'nip_bendahara' => $value->nip_bendahara,
						'program' => $value->program,
						'kegiatan' => $value->kegiatan,
						'output' => $value->output,
						'akun' => $value->akun,
						'uraian_akun' => $value->uraian_akun,
						'jumlah_pagu' => $value->jumlah_pagu,
						'terealisasi_pagu' => $value->terealisasi_pagu,
						'sisa_pagu' => $value->sisa_pagu
					];
				
					$pagu = Pagu::updateOrCreate(
				    	$insert,
				    	$insert
					);

					if (!$pagu) {
						Session::flash('message', 'Gagal mengimpo data pagu pada baris ke: ' . ($key+1) . '<br> <code>' . json_encode($insert) . '</code>');
        				Session::flash('alert-class', 'alert-danger');
						return back();
					}

				}

				Session::flash('message', 'Berhasil mengimpor data pagu');
				Session::flash('alert-class', 'alert-success');			
				// return response()->json($data, 200);
				// if(!empty($insert)){
				// 	if(DB::table('pagu')->insert($insert)){
				// 		Session::flash('message', 'Berhasil mengimpor data pagu');
    //     				Session::flash('alert-class', 'alert-success');
				// 	}else{
				// 		Session::flash('message', 'Gagal mengimpo data pagu');
    //     				Session::flash('alert-class', 'alert-danger');
				// 	}
				// }
			}
		}
		
		return back();
	}

	public function getRincian($akun, Request $request)
	{
		
	}

	public function getNested()
	{
		$response = [
    		'status' => false,
    		'data' => null,
    		'message' => ''
    	];


    	$pagu = Pagu::select('id', 'tahun', 'anak_satker_id','nm_ppk','nip_ppk','nm_bendahara','nip_bendahara','program','kegiatan','output','akun','uraian_akun','jumlah_pagu','terealisasi_pagu','sisa_pagu');
 
    	if (null != request('tahun')) {
    		$pagu->where('tahun', request('tahun'));
    	}

    	if (null != request('anak_satker_id')) {
    		$pagu->where('anak_satker_id', request('anak_satker_id'));
    	}

    	if (null != request('nm_ppk')) {
    		$pagu->where('nm_ppk', request('nm_ppk'));
    	}

    	if (null != request('nip_ppk')) {
    		$pagu->where('nip_ppk', request('nip_ppk'));
    	}
	    	
	    if (null != request('nm_bendahara')) {
    		$pagu->where('nm_bendahara', request('nm_bendahara'));
    	}

    	if (null != request('nip_bendahara')) {
    		$pagu->where('nip_bendahara', request('nip_bendahara'));
    	}

    	if (null != request('program')) {
    		$pagu->where('program', request('program'));
    	}

    	if (null != request('kegiatan')) {
    		$pagu->where('kegiatan', request('kegiatan'));
    	}

    	if (null != request('output')) {
    		$pagu->where('output', request('output'));
    	}

    	if (null != request('akun')) {
    		$pagu->where('akun', request('akun'));
    	}

    	if (null != request('uraian_akun')) {
    		$pagu->where('uraian_akun', request('uraian_akun'));
    	}

    	if (null != request('jumlah_pagu')) {
    		$pagu->where('jumlah_pagu', request('jumlah_pagu'));
    	}

    	if (null != request('terealisasi_pagu')) {
    		$pagu->where('terealisasi_pagu', request('terealisasi_pagu'));
    	}

    	if (null != request('sisa_pagu')) {
    		$pagu->where('sisa_pagu', request('sisa_pagu'));
    	}


    	if ($result = $pagu->get()) {
    		    //DISTINCT
	    	if (null != request('distinct')) {
	    		$collection = collect($result);
	    		$result = $collection->unique(request('distinct'))->values()->all();
	    	}


    		$response['status']	= true;
    		$response['data']	= $result;
    	}

    	// dd($pagu);

    	// // dd($result);
    	return response()->json($response,200);
	}
}
