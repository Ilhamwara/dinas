<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UangHarianLuar;
use Illuminate\Support\Facades\Input;
use App\DataTables\UangHarianLuarDataTable;
use Session;
use Excel;
use App\TujuanDinasLuarNegeri;

class UangHarianLuarController extends Controller
{
    //
	
	public function index(UangHarianLuarDataTable $dataTable)
	{
		return $dataTable->render('ref_ln.uang-harian.index');
	}

	public function edit($id)
	{
		$UangHarian = UangHarianLuar::findOrFail($id);
		$tujuanDinas = TujuanDinasLuarNegeri::all();
		return view('ref_ln.uang-harian.edit', compact('UangHarian','tujuanDinas'));
	}
	
	public function editProses($id, Request $r)
	{
		$this->validate($r, [
			'negara' => 'required',
			'gol_a' => 'required',
			'gol_b' => 'required',
			'gol_c' => 'required',
			'gol_d' => 'required'
		]);

		$UangHarian = UangHarianLuar::findOrFail($id);

		$UangHarian->tujuan_id = $r->negara;
		$UangHarian->satuan = 'OH';
		$UangHarian->a = $r->gol_a;
		$UangHarian->b = $r->gol_b;
		$UangHarian->c = $r->gol_c;
		$UangHarian->d = $r->gol_d;
		$edit = $UangHarian->save();
		if ($edit) {
			Session::flash('message', 'Berhasil memperbaharui uang harian');
			Session::flash('alert-class', 'alert-success');
			return redirect('uang-harian-luar-negeri/edit/'.$id);
		}
		else{
			Session::flash('message', 'Gagal memperbaharui uang harian');
			Session::flash('alert-class', 'alert-error');
			return redirect(url('uang-harian-luar-negeri'));
		}
	}

	public function tambah()
	{
		$tujuanDinas = TujuanDinasLuarNegeri::all();
		return view('ref_ln.uang-harian.tambah', compact('tujuanDinas'));
	}

	public function simpan(Request $r)
	{
		$this->validate($r, [
			'negara' => 'required',
			'gol_a' => 'required',
			'gol_b' => 'required',
			'gol_c' => 'required',
			'gol_d' => 'required'
		]);

		$uangHarian = new UangHarianLuar();
		$uangHarian->tujuan_id = $r->negara;
		$uangHarian->satuan = 'OH';
		$uangHarian->a = $r->gol_a;
		$uangHarian->b = $r->gol_b;
		$uangHarian->c = $r->gol_c;
		$uangHarian->d = $r->gol_d;

		$simpan = $uangHarian->save();

		if ($simpan) {
			Session::flash('message', 'Berhasil menambah uang harian');
			Session::flash('alert-class', 'alert-success');
			return redirect(url('uang-harian-luar-negeri'));
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
						'satuan' => $value->satuan, 
						'a' => $value->a, 
						'b' => $value->b, 
						'c' => $value->c,
						'd' => $value->d
					];

					$uang_harian = UangHarianLuar::updateOrCreate(
						$insert,
						$insert
					);

					if (!$uang_harian) {
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
