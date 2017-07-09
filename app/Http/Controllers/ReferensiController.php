<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ReferensiDataTable;
use Illuminate\Support\Facades\Input;
use Excel;
use App\JenisReferensi;
use App\Referensi;
use App\TujuanDinas;
use Session;

class ReferensiController extends Controller
{
    //
    public function index(ReferensiDataTable $dataTable)
    {
        return $dataTable->render('referensi.referensi');
    }

    public function create(Request $r)
    {
    	$jenisReferensi = JenisReferensi::all();
    	$tujuanDinas = TujuanDinas::all();

    	return view('referensi.tambah', compact('jenisReferensi', 'tujuanDinas'));
    }

    public function save(Request $r)
    {
        $this->validate($r, [
            'tujuan' => 'required',
            'jenis_referensi' => 'required',
            'harga' => 'required'
            ]);

        $referensi = new Referensi();
        $referensi->tujuan_id = $r->tujuan;
        $referensi->jenis = $r->jenis_referensi;
        $referensi->nama = $r->nama_referensi;
        $referensi->kelas = $r->kelas;
        $referensi->tahun = $r->tahun;
        $referensi->harga = $r->harga;
        $referensi->save();

        Session::flash('message', 'Berhasil menambah referensi');
        Session::flash('alert-class', 'alert-success');

        return back();
    }

    public function edit($id)
    {
        $referensi = Referensi::findOrFail($id);
        $jenisReferensi = JenisReferensi::all();
        $tujuanDinas = TujuanDinas::all();

        return view('referensi.edit', compact('referensi', 'jenisReferensi', 'tujuanDinas'));
    }

    public function update(Request $r)
    {
        $referensi = Referensi::findOrFail($r->id);
        $this->validate($r, [
            'tujuan' => 'required',
            'jenis_referensi' => 'required',
            'harga' => 'required'
            ]);

        $referensi->tujuan_id = $r->tujuan;
        $referensi->jenis = $r->jenis_referensi;
        $referensi->nama = $r->nama_referensi;
        $referensi->kelas = $r->kelas;
        $referensi->tahun = $r->tahun;
        $referensi->harga = $r->harga;
        $referensi->save();

        Session::flash('message', 'Berhasil memperbaharui referensi');
        Session::flash('alert-class', 'alert-success');

        return redirect('referensi');
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
                    'jenis' => $value->jenis,
                    'kelas' => $value->kelas,
                    'nama' => $value->nama,
                    'tahun' => $value->tahun,
                    'harga' => $value->harga
                    ];

                    $referensi = Referensi::updateOrCreate(
                        $insert,
                        $insert
                        );

                    if (!$referensi) {
                        Session::flash('message', 'Gagal mengimport data referensi pada baris ke: ' . ($key+1) . '<br> <code>' . json_encode($insert) . '</code>');
                        Session::flash('alert-class', 'alert-danger');
                        return back();
                    }
                }
                Session::flash('message', 'Berhasil mengimpor data referensi');
                Session::flash('alert-class', 'alert-success');         
            }
        }
        
        return back();
    }
}
