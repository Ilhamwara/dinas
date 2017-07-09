<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UangPenginapan;
use Illuminate\Support\Facades\Input;
use App\DataTables\UangPenginapanDataTable;
use App\TujuanDinas;
use Excel;
use Session;

class UangPenginapanController extends Controller
{
    //
	public function index(UangPenginapanDataTable $dataTable)
	{
		return $dataTable->render('ref.uang-penginapan.index');
	}
	public function edit($id)
	{
		$UangPenginapan = UangPenginapan::findOrFail($id);
		$UangPenginapanAll = UangPenginapan::all();
		return view('ref.uang-penginapan.edit', compact('UangPenginapan','UangPenginapanAll'));
	}
	public function editProses($id, Request $r)
	{
		$UangPenginapan = UangPenginapan::findOrFail($id);
		$TujuanDinas = TujuanDinas::findOrFail($r->tujuan_dinas_id);

		$UangPenginapan->tujuan_id = $r->tujuan_dinas_id;
		$UangPenginapan->tujuan_dinas = $TujuanDinas->tujuan;
		$UangPenginapan->eselon_satu = $r->eselon_satu;
		$UangPenginapan->eselon_dua = $r->eselon_dua;
		$UangPenginapan->eselontiga_golempat = $r->eselon_tiga_gol_empat;
		$UangPenginapan->eselonempat_goltiga = $r->eselon_empat_gol_tiga;
		$UangPenginapan->golongan_satudua = $r->gol_satu_dua;

		$edit = $UangPenginapan->save();
		if ($edit) {
			Session::flash('message', 'Berhasil memperbaharui uang-penginapan');
			Session::flash('alert-class', 'alert-success');
			return redirect('uang-penginapan/edit/'.$id);
		}
		else{
			Session::flash('message', 'Gagal memperbaharui uang-penginapan');
			Session::flash('alert-class', 'alert-error');
			return back();
		}
	}

	public function tambah()
	{
		$UangPenginapanAll = UangPenginapan::all();
		return view('ref.uang-penginapan.tambah', compact('UangPenginapanAll'));
	}
	public function simpan(Request $r)
	{
		$UangPenginapan = new UangPenginapan();
		$TujuanDinas = TujuanDinas::findOrFail($r->tujuan_dinas_id);

		$UangPenginapan->tujuan_id = $r->tujuan_dinas_id;
		$UangPenginapan->tujuan_dinas = $TujuanDinas->tujuan;
		$UangPenginapan->eselon_satu = $r->eselon_satu;
		$UangPenginapan->eselon_dua = $r->eselon_dua;
		$UangPenginapan->eselontiga_golempat = $r->eselon_tiga_gol_empat;
		$UangPenginapan->eselonempat_goltiga = $r->eselon_empat_gol_tiga;
		$UangPenginapan->golongan_satudua = $r->gol_satu_dua;

		$simpan = $UangPenginapan->save();

		if ($simpan) {
			Session::flash('message', 'Berhasil menambah uang penginapan');
			Session::flash('alert-class', 'alert-success');
			return back();
		}
		else{
			Session::flash('message', 'Gagal menambah uang penginapan');
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
					'eselon_satu' => $value->eselon_satu, 
					'eselon_dua' => $value->dalam_kota, 
					'eselontiga_golempat' => $value->eselontiga_golempat,
					'eselonempat_goltiga' => $value->eselontiga_golempat,
					'golongan_satudua' => $value->golongan_satudua
					];

					$pagu = UangPenginapan::updateOrCreate(
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
