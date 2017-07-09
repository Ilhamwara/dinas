<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Hash;

use App\Pegawai;
use App\User;
use App\Satker;
use App\DataTables\PegawaiDataTable;

class PegawaiController extends Controller
{
    //
    public function index(PegawaiDataTable $dataTable)
    {
        return $dataTable->render('pegawai.pegawai');
    }

    public function indexx()
    {
        $query = Pegawai::all();
        foreach ($query as $key => $value) {
            // $a = explode('(', $value->nama_pangkat);
            // $b = explode('/', $a[1]);
            // $c = $b[1];
            // $nama_pangkat = strtoupper(trim($a[0]));
            // $golongan = strtoupper(trim($b[0]));
            // $pangkat = strtoupper(trim(str_replace(')', '', $c)));
            // echo trim($value->nama) . ',' . trim(str_replace(' ', '', $value->nip)) . ',' . $nama_pangkat . ',' . $golongan . ',' . $pangkat . ',' . trim($value->jabatan) . ',' . trim($value->unit_kerja) . '<br>';
            echo trim($value->jabatan) . '<br>';
        }
    }

    public function show($id, Request $request)
    {
    	$pegawai = Pegawai::findOrFail($id);

    	return view('pegawai.profile-pegawai', compact('pegawai'));
    }

    public function create(Request $request)
    {
        $satker = Satker::all();
    	return view('pegawai.tambah-pegawai', compact('satker'));
    }

    public function save(Request $request)
    {
    	$pegawai = new Pegawai();
    	$pegawai->nama = $request->nama;
    	$pegawai->nip = $request->nip;
    	$pegawai->golongan = $request->golongan;
    	$pegawai->pangkat = $request->pangkat;
    	$pegawai->jabatan = $request->nama_jabatan;
        $pegawai->pns = $request->pns;
        $pegawai->tingkat_perjadin = $request->tingkat;

        if ($request->unit_kerja != 'Unit Kerja Lain') {

            $pegawai->unit_kerja = $request->unit_kerja;   
        }else{
            
            $pegawai->unit_kerja = $request->nama_unit_kerja;
        }

        switch ($request->eselon) {
            case 'Non Eselon' OR '0':
                $pegawai->eselon = '0';  
                break;
            case 'Eselon I' OR '1' OR 'I':
                $pegawai->eselon = '1';
                break;
            case 'Eselon II' OR '2' OR 'II':
                $pegawai->eselon = '2';
                break;
            default:
                $pegawai->eselon = '0';
                break;
        }

    	if ($pegawai->save()) {
            $user = new User();
            $user->name = $request->nama;
            $user->type = 'pegawai';
            $user->pegawai_id = $pegawai->pegawai_id;
            $user->password = Hash::make('qwerty');
            if($request->nip != null) {
                $user->username = $request->nip;            
            }else{
                $user->username = 'user-' . random_int(1, 9999);
            }

            $user->save();

    		Session::flash('message', 'Berhasil menambah pegawai');
        	Session::flash('alert-class', 'alert-success');
    	}

        // dd($request);

    	return redirect('pegawai');
    }

    public function saveAjax(Request $request)
    {
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];

        $pegawai = new Pegawai();
        $pegawai->nama = $request->nama;
        $pegawai->nip = $request->nip;
        $pegawai->golongan = $request->golongan;
        $pegawai->pangkat = $request->pangkat;
        $pegawai->jabatan = $request->nama_jabatan;
        $pegawai->pns = $request->pns;
        $pegawai->tingkat_perjadin = $request->tingkat;

        if ($request->unit_kerja != 'Unit Kerja Lain') {

            $pegawai->unit_kerja = $request->unit_kerja;   
        }else{
            
            $pegawai->unit_kerja = $request->nama_unit_kerja;
        }

        switch ($request->eselon) {
            case 'Non Eselon' OR '0':
                $pegawai->eselon = '0';  
                break;
            case 'Eselon I' OR '1' OR 'I':
                $pegawai->eselon = '1';
                break;
            case 'Eselon II' OR '2' OR 'II':
                $pegawai->eselon = '2';
                break;
            default:
                $pegawai->eselon = '0';
                break;
        }

        if ($pegawai->save()) {
            $user = new User();
            $user->name = $request->nama;
            $user->type = 'pegawai';
            $user->pegawai_id = $pegawai->pegawai_id;
            $user->password = Hash::make('qwerty');
            if($request->nip != null) {
                $user->username = $request->nip;            
            }else{
                $user->username = 'user-' . random_int(1, 9999);
            }

            $user->save();

            $resp['status'] = true;
            $resp['data'] = $pegawai;
        }

        return response()->json($resp, 200);
    }

    public function edit($id, Request $request)
    {
    	$pegawai = Pegawai::findOrFail($id);
        $satker = Satker::all();

    	return view('pegawai.edit-pegawai', compact('pegawai', 'satker'));
    }

    public function update($id, Request $request)
    {
    	$pegawai = Pegawai::findOrFail($id);
    	$pegawai->nama = $request->nama;
    	$pegawai->nip = $request->nip;
    	$pegawai->golongan = $request->golongan;
    	$pegawai->pangkat = $request->pangkat;
    	$pegawai->jabatan = $request->jabatan;
    	$pegawai->unit_kerja = $request->unit_kerja;

    	if ($pegawai->save()) {
    		Session::flash('message', 'Berhasil edit pegawai');
        	Session::flash('alert-class', 'alert-success');
    	}

    	return redirect('pegawai');
    }

}
