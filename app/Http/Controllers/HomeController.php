<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Kegiatan;
use App\SuratPerjadin;
use App\SuratTugas;
use App\DetailSuratTugas;
use App\Pagu;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard(Request $request)
    {
        if (Auth::user()->type == 'pegawai') {
            $surat_tugas_count = DetailSuratTugas::where('pegawai_id', Auth::user()->pegawai_id)->count();
            $spd_count = SuratPerjadin::where('pegawai_id', Auth::user()->pegawai_id)->count();            
            $kegiatan_count = $surat_tugas_count;
        }elseif (Auth::user()->type == 'admin') {
            $surat_tugas_count = SuratTugas::count();
            $spd_count = SuratPerjadin::count();
            $kegiatan_count = Kegiatan::count();
        }else{
            $surat_tugas_count = SuratTugas::count();
            $spd_count = SuratPerjadin::count();
            $kegiatan_count = Kegiatan::count();
        }

        //Pagu
        $pagu = Pagu::where('tahun', session('tahun'))
                    ->select(
                        \DB::raw('SUM(jumlah_pagu) AS anggaran'),
                        \DB::raw('SUM(terealisasi_pagu) AS terealisasi'),
                        \DB::raw('SUM(sisa_pagu) AS sisa')
                    )->first();
        $total = $pagu->anggaran;
        $terealisasi = $pagu->terealisasi;
        $sisa = $pagu->sisa;

        $spd_terakhir = SuratPerjadin::with(['st', 'pegawai'])->orderBy('spd_id', 'DESC')->limit(5)->get();
        return view('dashboard', compact(
            'surat_tugas_count',
            'spd_count',
            'kegiatan_count',
            'spd_terakhir',
            'total',
            'terealisasi',
            'sisa'
        ));
    }
}