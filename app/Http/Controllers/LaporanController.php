<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laporan;
use App\DataTables\LaporanDataTable;
use Hashids;
use App\SuratPerjadin;
use Filesystem;
use Storage;
use Response;
use File;
use Session;

class LaporanController extends Controller
{
    //
    public function index(LaporanDataTable $dataTable)
    {
        return $dataTable->render('laporan.index');
    }

    public function cekLaporan($spd_id)
    {
        $id = Hashids::connection('spd')->decode($spd_id);
        if (count($id) == 0) {
            return response()->json(['status' => false, 'data' => [], 'message' => 'SPD tidak dtemukan'], 404);
        }

        $spd = SuratPerjadin::findOrFail($id[0]);


        //Cari laporan
        if ($spd->st->kegiatan->jenis_kegiatan == 'biasa') {
            $laporan = Laporan::where('id_spd', $spd->spd_id)->get();
            //Sudah ada laporan
            if (count($laporan) > 0) {

                return view('laporan.view-link-laporan', compact('laporan', 'spd'));
            }else{
                return view('laporan.buat-laporan-per-spd', compact('spd'));
            }
        }elseif ($spd->st->kegiatan->jenis_kegiatan == 'dalam_kota_8jam') {
            
            $laporan = Laporan::where('surat_tugas_id', $spd->st->st_id)->get();
            //Sudah ada laporan
            if (count($laporan) > 0) {

                return view('laporan.view-link-laporan', compact('laporan', 'spd'));
            }else{
                return view('laporan.buat-laporan-per-spd', compact('spd'));
            }
        }elseif ($spd->st->kegiatan->jenis_kegiatan == 'luar_negeri') {
            $laporan = Laporan::where('id_spd', $spd->spd_id)->get();
            //Sudah ada laporan
            if (count($laporan) > 0) {
                return view('laporan.view-link-laporan', compact('laporan', 'spd'));
            }else{
                return view('laporan.buat-laporan-per-spd', compact('spd'));
            }
        }
    }

    public function uploadLaporan($spd_id, Request $request)
    {
        $id = Hashids::connection('spd')->decode($request->spd_id);
        if (count($id) == 0) {
            return response()->json(['status' => false, 'data' => [], 'message' => 'SPD tidak dtemukan'], 404);
        }

        $spd = SuratPerjadin::findOrFail($id[0]);

        $this->validate($request, [
            'spd_id' => 'required',
            'st_id' => 'required',
            'upload' => 'required|max:70000'
        ]);

        // dd(storage_path());
        if ($request->hasFile('upload')) {
            $fileName  = 'Laporan_Perjadin-';
            $fileName .= $spd->st->kegiatan->hashid;
            $fileName .= str_random(2) . '.';
            $fileName .= pathinfo($request->file('upload')->getClientOriginalName(), PATHINFO_EXTENSION);

            if(!$request->file('upload')->move(storage_path() . '/uploads/laporan-spd/', $fileName)){
                return response()->json(['status' => false, 'data' => [], 'message' => 'Gagal mengupload']);
            }

            $laporan = new Laporan();
            $laporan->kegiatan_id = $spd->st->kegiatan->kegiatan_id;
            $laporan->surat_tugas_id = $spd->st->st_id;
            $laporan->id_spd = $spd->spd_id;
            $laporan->file = $fileName;
            
            if (!$laporan->save()) {
                return response()->json(['status' => false, 'data' => [], 'message' => 'Gagal mennyimpan']);
            }
        
            Session::flash('message', 'Berhasil mengupload laporan');
            Session::flash('alert-class', 'alert-success');
    
            return redirect(url('spd'));
            //return response()->json(['status' => true, 'data' => $laporan, 'message' => 'Berhasil mengupload']);

        }
        // dd($request->upload);
    }

    public function doDownload($file_name)
    {
        // dd(Storage::disk('lap')->get($file_name));
        // $entry = Filesystem::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('lap')->get($file_name);
        
        // return $file;
        // dd(File::extension($file_name));
        // return (response($file, 200))
  //             ->header('Content-Type', File::extension($file_name));
        return Response::make(file_get_contents(storage_path('/uploads/laporan-spd/' . $file_name)), 200, [
            'Content-Type' => 'application/' . File::extension($file_name)//,
            // 'Content-Disposition' => 'inline; filename="'.$file_name.'"'
        ]);
    }
}
