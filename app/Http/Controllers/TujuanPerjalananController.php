<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TujuanDinas;
use App\TujuanDinasLuarNegeri;
use App\DataTables\TujuanDinasDataTable;
use App\DataTables\TujuanDinasLuarNegeriDataTable;
use Session;

class TujuanPerjalananController extends Controller
{
    //
    public function index(TujuanDinasDataTable $dataTable)
    {
    	// dd($dataTable);
    	return $dataTable->render('tujuan-dinas.index');
    }

    public function indexLuarNegeri(TujuanDinasLuarNegeriDataTable $dataTable)
    {
    	// dd($dataTable);
    	return $dataTable->render('tujuan-dinas.index-luar-negeri');
    }

    public function createLuarNegeri()
    {
        return view('tujuan-dinas.create-luar-negeri');
    }

    public function storeLuarNegeri(Request $request)
    {
        $tujuan = new TujuanDinasLuarNegeri();
        $tujuan->tujuan = $request->tujuan;
        if ($tujuan->save()) {
            Session::flash('message', 'Berhasil menyimpan Tujuan Luar Negeri');
            Session::flash('alert-class', 'alert-success');
        }

        return redirect(url('tujuan-luar-negeri'));
    }
}