<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Pegawai;
use App\Satker;
use Hashids;
use App\SuratPerjadin;
use App\SuratTugas;
use App\Pagu;
use App\Kegiatan;
use App\TujuanDinas;
use PDF;
use App\Laporan;
// use App\DataTables\PegawaiDataTable;

class PengeluaranRiilController extends Controller
{
    public function index()
    {
       return view('pengeluaran-riil.index');
    }

    public function show($id, Request $request)
    {
    	
    }

    public function create(Request $request)
    {
        return view('pengeluaran-riil.tambah');
       
    }

    public function save(Request $request)
    {
    	
    }

    public function edit($id, Request $request)
    {
    	
    }

    public function update($id, Request $request)
    {
    
    }

    public function cetak($id, Request $request)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];

        $spd_id = Hashids::connection('spd')->decode($request->id);
        if (count($spd_id) != 1) {
            abort(404);
        }

        // dd($request);
        //SPD
        $spd = SuratPerjadin::with(
            'pengeluaranRiil'
        )->findOrFail($spd_id[0]);
        
        if (!$spd) {
            $response['message'] = 'SPD tidak valid';
            return response()->json($response, 404);
        }


        //Cek Laporan
        $laporan = Laporan::where('id_spd', $spd->spd_id)->count();
        if ($laporan < 1) {
            $response['message'] = 'Perjalanan ini belum dilaporkan';
            return response()->json($response, 404);
        }

        //PEGAWAI
        $pegawai = Pegawai::findOrFail($spd->pegawai->pegawai_id);
        if (!$pegawai) {
            $response['message'] = 'Pegawai Tidak ditemukan';
            return response()->json($response, 404);
        }
        //Surat Tugas
        $surat_tugas = SuratTugas::findOrFail($spd->st->st_id);
        if (!$surat_tugas) {
            $response['message'] = 'Surat Tugas tidak valid';
            return response()->json($response, 404);
        }
        //Kegiatan
        $kegiatan = Kegiatan::findOrFail($spd->st->kegiatan->kegiatan_id);
        if (!$kegiatan) {
            $response['message'] = 'Kegiatan tidak valid';
            return response()->json($response, 404);
        }
        //Pagu
        $pagu = Pagu::findOrFail($spd->st->pagu->id);
        if (!$pagu) {
            $response['message'] = 'Pagu tidak valid';
            return response()->json($response, 404);
        }

        //Tujuan
        $tujuan = TujuanDinas::findOrFail($spd->st->kegiatan->tujuan_id);
        if (!$tujuan) {
            $response['message'] = 'Tujuan tidak valid';
            return response()->json($response, 404);
        }
        
        $response['data']['spd'] = $spd;

        // return response()->json($response, 200);
        // echo "<pre>";
        // print_r($response);
        // return view('print.riil', compact('response'));
        $pdf = PDF::loadView('print.riil', compact('response'));
        return @$pdf->stream('Rincin Biaya-' . '.pdf');
    }
}
