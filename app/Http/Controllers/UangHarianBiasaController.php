<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UangHarianBiasa;
use Illuminate\Support\Facades\Input;
use App\DataTables\UangHarianBiasaDataTable;
use App\TujuanDinas;
use Session;
use Excel;

class UangHarianBiasaController extends Controller
{
    //
	public function index(UangHarianBiasaDataTable $dataTable)
	{
		return $dataTable->render('ref.uang-harian-biasa.index');
	}
	public function edit($id)
	{
		$UangHarian = UangHarianBiasa::findOrFail($id);
		$UangHarianAll = UangHarianBiasa::all();
		return view('ref.uang-harian-biasa.edit', compact('UangHarian','UangHarianAll'));
	}
	public function editProses($id, Request $r)
	{
		$UangHarian = UangHarianBiasa::findOrFail($id);
		$TujuanDinas = TujuanDinas::findOrFail($r->tujuan_dinas_id);

		$UangHarian->tujuan_id = $r->tujuan_dinas_id;
		$UangHarian->tujuan_dinas = $TujuanDinas->tujuan;
		$UangHarian->luar_kota = $r->uang_harian_luar_kota;
		$UangHarian->dalam_kota = $r->uang_harian_dalam_kota;
		$UangHarian->diklat = $r->uang_harian_diklat;
		$edit = $UangHarian->save();
		if ($edit) {
			Session::flash('message', 'Berhasil memperbaharui uang harian biasa');
			Session::flash('alert-class', 'alert-success');
			return redirect('uang-harian/edit/'.$id);
		}
		else{
			Session::flash('message', 'Gagal memperbaharui uang harian biasa');
			Session::flash('alert-class', 'alert-error');
			return back();
		}
	}
	public function tambah()
	{
		$UangHarianAll = UangHarianBiasa::all();
		return view('ref.uang-harian-biasa.tambah', compact('UangHarianAll'));
	}
	public function simpan(Request $r)
	{
		$UangHarian = new UangHarianBiasa();
		$TujuanDinas = TujuanDinas::findOrFail($r->tujuan_dinas_id);
		$UangHarian->tujuan_id = $r->tujuan_dinas_id;
		$UangHarian->tujuan_dinas = $TujuanDinas->tujuan;
		$UangHarian->luar_kota = $r->uang_harian_luar_kota;
		$UangHarian->dalam_kota = $r->uang_harian_dalam_kota;
		$UangHarian->diklat = $r->uang_harian_diklat;

		$simpan = $UangHarian->save();

		if ($simpan) {
			Session::flash('message', 'Berhasil menambah uang harian');
			Session::flash('alert-class', 'alert-success');
			return back();
		}
		else{
			Session::flash('message', 'Gagal menambah uang harian');
			Session::flash('alert-class', 'alert-error');
			return back();	
		}
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
					'tujuan_id' => $value->tujuan_id, 
					'tujuan_dinas' => $value->tujuan_dinas, 
					'luar_kota' => $value->luar_kota, 
					'dalam_kota' => $value->dalam_kota, 
					'diklat' => $value->diklat
					];

					$pagu = UangHarianBiasa::updateOrCreate(
						$insert,
						$insert
						);

					if (!$pagu) {
						Session::flash('message', 'Gagal mengimport data pada baris ke: ' . ($key+1) . '<br> <code>' . json_encode($insert) . '</code>');
						Session::flash('alert-class', 'alert-danger');
						return back();
					}
				}
				Session::flash('message', 'Berhasil mengimport data');
				Session::flash('alert-class', 'alert-success');			
			}
		}
		return back();
	}
}
