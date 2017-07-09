<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UangTaksiDataTable;
use Illuminate\Support\Facades\Input;
use App\UangTaksi;
use App\TujuanDinas;
use Excel;
use Session;


class UangHarianTaksiController extends Controller
{
	public function index(UangTaksiDataTable $dataTable)
	{
		return $dataTable->render('ref.uang-taksi.index');
	}
	public function edit($id)
	{
		$UangTaksi = UangTaksi::findOrFail($id);
		$UangTaksiAll = UangTaksi::all();
		return view('ref.uang-taksi.edit', compact('UangTaksi','UangTaksiAll'));
	}
	public function editProses($id, Request $r)
	{
		$UangTaksi = UangTaksi::findOrFail($id);
		$TujuanDinas = TujuanDinas::findOrFail($r->tujuan_dinas_id);

		$UangTaksi->tujuan_id = $r->tujuan_dinas_id;
		$UangTaksi->tujuan_dinas = $TujuanDinas->tujuan;
		$UangTaksi->satuan = 'Orang/Kali';
		$UangTaksi->jumlah = $r->jumlah;

		$edit = $UangTaksi->save();
		if ($edit) {
			Session::flash('message', 'Berhasil memperbaharui uang taksi');
			Session::flash('alert-class', 'alert-success');
			return redirect('uang-taksi/edit/'.$id);
		}
		else{
			Session::flash('message', 'Gagal memperbaharui uang taksi');
			Session::flash('alert-class', 'alert-error');
			return back();
		}
	}

	public function tambah()
	{
		$UangTaksi = UangTaksi::all();
		return view('ref.uang-taksi.tambah', compact('UangTaksi'));
	}
	public function simpan(Request $r)
	{
		$UangTaksi = new UangTaksi();
		$TujuanDinas = TujuanDinas::findOrFail($r->tujuan_dinas_id);

		$UangTaksi->tujuan_id = $r->tujuan_dinas_id;
		$UangTaksi->tujuan_dinas = $TujuanDinas->tujuan;
		$UangTaksi->satuan = 'Orang/Kali';
		$UangTaksi->jumlah = $r->jumlah;

		$simpan = $UangTaksi->save();

		if ($simpan) {
			Session::flash('message', 'Berhasil menambah uang taksi');
			Session::flash('alert-class', 'alert-success');
			return back();
		}
		else{
			Session::flash('message', 'Gagal menambah uang taksi');
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
					'satuan' => $value->satuan,
					'jumlah' => $value->jumlah
					];

					$uang_taksi = UangTaksi::updateOrCreate(
						$insert,
						$insert
						);

					if (!$uang_taksi) {
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
