<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UangRepresentatifDataTable;
use Illuminate\Support\Facades\Input;
use App\UangRepresentatif;
use Excel;
use Session;


class UangRepresentatifController extends Controller
{
	public function index(UangRepresentatifDataTable $dataTable)
	{
		return $dataTable->render('ref.representatif.index');
	}
	public function edit($id)
	{
		$UangRepresentatif = UangRepresentatif::findOrFail($id);
		return view('ref.representatif.edit', compact('UangRepresentatif'));
	}
	public function editProses($id, Request $r)
	{
		$UangRepresentatif = UangRepresentatif::findOrFail($id);
		$UangRepresentatif->uraian_representatif = $r->nama_representatif;
		$UangRepresentatif->ur_lukot = $r->lukot;
		$UangRepresentatif->ur_dakot = $r->dalkot;

		$edit = $UangRepresentatif->save();
		if ($edit) {
			Session::flash('message', 'Berhasil memperbaharui uang representatif');
			Session::flash('alert-class', 'alert-success');
			return redirect('uang-representatif/edit/'.$id);
		}
		else{
			Session::flash('message', 'Gagal memperbaharui uang representatif');
			Session::flash('alert-class', 'alert-error');
			return back();
		}
	}

	public function tambah()
	{
		return view('ref.representatif.tambah');
	}
	public function simpan(Request $r)
	{
		$UangRepresentatif = new UangRepresentatif();

		$UangRepresentatif->uraian_representatif = $r->nama_representatif;
		$UangRepresentatif->ur_lukot = $r->lukot;
		$UangRepresentatif->ur_dakot = $r->dalkot;

		$simpan = $UangRepresentatif->save();

		if ($simpan) {
			Session::flash('message', 'Berhasil menambah uang representatif');
			Session::flash('alert-class', 'alert-success');
			return back();
		}
		else{
			Session::flash('message', 'Gagal menambah uang representatif');
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
					'uraian_representatif' => $value->uraian_representatif, 
					'ur_lukot' => $value->ur_lukot, 
					'ur_dakot' => $value->ur_dakot
					];

					$pagu = UangRepresentatif::updateOrCreate(
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
