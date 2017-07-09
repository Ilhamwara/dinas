<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;

use App\Satker;
use App\AnakSatker;

class AnakSatkerController extends Controller
{
    //

    public function index()
    {
    	$anak_satker = AnakSatker::all();
    	return view('anak_satker.index', compact('anak_satker'));
    }

    public function create()
    {
    	$satker = Satker::all();
    	return view('anak_satker.create', compact('satker'));
    }

    public function store(Request $request)
    {
		$this->validate($request, [
            'kode' => 'required',
            'unit_kerja' => 'required',
            'tahun' => 'required',
            'nomor_spd' => 'required',
            'nama_bendahara' => 'required',
            'nip_bendahara' => 'required',
            'nama_ppk' => 'required',
            'nip_ppk' => 'required'
        ]);

        $anak_satker = new AnakSatker();
        $anak_satker->tahun = $request->tahun;
        $anak_satker->kode = $request->kode;
        $anak_satker->id_unit_kerja = $request->unit_kerja;
        $anak_satker->nomor_spd = $request->nomor_spd;
        $anak_satker->nama_bendahara = $request->nama_bendahara;
        $anak_satker->nip_bendahara = $request->nip_bendahara;
        $anak_satker->nama_ppk = $request->nama_ppk;
        $anak_satker->nip_ppk = $request->nip_ppk;
    	
    	if ($anak_satker->save()) {
    		Session::flash('message', 'Berhasil menambah anak satker');
        	Session::flash('alert-class', 'alert-success');

        	return redirect('anak-satker');
    	}

    	return redirect()->back();
    }

    public function edit($id)
    {
    	$anak_satker = AnakSatker::find($id);
    	$satker = Satker::all();
    	return view('anak_satker.edit', compact('anak_satker', 'satker'));
    }

    public function update($id, Request $request)
    {
    	$anak_satker = AnakSatker::find($id);

    	$this->validate($request, [
            'kode' => 'required',
            'unit_kerja' => 'required',
            'tahun' => 'required',
            'nomor_spd' => 'required',
            'nama_bendahara' => 'required',
            'nip_bendahara' => 'required',
            'nama_ppk' => 'required',
            'nip_ppk' => 'required'
        ]);

    	$anak_satker->tahun = $request->tahun;
        $anak_satker->kode = $request->kode;
        $anak_satker->id_unit_kerja = $request->unit_kerja;
        $anak_satker->nomor_spd = $request->nomor_spd;
        $anak_satker->nama_bendahara = $request->nama_bendahara;
        $anak_satker->nip_bendahara = $request->nip_bendahara;
        $anak_satker->nama_ppk = $request->nama_ppk;
        $anak_satker->nip_ppk = $request->nip_ppk;
    	
    	if ($anak_satker->save()) {
    		Session::flash('message', 'Berhasil memperbaharui anak satker');
        	Session::flash('alert-class', 'alert-success');

        	return redirect('anak-satker');
    	}

    	return redirect()->back();
    }
}
