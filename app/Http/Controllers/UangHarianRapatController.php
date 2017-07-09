<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UangHarianRapat;
use App\TujuanDinas;
use App\DataTables\UangHarianRapatDataTable;
use Illuminate\Support\Facades\Input;
use Excel;
use Session;

class UangHarianRapatController extends Controller
{
	public function index(UangHarianRapatDataTable $dataTable)
	{
		return $dataTable->render('ref.uang-harian-rapat.index');
	}
	public function edit($id)
	{
		$UangHarianRapat = UangHarianRapat::findOrFail($id);
		$UangHarianRapatAll = UangHarianRapat::all();
		return view('ref.uang-harian-rapat.edit', compact('UangHarianRapat','UangHarianRapatAll'));
	}
	public function editProses($id, Request $r)
	{
		$UangHarianRapat = UangHarianRapat::findOrFail($id);
		$TujuanDinas = TujuanDinas::findOrFail($r->tujuan_dinas_id);
		$UangHarianRapat->tujuan_id = $r->tujuan_dinas_id;
		$UangHarianRapat->tujuan_dinas = $TujuanDinas->tujuan;
		$UangHarianRapat->fullboard_lukot = $r->fullboard_lukot;
		$UangHarianRapat->fullboard_dakot = $r->fullboard_dakot;
		$UangHarianRapat->fullhalf_dakot = $r->fullhalf_dakot;
		$edit = $UangHarianRapat->save();

		if ($edit) {
			Session::flash('message', 'Berhasil memperbaharui uang harian rapat');
			Session::flash('alert-class', 'alert-success');
			return redirect('uang-harian-rapat/edit/'.$id);
		}
		else{
			Session::flash('message', 'Gagal memperbaharui uang harian rapat');
			Session::flash('alert-class', 'alert-error');
			return back();
		}
	}

	public function tambah()
	{
		$UangHarianRapat = UangHarianRapat::all();
		return view('ref.uang-harian-rapat.tambah', compact('UangHarianRapat'));
	}
	public function simpan(Request $r)
	{
		$UangHarianRapat = new UangHarianRapat();
		$TujuanDinas = TujuanDinas::findOrFail($r->tujuan_dinas_id);

		$UangHarianRapat->tujuan_id = $r->tujuan_dinas_id;
		$UangHarianRapat->tujuan_dinas = $TujuanDinas->tujuan;
		$UangHarianRapat->fullboard_lukot = $r->fullboard_lukot;
		$UangHarianRapat->fullboard_dakot = $r->fullboard_dakot;
		$UangHarianRapat->fullhalf_dakot = $r->fullhalf_dakot;

		$simpan = $UangHarianRapat->save();

		if ($simpan) {
			Session::flash('message', 'Berhasil menambah uang harian rapat');
			Session::flash('alert-class', 'alert-success');
			return back();
		}
		else{
			Session::flash('message', 'Gagal menambah uang harian rapat');
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
					'fullboard_lukot' => $value->fullboard_lukot,
					'fullboard_dakot' => $value->fullboard_dakot,
					'fullhalf_dakot' => $value->fullhalf_dakot
					];

					$pagu = UangHarianRapat::updateOrCreate(
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
