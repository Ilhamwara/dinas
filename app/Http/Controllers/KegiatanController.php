<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Kegiatan;
use App\TujuanDinas;
use App\TujuanDinasLuarNegeri;
use App\Satker;
use App\Pegawai;
use App\SuratTugas;
use App\DetailSuratTugas;
use App\AnakSatker;
use App\SuratPerjadin;
use App\DataTables\KegiatanDataTable;


class KegiatanController extends Controller
{
    //
    public function index(KegiatanDataTable $dataTable) {
        return $dataTable->render('kegiatan.index');
    }

    public function create()
    {
    	$satker = Satker::all();
        $tujuan = TujuanDinas::all();
        $pegawai = Pegawai::all();
        $anakSatker = AnakSatker::where('tahun', session('tahun'))->get();
    	return view('kegiatan.tambah', compact('satker', 'tujuan', 'pegawai', 'anakSatker'));
    }

    public function tambahKonsinyering(Request $request)
    {
        $satker = Satker::all();
        $tujuan = TujuanDinas::all();
        $pegawai = Pegawai::all();
        $anakSatker = AnakSatker::where('tahun', session('tahun'))->get();
        return view('kegiatan.tambahKonsinyering', compact('satker', 'tujuan', 'pegawai', 'anakSatker'));
    }

    public function createLuarNegeri()
    {
        $satker = Satker::all();
        $tujuan = TujuanDinasLuarNegeri::all();
        $pegawai = Pegawai::all();
        $anakSatker = AnakSatker::where('tahun', session('tahun'))->get();
        return view('kegiatan.tambah-kegiatan-luar-negeri', compact('satker', 'tujuan', 'pegawai', 'anakSatker'));
    }

    public function store(Request $r)
    {
    	$this->validate($r, [
    		'nama_kegiatan' => 'required',
    		'lokasi_kegiatan' => 'required',
    		'sejak' => 'required',
    		'hingga' => 'required'
    	]);

    	$kegiatan = new Kegiatan();
    	$kegiatan->nama_penyelenggara = $r->nama_penyelenggara;
    	$kegiatan->nama_kegiatan = $r->nama_kegiatan;
        $kegiatan->tujuan_id = TujuanDinas::find($r->lokasi_kegiatan)->id;
    	$kegiatan->lokasi_kegiatan = TujuanDinas::find($r->lokasi_kegiatan)->tujuan;
    	$kegiatan->tanggal_awal = \App\Library\Datify::toDate($r->sejak);
    	$kegiatan->tanggal_akhir = \App\Library\Datify::toDate($r->hingga);

    	if ($kegiatan->save()) {
    		Session::flash('message', 'Berhasil menambah kegiatan');
        	Session::flash('alert-class', 'alert-success');
    	}

    	return redirect('kegiatan');
    }

    public function storeAjax(Request $r)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];

        $this->validate($r, [
            'nama_kegiatan' => 'required',
            'lokasi_kegiatan' => 'required',
            'sejak' => 'required',
            'hingga' => 'required'
        ]);

        $kegiatan = new Kegiatan();
        $kegiatan->nama_penyelenggara = $r->nama_penyelenggara;
        $kegiatan->nama_kegiatan = $r->nama_kegiatan;
        $kegiatan->tujuan_id = TujuanDinas::find($r->lokasi_kegiatan)->id;
        $kegiatan->lokasi_kegiatan = TujuanDinas::find($r->lokasi_kegiatan)->tujuan;
        $kegiatan->tanggal_awal = \App\Library\Datify::toDate($r->sejak);
        $kegiatan->tanggal_akhir = \App\Library\Datify::toDate($r->hingga);


        if ($kegiatan->save()) {
            $response = [
                'status' => true,
                'data' => $kegiatan,
                'message' => 'Berhasil menimpan kegiatan'
            ];
            
        }

        return response()->json($response, 200);
    }

    public function storeAjaxKonsinyering(Request $r)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];

        $this->validate($r, [
            'nama_kegiatan' => 'required',
            'lokasi_kegiatan' => 'required',
            'sejak' => 'required',
            'hingga' => 'required'
        ]);

        $kegiatan = new Kegiatan();
        $kegiatan->nama_penyelenggara = $r->nama_penyelenggara;
        $kegiatan->nama_kegiatan = $r->nama_kegiatan;
        $kegiatan->jenis_kegiatan = 'konsinyering';
        $kegiatan->tujuan_id = TujuanDinas::find($r->lokasi_kegiatan)->id;
        $kegiatan->lokasi_kegiatan = TujuanDinas::find($r->lokasi_kegiatan)->tujuan;
        $kegiatan->tanggal_awal = \App\Library\Datify::toDate($r->sejak);
        $kegiatan->tanggal_akhir = \App\Library\Datify::toDate($r->hingga);


        if ($kegiatan->save()) {
            $response = [
                'status' => true,
                'data' => $kegiatan,
                'message' => 'Berhasil menimpan kegiatan'
            ];
            
        }

        return response()->json($response, 200);
    }

    public function detail($id)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];

        $kegiatan = Kegiatan::find($id);
        if (!$kegiatan) {
            $response['message'] = 'Kegiatan tidak ditemukan';
            return response()->json($response,404);
        }

        // dd($kegiatan->kegiatan_id);

        $response['status'] = true;
        $response['data']['kegiatan']['id'] = $kegiatan->kegiatan_id;
        $response['data']['kegiatan']['nama_kegiatan'] = $kegiatan->nama_kegiatan;
        $response['data']['kegiatan']['nama_penyelenggara'] = $kegiatan->nama_penyelenggara;
        $response['data']['kegiatan']['sejak'] = $kegiatan->tanggal_awal;
        $response['data']['kegiatan']['hingga'] = $kegiatan->tanggal_akhir;
        $response['data']['kegiatan']['lokasi_kegiatan'] = $kegiatan->lokasi_kegiatan;
        $response['data']['kegiatan']['jenis_kegiatan'] = $kegiatan->jenis_kegiatan;
        // $response['data']['kegiatan']['created_at'] = $kegiatan->created_at;
        // $response['data']['kegiatan']['updated_at'] = $kegiatan->updated_at;

        $suratTugas = SuratTugas::where('id_kegiatan', $kegiatan->kegiatan_id)->get();
        if ($suratTugas) {
            foreach ($suratTugas as $k => $v) {
                $response['data']['kegiatan']['surat_tugas'][$k]['st_id'] = $v->st_id;
                $response['data']['kegiatan']['surat_tugas'][$k]['no_st'] = $v->no_st;
                $response['data']['kegiatan']['surat_tugas'][$k]['nama_kegiatan'] = $v->nama_kegiatan;
                $response['data']['kegiatan']['surat_tugas'][$k]['id_kegiatan'] = $v->id_kegiatan;
                $response['data']['kegiatan']['surat_tugas'][$k]['tujuan_dinas'] = $v->tujuan_dinas;
                $response['data']['kegiatan']['surat_tugas'][$k]['tanggal_awal'] = \App\Library\Datify::readify(substr($v->tanggal_awal, 0, 10));
                $response['data']['kegiatan']['surat_tugas'][$k]['tanggal_akhir'] = \App\Library\Datify::readify(substr($v->tanggal_akhir, 0, 10));
                $response['data']['kegiatan']['surat_tugas'][$k]['tempat_dikeluarkan_surat'] = $v->tempat_dikeluarkan_surat;
                $response['data']['kegiatan']['surat_tugas'][$k]['tanggal_surat'] = \App\Library\Datify::readify(substr($v->tanggal_surat, 0, 10));
                $response['data']['kegiatan']['surat_tugas'][$k]['nama_inspektur'] = $v->nama_inspektur;
                $response['data']['kegiatan']['surat_tugas'][$k]['nip_inspektur'] = $v->nip_inspektur;

                //Peserta
                $detail = DetailSuratTugas::where('surat_tugas_id', $v->st_id)->get();
                if ($detail) {
                    foreach ($detail as $key => $value) {
                        $pegawai = Pegawai::find($value->pegawai_id);
                        $response['data']['kegiatan']['surat_tugas'][$k]['peserta'][$key]['id'] = $pegawai->pegawai_id;
                        $response['data']['kegiatan']['surat_tugas'][$k]['peserta'][$key]['nama'] = $pegawai->nama;
                        $response['data']['kegiatan']['surat_tugas'][$k]['peserta'][$key]['nip'] = $pegawai->nip;
                        $response['data']['kegiatan']['surat_tugas'][$k]['peserta'][$key]['pangkat'] = $pegawai->pangkat;
                        $response['data']['kegiatan']['surat_tugas'][$k]['peserta'][$key]['golongan'] = $pegawai->golongan;
                        $response['data']['kegiatan']['surat_tugas'][$k]['peserta'][$key]['jabatan'] = $pegawai->jabatan;
                        $response['data']['kegiatan']['surat_tugas'][$k]['peserta'][$key]['unit_kerja'] = $pegawai->unit_kerja;
                    }
                }

                //TODO: SPD
            }
        }

        return response()->json($response,200);
    }

    public function single($id)
    {
        $kegiatan = Kegiatan::find($id);
        if (!$kegiatan) {
            abort(404);
        }

        $tujuan = TujuanDinas::all();
        $pegawai = Pegawai::all();

        return view('kegiatan.single', compact('kegiatan', 'tujuan', 'pegawai'));
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::find($id);
        if (!$kegiatan) {
            abort(404);
        }

        $tujuan = TujuanDinas::all();
        $pegawai = Pegawai::all();

        return view('kegiatan.edit', compact('kegiatan', 'tujuan', 'pegawai'));
    }

    public function updateAjax(Request $r)
    {
        $response = [
            'status' => false,
            'data' => '',
            'message' => ''
        ];

        $this->validate($r, [
            'id' => 'required',
            'nama_kegiatan' => 'required',
            'lokasi_kegiatan' => 'required',
            'sejak' => 'required',
            'hingga' => 'required'
        ]);

        $kegiatan = Kegiatan::find($r->id);
        if (!$kegiatan) {
            $response['message'] = 'Kegiatan tidak ditemukan';
            return response()->json($response,404);
        }

        $kegiatan->nama_penyelenggara   = $r->nama_penyelenggara;
        $kegiatan->nama_kegiatan        = $r->nama_kegiatan;
        $kegiatan->lokasi_kegiatan      = TujuanDinas::find($r->lokasi_kegiatan)->tujuan;
        $kegiatan->tanggal_awal         = \App\Library\Datify::toDate($r->sejak);
        $kegiatan->tanggal_akhir        = \App\Library\Datify::toDate($r->hingga);
        
        $saveKegiatan = $kegiatan->save();

        //Update Surat Tugas
        $saveSuratTugas = SuratTugas::where('id_kegiatan', $kegiatan->kegiatan_id)
                                ->update([
                                    'nama_kegiatan'     => $r->nama_kegiatan,
                                    'tujuan_dinas'      => $kegiatan->lokasi_kegiatan,
                                    'tanggal_awal'      => $kegiatan->tanggal_awal,
                                    'tanggal_akhir'      => $kegiatan->tanggal_akhir
                                ]);

        if ($saveKegiatan && $saveSuratTugas) {
            $response = [
                'status' => true,
                'data' => $kegiatan,
                'message' => 'Berhasil menimpan kegiatan'
            ];   
        }

        return response()->json($response, 200);
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'kegiatan_id' => 'required'
        ]);

        $kegiatan = Kegiatan::find($request->kegiatan_id);
        if (!$kegiatan) {
            $response['message'] = 'Kegiatan tidak ditemukan';
            return response()->json($response,404);
        }
        $suratTugas = SuratTugas::where('id_kegiatan', $kegiatan->kegiatan_id)->get();
        if ($suratTugas) {
            foreach ($suratTugas as $key => $value) {
                $suratperjadin = SuratPerjadin::where('surat_tugas_id', $value->st_id)->delete();
            }
           SuratTugas::where('id_kegiatan', $kegiatan->kegiatan_id)->delete();
        }

        $kegiatan->delete();

        return redirect()->back();
    }

    public function tambahKegiatanKolektif(Request $request)
    {
        $satker = Satker::all();
        $tujuan = TujuanDinas::all();
        $pegawai = Pegawai::all();
        $anakSatker = AnakSatker::where('tahun', session('tahun'))->get();
        return view('kegiatan-kolektif.tambah-kegiatan', compact('satker', 'tujuan', 'pegawai', 'anakSatker'));
    }

    public function tambahKegiatan8Jam(Request $request)
    {
        $satker = Satker::all();
        $tujuan = TujuanDinas::all();
        $pegawai = Pegawai::all();
        $anakSatker = AnakSatker::where('tahun', session('tahun'))->get();
        return view('kegiatan.tambah-kegiatan-dalam-kota-8-jam', compact('satker', 'tujuan', 'pegawai', 'anakSatker'));
    }

    public function storeAjax8Jam(Request $r)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];

        $this->validate($r, [
            'nama_kegiatan' => 'required',
            'lokasi_kegiatan' => 'required',
            'sejak' => 'required',
            'hingga' => 'required'
        ]);

        $kegiatan = new Kegiatan();
        $kegiatan->nama_penyelenggara = $r->nama_penyelenggara;
        $kegiatan->nama_kegiatan = $r->nama_kegiatan;
        $kegiatan->jenis_kegiatan = 'dalam_kota_8jam';
        $kegiatan->tujuan_id = TujuanDinas::find($r->lokasi_kegiatan)->id;
        $kegiatan->lokasi_kegiatan = TujuanDinas::find($r->lokasi_kegiatan)->tujuan;
        $kegiatan->tanggal_awal = \App\Library\Datify::toDate($r->sejak);
        $kegiatan->tanggal_akhir = \App\Library\Datify::toDate($r->hingga);


        if ($kegiatan->save()) {
            $response = [
                'status' => true,
                'data' => $kegiatan,
                'message' => 'Berhasil menimpan kegiatan'
            ];
            
        }

        return response()->json($response, 200);
    }

    public function storeAjaxLuarNegeri(Request $r)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];

        $this->validate($r, [
            'nama_kegiatan' => 'required',
            'lokasi_kegiatan' => 'required',
            'sejak' => 'required',
            'hingga' => 'required'
        ]);

        $kegiatan = new Kegiatan();
        $kegiatan->nama_penyelenggara = $r->nama_penyelenggara;
        $kegiatan->nama_kegiatan = $r->nama_kegiatan;
        $kegiatan->jenis_kegiatan = 'luar_negeri';
        $kegiatan->tujuan_id = TujuanDinasLuarNegeri::find($r->lokasi_kegiatan)->id;
        $kegiatan->lokasi_kegiatan = TujuanDinasLuarNegeri::find($r->lokasi_kegiatan)->tujuan;
        $kegiatan->tanggal_awal = \App\Library\Datify::toDate($r->sejak);
        $kegiatan->tanggal_akhir = \App\Library\Datify::toDate($r->hingga);


        if ($kegiatan->save()) {
            $response = [
                'status' => true,
                'data' => $kegiatan,
                'message' => 'Berhasil menyimpan kegiatan'
            ];
            
        }

        return response()->json($response, 200);
    }
}
