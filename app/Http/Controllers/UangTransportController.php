<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UangTransportasi;
use App\DataTables\UangTransportasiDataTable;
use Illuminate\Support\Facades\Input;
use Session;
use Excel;	

class UangTransportController extends Controller
{
    //
    public function index(UangTransportasiDataTable $dataTable)
    {
    	return $dataTable->render('ref.uang-transport.index');
    }
    public function edit($id)
	{
		$UangTransportasi = UangTransportasi::findOrFail($id);
		$UangTransportasiAll = UangTransportasi::all();

		return view('ref.uang-transport.edit', compact('UangTransportasi','UangTransportasiAll'));
	}
	public function editProses($id, Request $r)
	{
		$UangTransportasiAll = UangTransportasi::findOrFail($r->uts_id);
		$UangTransportasi = UangTransportasi::findOrFail($id);
		
		$UangTransportasi->dinas_sekitar = $UangTransportasiAll->dinas_sekitar;
		$UangTransportasi->jumlah = $r->jumlah;

		$edit = $UangTransportasi->save();

		if ($edit) {
			Session::flash('message', 'Berhasil memperbaharui uang transport');
			Session::flash('alert-class', 'alert-success');
			return redirect('uang-transport/edit/'.$id);
		}
		else{
			Session::flash('message', 'Gagal memperbaharui uang transport');
			Session::flash('alert-class', 'alert-error');
			return back();
		}
	}

	public function tambah()
	{
		$UangTransportasi = UangTransportasi::all();
		return view('ref.uang-transport.tambah', compact('UangTransportasi'));
	}
	public function simpan(Request $r)
	{
		$UangTransportasi = new UangTransportasi();
		$UangTransportasiAll = UangTransportasi::findOrFail($r->uts_id);

		$UangTransportasi->dinas_sekitar = $UangTransportasiAll->dinas_sekitar;
		$UangTransportasi->jumlah = $r->jumlah;

		$simpan = $UangTransportasi->save();

		if ($simpan) {
			Session::flash('message', 'Berhasil menambah uang transport');
			Session::flash('alert-class', 'alert-success');
			return back();
		}
		else{
			Session::flash('message', 'Gagal menambah uang transport');
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
					'uts_id' => $value->uts_id, 
					'dinas_sekitar' => $value->dinas_sekitar, 
					'jumlah' => $value->jumlah
					];

					$UangTransportasi = UangTransportasi::updateOrCreate(
						$insert,
						$insert
						);

					if (!$UangTransportasi) {
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
