<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\SuratPerjadinDataTable;
use Validator;
use Carbon\Carbon;
use App\Satker;
use App\SuratTugas;
use App\SuratPerjadin;
use App\Pegawai;
use App\TujuanDinas;
use Session;
use Hashids;
use PDF;

class SuratPerjadinController extends Controller
{
    //
    public function index(SuratPerjadinDataTable $dataTable)
    {
        return $dataTable->render('surat-perjadin.index');
    }

    public function create($st = null, $pegawai = null)
    {
        if ($st !== null) {
            $suratTugas = SuratTugas::find(Hashids::connection('st')->decode($st))[0];
        }

        if ($pegawai !== null) {
            $pegawai = Pegawai::find(Hashids::connection('pg')->decode($pegawai))[0];
        }

        //Cek apakah SPD telah dibuat
        $spd = SuratPerjadin::where('pegawai_id', $pegawai->pegawai_id)
                ->where('surat_tugas_id', $suratTugas->st_id)
                ->first();
        if (count($spd) > 0) {
            return redirect(url('spd/cetak/' . $spd->hashid));
        }

        // dd($suratTugas);
     //    $pejabat = Pegawai::all();
     //    $satker = Satker::all();

        $tujuan = TujuanDinas::all();

        $sejak = Carbon::createFromFormat('Y-m-d H:i:s', $suratTugas->tanggal_awal);
        $hingga = Carbon::createFromFormat('Y-m-d H:i:s', $suratTugas->tanggal_akhir);

        $lamaPerjalanan = $sejak->diffInDays($hingga)+1;

        $edit = 0;
        return view('surat-perjadin.create', compact('suratTugas', 'pegawai', 'pejabat', 'satker', 'lamaPerjalanan', 'tujuan', 'edit'));
    }

    public function edit(Request $request, $id)
    {
        $spd = SuratPerjadin::with('st')->findOrFail(Hashids::connection('spd')->decode($id)[0]);
        $suratTugas = $spd->st;
        $pegawai = $spd->pegawai;

        $tujuan = TujuanDinas::all();

        $sejak = Carbon::createFromFormat('Y-m-d H:i:s', $suratTugas->tanggal_awal);
        $hingga = Carbon::createFromFormat('Y-m-d H:i:s', $suratTugas->tanggal_akhir);

        $lamaPerjalanan = $sejak->diffInDays($hingga)+1;

        $edit = $spd->hashid;

        $tglSpd = $spd->tanggal_spd;

        return view('surat-perjadin.create', compact('suratTugas', 'pegawai', 'pejabat', 'satker', 'lamaPerjalanan', 'tujuan', 'edit', 'tglSpd', 'spd'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nomor_surat' => 'required',
            'id_pegawai' => 'required',
            // 'kelas_pegawai' => 'required|in:a,b,c,A,B,C',
            'maksud_perjadin' => 'required',
            'tempat_berangkat_perjadin' => 'required',
            'beban_instansi' => 'required',
            'beban_akun' => 'required',
            'tempat_dikeluarkan_surat' => 'required',
            'tgl_surat' => 'required',
            'pejabat' => 'required',
            'edit' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        // return response()->json(request());

        $pegawai = Pegawai::find($request->id_pegawai);
        $suratTugas = SuratTugas::find($request->st_id);

        if (!$pegawai) {
            $message = 'Pegawai tidak valid';
            return redirect()->back()
            ->with($message)
            ->withInput();
        }

        if ($request->edit != 0) {
            $spd = SuratPerjadin::findOrFail(Hashids::connection('spd')->decode($request->edit)[0]);
        }else{
            $spd = new SuratPerjadin();
        }

        $spd->pagu_id = $suratTugas->kode_pagu;
        $spd->surat_tugas_id = $suratTugas->st_id;
        $spd->no_spd = $request->nomor_surat;
        $spd->pegawai_id = $pegawai->pegawai_id;
        $spd->nama_pegawai = $pegawai->nama;
        $spd->nip = $pegawai->nip;
        $spd->nama_pangkat = $pegawai->nama_pangkat;
        $spd->golongan = $pegawai->golongan;
        $spd->jabatan = $pegawai->jabatan;
        $spd->tingkat_biaya = $pegawai->tingkat_perjadin;
        $spd->maksud = $suratTugas->kegiatan->nama_kegiatan;
        $spd->tipe_transport = $request->alat_angkutan;
        $spd->asal = $request->tempat_berangkat_perjadin;
        $spd->kode_asal_berangkat = $request->tempat_berangkat_perjadin;
        $spd->tujuan_dinas = $suratTugas->kegiatan->lokasi_kegiatan;
        $spd->durasi = $request->lama_perjalanan;
        $spd->tanggal_awal = $suratTugas->kegiatan->tanggal_awal;
        $spd->tanggal_akhir = $suratTugas->kegiatan->tanggal_akhir;
        $spd->no_akun = $suratTugas->pagu->akun;
        $spd->keterangan = $request->keterangan;
        $spd->tempat_dikeluarkan_surat = $request->tempat_dikeluarkan_surat;
        $spd->tanggal_spd = \App\Library\Datify::toDate($request->tgl_surat);
        $spd->nama_ppk = $suratTugas->pagu->nm_ppk;
        $spd->nip_ppk = $suratTugas->pagu->nip_ppk;

        // dd($spd);
        if (!$spd->save()) {
            $message = 'Ups ada yang error';
            return redirect()->back()->with($message);
        }

        Session::flash('message', 'Berhasil menyimpan SPD');
        Session::flash('alert-class', 'alert-success');

        return redirect(url('spd'));
    }

    public function cetak($id, Request $request)
    {
        // dd(Hashids::connection('spd')->decode($id));
        $spd = SuratPerjadin::findOrFail(Hashids::connection('spd')->decode($id)[0]);
        $pdf = PDF::loadView('print.spd', compact('spd'));
        return @$pdf->stream('SPD-'.$spd->hashid.'.pdf');
        // return view('print.spd', compact('spd'));
    }
}
