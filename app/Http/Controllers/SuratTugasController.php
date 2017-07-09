<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\DataTables\SuratTugasDataTable;
use App\Pegawai;
use App\TujuanDinas;
use App\Kegiatan;
use App\SuratTugas;
use App\Satker;
use App\SuratPerjadin;
use App\AnakSatker;
use App\DetailSuratTugas;
use Session;
use PDF;


class SuratTugasController extends Controller
{
    //
    public function indddex()
    {
        if(Auth::user()->type == 'pegawai'){
            $st_id = [];
            $mySt = DetailSuratTugas::where('pegawai_id', Auth::user()->pegawai_id)->get();
            if ($mySt) {
            //     foreach ($mySt as $key => $value) {
            //         $st_id[] = $value->surat_tugas_id;
            //     }
                dd($mySt);
            }

            // $query = SuratTugas::whereIn('st_id', $st_id)->latest();

        }

    }
    public function index(SuratTugasDataTable $dataTable)
    {
        return $dataTable->render('surat-tugas.index');
    }
    

    public function create($kegiatan = null)
    {
        $tujuan = TujuanDinas::all();
        $pegawai = Pegawai::all();
        
        if ($kegiatan !== null) {
            $kegiatan = Kegiatan::findOrFail($kegiatan);
        }else{
            $kegiatan = Kegiatan::all();
        }

        $anakSatker = AnakSatker::where('tahun', session('tahun'))->get();

        $satker = Satker::all();
        return view('surat-tugas.tambah', compact('pegawai', 'tujuan', 'kegiatan', 'satker', 'anakSatker'));
    }

    public function store($kegiatan, Request $r)
    {
        //Validasi input
        $this->validate($r, [
            'no_surat' => 'required',
            'sejak' => 'required',
            'hingga' => 'required',
            'kegiatan' => 'required',
            'inspektur' => 'required',
            'tujuan' => 'required'
            ]);

        // Validasi pegawai
        if (is_array($r->pegawai) && count($r->pegawai) > 0) {
            foreach ($r->pegawai as $key => $value) {
                $pegawai = Pegawai::where('pegawai_id', $r->pegawai[$key])->first();

                if (count($pegawai) < 1) {
                    Session::flash('message', 'Pegawai ke ' . $key+1);
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->back();
                }
            }
        }else{
            Session::flash('message', 'Pegawai harus terisi');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }

        // Validasi Kegiatan
        $kegiatan = Kegiatan::where('kegiatan_id', $r->kegiatan)->first();
        if (count($kegiatan) < 1) {
            Session::flash('message', 'Pegawai ke ' . $key+1);
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        
        // Validasi Inspektur
        $inspektur = Pegawai::where('pegawai_id', $r->inspektur)->first();
        if (count($kegiatan) < 1) {
            Session::flash('message', 'Inspektur tidak ditemukan');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }


        $suratTugas = new SuratTugas();

        $suratTugas->no_st = $r->no_surat;
        $suratTugas->nama_kegiatan = $kegiatan->nama_kegiatan;
        $suratTugas->id_kegiatan = $kegiatan->kegiatan_id;
        $suratTugas->tujuan_dinas = $r->tujuan;
        $suratTugas->tanggal_awal = \App\Library\Datify::toDate($r->sejak);
        $suratTugas->tanggal_akhir = \App\Library\Datify::toDate($r->hingga);
        $suratTugas->tempat_dikeluarkan_surat = $r->tempat_surat;
        $suratTugas->tanggal_surat = \App\Library\Datify::toDate($r->tgl_surat);
        $suratTugas->nama_inspektur = $inspektur->nama;
        $suratTugas->nip_inspektur = $inspektur->nip;
        // $suratTugas->instansi_terbeban = Satker::find($r->st_instansi_terbeban)->unit_kerja;
        // $suratTugas->akun_terbeban = $r->st_akun_terbeban;
        $suratTugas->kode_pagu = $r->st_pagu;


        $suratTugas->save();
        
        foreach ($r->pegawai as $key => $value) {
            $detail = new DetailSuratTugas();
            $detail->kegiatan_id = $kegiatan->kegiatan_id;
            $detail->surat_tugas_id = $suratTugas->st_id;
            $detail->pegawai_id = $r->pegawai[$key];

            $detail->save();
        }

        Session::flash('message', 'Surat Tugas berhasil dibuat');
        Session::flash('alert-class', 'alert-success');

        return redirect('surat-tugas');
    }



    public function storeAjax(Request $r)
    {
        $response = [
        'status' => false,
            // 'data' => '',
        'message' => ''
        ];

        //Validasi input
        $this->validate($r, [
            'no_surat' => 'required',
            'hidden_id_kegiatan' => 'required',
            'inspektur' => 'required'
            ]);

        // Validasi pegawai
        if (is_array($r->pegawai) && count($r->pegawai) > 0) {
            foreach ($r->pegawai as $key => $value) {
                $pegawai = Pegawai::where('pegawai_id', $r->pegawai[$key])->first();

                if (count($pegawai) < 1) {
                    $response['message'] = 'Pegawai ke ' . $key+1 . ' Tidak valid';
                    return response()->json($response, 400);
                }
            }
        }else{
            $response['message'] = 'Pegawai ke harus terisi';
            return response()->json($response, 400);
        }

        // Validasi Kegiatan
        $kegiatan = Kegiatan::where('kegiatan_id', $r->hidden_id_kegiatan)->first();
        if (count($kegiatan) < 1) {
            $response['message'] = 'Kegiatan tidak valid';
            return response()->json($response, 400);
        }
        
        // Validasi Inspektur
        $inspektur = Pegawai::where('pegawai_id', $r->inspektur)->first();
        if (count($kegiatan) < 1) {
            $response['message'] = 'Penandatangan Surat tidak valid';
            return response()->json($response, 400);
        }


        $suratTugas = new SuratTugas();

        $suratTugas->no_st = $r->no_surat;
        $suratTugas->nama_kegiatan = $kegiatan->nama_kegiatan;
        $suratTugas->id_kegiatan = $kegiatan->kegiatan_id;
        $suratTugas->tujuan_dinas = $kegiatan->lokasi_kegiatan;
        $suratTugas->tanggal_awal =  $kegiatan->tanggal_awal;
        $suratTugas->tanggal_akhir = $kegiatan->tanggal_akhir;
        $suratTugas->tempat_dikeluarkan_surat = $r->tempat_surat;
        $suratTugas->tanggal_surat = \App\Library\Datify::toDate($r->tgl_surat);
        $suratTugas->nama_inspektur = $inspektur->nama;
        $suratTugas->nip_inspektur = $inspektur->nip;
        // $suratTugas->instansi_terbeban = Satker::find($r->st_instansi_terbeban)->unit_kerja;
        // $suratTugas->akun_terbeban = $r->st_akun_terbeban;
        $suratTugas->kode_pagu = $r->st_pagu;

        $suratTugas->save();
        
        foreach ($r->pegawai as $key => $value) {
            $detail = new DetailSuratTugas();
            $detail->kegiatan_id = $kegiatan->kegiatan_id;
            $detail->surat_tugas_id = $suratTugas->st_id;
            $detail->pegawai_id = $r->pegawai[$key];

            $detail->save();
        }

        $response['status'] = true;
        $response['data'] = $suratTugas->st_id;
        $response['message'] = 'Behasil menyimpan surat tugas';
        return response()->json($response, 200);
    }

    public function showAjax($id, Request $r)
    {
        $response = [
        'status' => false,
            // 'data' => '',
        'message' => ''
        ];

        $suratTugas = SuratTugas::find($id);
        if (!$suratTugas) {
            $response['message'] = 'Surat tugas tidak ditemukan';
            return response()->json($response,404);
        }

        $response['status'] = true;
        $response['data']['st_id'] = $suratTugas->st_id;
        $response['data']['hashid'] = $suratTugas->hashid;
        $response['data']['no_st'] = $suratTugas->no_st;
        $response['data']['nama_kegiatan'] = $suratTugas->nama_kegiatan;
        $response['data']['jenis_kegiatan'] = $suratTugas->kegiatan->jenis_kegiatan;
        $response['data']['id_kegiatan'] = $suratTugas->id_kegiatan;
        $response['data']['tujuan_dinas'] = $suratTugas->tujuan_dinas;
        $response['data']['tanggal_awal'] = \App\Library\Datify::readify(substr($suratTugas->tanggal_awal, 0, 10));
        $response['data']['tanggal_akhir'] = \App\Library\Datify::readify(substr($suratTugas->tanggal_akhir, 0, 10));
        $response['data']['tempat_dikeluarkan_surat'] = $suratTugas->tempat_dikeluarkan_surat;
        $response['data']['tanggal_surat'] = \App\Library\Datify::readify(substr($suratTugas->tanggal_surat, 0, 10));
        $response['data']['nama_inspektur'] = $suratTugas->nama_inspektur;
        $response['data']['nip_inspektur'] = $suratTugas->nip_inspektur;
        $response['data']['spd_id'] = (count($suratTugas->spd) > 0) ? $suratTugas->spd->first()->spd_id : null;
        $response['data']['no_spd'] = (count($suratTugas->spd) > 0) ? $suratTugas->spd->first()->no_spd : null;

        $detail = DetailSuratTugas::where('surat_tugas_id', $suratTugas->st_id)->get();
        if ($detail) {
            foreach ($detail as $key => $value) {
                $pegawai = Pegawai::find($value->pegawai_id);
                $response['data']['peserta'][$key]['id'] = $pegawai->pegawai_id;
                $response['data']['peserta'][$key]['hashid'] = $pegawai->hashid;
                $response['data']['peserta'][$key]['nama'] = $pegawai->nama;
                $response['data']['peserta'][$key]['nip'] = $pegawai->nip;
                $response['data']['peserta'][$key]['pangkat'] = $pegawai->pangkat;
                $response['data']['peserta'][$key]['golongan'] = $pegawai->golongan;
                $response['data']['peserta'][$key]['jabatan'] = $pegawai->jabatan;
                $response['data']['peserta'][$key]['unit_kerja'] = $pegawai->unit_kerja;

                $response['data']['peserta'][$key]['spd_id'] = null;
                //Cari SPD
                $spd = SuratPerjadin::where('surat_tugas_id', $suratTugas->st_id)
                        ->where('pegawai_id', $pegawai->pegawai_id)
                        ->first();
                if ($spd) {
                    $response['data']['peserta'][$key]['spd_id'] = $spd->hashid;
                    $response['data']['peserta'][$key]['no_spd'] = $spd->no_spd;

                    //Cari Rincian
                    $response['data']['peserta'][$key]['rincian_biaya'] = 0;
                    $response['data']['peserta'][$key]['rincian_biaya'] +=\App\PengeluaranLumpsum::where('spd_id', $spd->spd_id)->count();
                    $response['data']['peserta'][$key]['rincian_biaya'] +=\App\PengeluaranPenginapan::where('spd_id', $spd->spd_id)->count();
                    $response['data']['peserta'][$key]['rincian_biaya'] +=\App\PengeluaranRepresentatif::where('spd_id', $spd->spd_id)->count();
                    $response['data']['peserta'][$key]['rincian_biaya'] +=\App\PengeluaranRiil::where('spd_id', $spd->spd_id)->count();
                    $response['data']['peserta'][$key]['rincian_biaya'] +=\App\PengeluaranTransport::where('spd_id', $spd->spd_id)->count();
                    $response['data']['peserta'][$key]['rincian_biaya'] +=\App\PengeluaranUangHarian::where('spd_id', $spd->spd_id)->count();
                    // $response['data']['peserta'][$key]['rincian_biaya'] = (\App\Pengeluaran::where('spd_id', $spd->id)->count() > 0) ? $response['data']['peserta'][$key]['rincian_biaya']++;
                }
            }
        }


        return response()->json($response,200);
    }

    public function cetak($id, Request $r)
    {
        $response = [
        'status' => false,
            // 'data' => '',
        'message' => ''
        ];

        $suratTugas = SuratTugas::find($id);
        if (!$suratTugas) {
            $response['message'] = 'Surat tugas tidak ditemukan';
            return response()->json($response,404);
        }

        $response['status'] = true;
        $response['data']['st_id'] = $suratTugas->st_id;
        $response['data']['hashid'] = $suratTugas->hashid;
        $response['data']['no_st'] = $suratTugas->no_st;
        $response['data']['nama_kegiatan'] = $suratTugas->nama_kegiatan;
        $response['data']['id_kegiatan'] = $suratTugas->id_kegiatan;
        $response['data']['tujuan_dinas'] = $suratTugas->tujuan_dinas;
        $response['data']['tanggal_awal'] = \App\Library\Datify::readify(substr($suratTugas->tanggal_awal, 0, 10));
        $response['data']['tanggal_akhir'] = \App\Library\Datify::readify(substr($suratTugas->tanggal_akhir, 0, 10));
        $response['data']['tempat_dikeluarkan_surat'] = $suratTugas->tempat_dikeluarkan_surat;
        $response['data']['tanggal_surat'] = \App\Library\Datify::readify(substr($suratTugas->tanggal_surat, 0, 10));
        $response['data']['nama_inspektur'] = $suratTugas->nama_inspektur;
        $response['data']['nip_inspektur'] = $suratTugas->nip_inspektur;

        $detail = DetailSuratTugas::where('surat_tugas_id', $suratTugas->st_id)->get();
        if ($detail) {
            foreach ($detail as $key => $value) {
                $pegawai = Pegawai::find($value->pegawai_id);
                $response['data']['peserta'][$key]['id'] = $pegawai->pegawai_id;
                $response['data']['peserta'][$key]['nama'] = $pegawai->nama;
                $response['data']['peserta'][$key]['nip'] = $pegawai->nip;
                $response['data']['peserta'][$key]['pangkat'] = $pegawai->pangkat;
                $response['data']['peserta'][$key]['golongan'] = $pegawai->golongan;
                $response['data']['peserta'][$key]['jabatan'] = $pegawai->jabatan;
                $response['data']['peserta'][$key]['unit_kerja'] = $pegawai->unit_kerja;
            }
        }
        $pdf = PDF::loadView('print.surat-tugas', compact('response'));
        return @$pdf->stream('ST-' . $suratTugas->hashid . '.pdf');
    }

    public function cetak8jam($id, Request $r)
    {
        $response = [
            'status' => false,
            // 'data' => '',
            'message' => ''
        ];

        $suratTugas = SuratTugas::with('pagu')->find($id);
        if (!$suratTugas) {
            $response['message'] = 'Surat tugas tidak ditemukan';
            return response()->json($response,404);
        }

        $response['status'] = true;
        $response['st'] = $suratTugas;
        $response['data']['st_id'] = $suratTugas->st_id;
        $response['data']['hashid'] = $suratTugas->hashid;
        $response['data']['no_st'] = $suratTugas->no_st;
        $response['data']['nama_kegiatan'] = $suratTugas->nama_kegiatan;
        $response['data']['id_kegiatan'] = $suratTugas->id_kegiatan;
        $response['data']['tujuan_dinas'] = $suratTugas->tujuan_dinas;
        $response['data']['tanggal_awal'] = \App\Library\Datify::readify(substr($suratTugas->tanggal_awal, 0, 10));
        $response['data']['tanggal_awall'] = substr($suratTugas->tanggal_awal, 0, 10);
        $response['data']['tanggal_akhir'] = \App\Library\Datify::readify(substr($suratTugas->tanggal_akhir, 0, 10));
        $response['data']['tempat_dikeluarkan_surat'] = $suratTugas->tempat_dikeluarkan_surat;
        $response['data']['tanggal_surat'] = \App\Library\Datify::readify(substr($suratTugas->tanggal_surat, 0, 10));
        $response['data']['nama_inspektur'] = $suratTugas->nama_inspektur;
        $response['data']['nip_inspektur'] = $suratTugas->nip_inspektur;

        $detail = DetailSuratTugas::where('surat_tugas_id', $suratTugas->st_id)->get();
        $sudahAdaSpd = ((SuratPerjadin::where('surat_tugas_id', $suratTugas->st_id)->count() > 0) ? true : false);
        if ($detail) {
            foreach ($detail as $key => $value) {
                $pegawai = Pegawai::find($value->pegawai_id);
                $response['data']['peserta'][$key]['id'] = $pegawai->pegawai_id;
                $response['data']['peserta'][$key]['nama'] = $pegawai->nama;
                $response['data']['peserta'][$key]['nip'] = $pegawai->nip;
                $response['data']['peserta'][$key]['pangkat'] = $pegawai->pangkat;
                $response['data']['peserta'][$key]['golongan'] = $pegawai->golongan;
                $response['data']['peserta'][$key]['jabatan'] = $pegawai->jabatan;
                $response['data']['peserta'][$key]['unit_kerja'] = $pegawai->unit_kerja;

                //Kalau belum ada SPDnya
                //Simpan SPD
                if (! $sudahAdaSpd) {
                    $spd = new SuratPerjadin();
                    $spd->pagu_id = $suratTugas->kode_pagu;
                    $spd->surat_tugas_id = $suratTugas->st_id;
                    // $spd->no_spd = str_random(16);
                    $spd->no_spd = $suratTugas->pagu->anakSatker->nomor_spd . '/' . $suratTugas->pagu->tahun;
                    $spd->pegawai_id = $pegawai->pegawai_id;
                    $spd->nama_pegawai = $pegawai->nama;
                    $spd->nip = $pegawai->nip;
                    $spd->nama_pangkat = $pegawai->nama_pangkat;
                    $spd->golongan = $pegawai->golongan;
                    $spd->jabatan = $pegawai->jabatan;
                    $spd->tingkat_biaya = $pegawai->tingkat_perjadin;
                    $spd->maksud = $suratTugas->kegiatan->nama_kegiatan;
                    $spd->asal = 13;
                    $spd->kode_asal_berangkat = 13;
                    $spd->tujuan_dinas = $suratTugas->kegiatan->lokasi_kegiatan;
                    $spd->tanggal_awal = $suratTugas->kegiatan->tanggal_awal;
                    $spd->tanggal_akhir = $suratTugas->kegiatan->tanggal_akhir;
                    $spd->no_akun = $suratTugas->pagu->akun;
                    $spd->tempat_dikeluarkan_surat = 'Jakarta';
                    $spd->tanggal_spd = date('Y-m-d');
                    $spd->nama_ppk = $suratTugas->pagu->nm_ppk;
                    $spd->nip_ppk = $suratTugas->pagu->nip_ppk;

                    // dd($spd);
                    if (!$spd->save()) {
                        $message = 'Ups ada yang error';
                        return redirect()->back()->with($message);
                    }  
                }
            }
        }

        // return view('print.8jam-spd', compact('response'));
        $pdf = PDF::loadView('print.8jam-spd', compact('response'))->setPaper('legal', 'landscape');
        return @$pdf->stream('ST-' . $suratTugas->hashid . '.pdf');
    }
}
