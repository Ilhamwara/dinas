<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Hashids;
use PDF;
use Validator;

//Library
use App\Library\Terbilang;

//Model
use App\PengeluaranRepresentatif;
use App\PengeluaranPenginapan;
use App\PengeluaranUangHarian;
use App\PengeluaranTransport;
use App\PengeluaranLumpsum;
use App\UangRepresentatif;
use App\UangHarianRapat;
use App\PengeluaranRiil;
use App\UangHarianBiasa;
use App\UangPenginapan;
use App\UangTaksi;
use App\PengeluaranTerbayar;
use App\SuratPerjadin;
use App\TujuanDinas;
use App\SuratTugas;
use App\Referensi;
use App\PengeluaranRapat8Jam;
use App\Kegiatan;
use App\Pegawai;
use App\Rincian;
use App\Pagu;
use App\User;
use App\Laporan;

class RincianBiayaController extends Controller
{
	public function index()
	{
		return view('rincian-biaya.index');
	}

	public function show($id, Request $request)
	{

	}

	public function create($spd_id, Request $request)
	{
		$response = [
			'status' => false,
			'message' => ''
		];

		$id = Hashids::connection('spd')->decode($spd_id);
		if (count($id) != 1) {
			abort(404);
			// $response['message'] = 'SPD Tidak valid';
			// return response()->json($response,404);
		}

		//TODO: Check if the rincian is already created

		$spd = SuratPerjadin::find($id[0]);

		if (!$spd) {
			$response['message'] = 'SPD Tidak valid';
			return response()->json($response,404);
		}

		//Cek kegiatan apakah kegiatan biasa atau 8 jam
		if($spd->st->kegiatan->jenis_kegiatan == 'dalam_kota_8jam'){
			return $this->rincianBiaya8Jam($spd->st);
		}elseif($spd->st->kegiatan->jenis_kegiatan == 'luar_negeri'){
			return $this->rincianBiayaLuarNegeri($spd);
		}

		$response['status'] = true;

		//SPD
		$response['data']['spd_id'] = $spd->spd_id;
		$response['data']['hashid'] = $spd->hashid;
		$response['data']['nomor_spd'] = $spd->no_spd;
		$response['data']['tempat_surat'] = $spd->tempat_dikeluarkan_surat;
		$response['data']['tanggal_surat'] = $spd->tanggal_spd;
		$response['data']['nama_ppk'] = $spd->nama_ppk;
		$response['data']['nip_ppk'] = $spd->nip_ppk;

        //Pegawai
		$response['data']['pegawai']['id'] = $spd->pegawai->pegawai_id;
		$response['data']['pegawai']['hashid'] = $spd->pegawai->hashid;
		$response['data']['pegawai']['nama'] = $spd->pegawai->nama;
		$response['data']['pegawai']['nip'] = $spd->pegawai->nip;
		$response['data']['pegawai']['unit_kerja'] = $spd->pegawai->unit_kerja;
		$response['data']['pegawai']['pns'] = $spd->pegawai->pns;
		$response['data']['pegawai']['golongan'] = $spd->pegawai->golongan;
		$response['data']['pegawai']['pangkat'] = $spd->pegawai->pangkat;
		$response['data']['pegawai']['nama_pangkat'] = $spd->pegawai->nama_pangkat;
		$response['data']['pegawai']['jabatan'] = $spd->pegawai->jabatan;
		$response['data']['pegawai']['eselon'] = $spd->pegawai->eselon;
		$response['data']['pegawai']['pejabat_negara'] = $spd->pegawai->pejabat_negara;
		$response['data']['pegawai']['tingkat_perjadin'] = $spd->pegawai->tingkat_perjadin;

        //Kegiatan
		$response['data']['kegiatan']['id'] = $spd->st->kegiatan->kegiatan_id;
		$response['data']['kegiatan']['tujuan_id'] = $spd->st->kegiatan->tujuan_id;
		$response['data']['kegiatan']['nama_kegiatan'] = $spd->st->kegiatan->nama_kegiatan;
		$response['data']['kegiatan']['nama_penyelenggara'] = $spd->st->kegiatan->nama_penyelenggara;
		$response['data']['kegiatan']['lokasi_kegiatan'] = $spd->st->kegiatan->lokasi_kegiatan;
		$response['data']['kegiatan']['sejak'] = $spd->st->kegiatan->tanggal_awal;
		$response['data']['kegiatan']['hingga'] = $spd->st->kegiatan->tanggal_akhir;

        //Surat Tugas
		$response['data']['surat_tugas']['id'] = $spd->st->st_id;
		$response['data']['surat_tugas']['hashid'] = $spd->st->hashid;
		$response['data']['surat_tugas']['nomor_surat'] = $spd->st->no_st;
		$response['data']['surat_tugas']['tempat_surat'] = $spd->st->tempat_dikeluarkan_surat;
		$response['data']['surat_tugas']['tanggal_surat'] = $spd->st->tanggal_surat;
		$response['data']['surat_tugas']['nama_penanggungjawab'] = $spd->st->nama_inspektur;
		$response['data']['surat_tugas']['nip_penanggungjawab'] = $spd->st->nip_inspektur;

        //Pagu
		$response['data']['pagu']['id'] = $spd->st->pagu->id;
		$response['data']['pagu']['tahun'] = $spd->st->pagu->tahun;
		$response['data']['pagu']['nama_ppk'] = $spd->st->pagu->nm_ppk;
		$response['data']['pagu']['nip_ppk'] = $spd->st->pagu->nip_ppk;
		$response['data']['pagu']['nama_bendahara'] = $spd->st->pagu->nm_bendahara;
		$response['data']['pagu']['nip_bendahara'] = $spd->st->pagu->nip_bendahara;
		$response['data']['pagu']['program'] = $spd->st->pagu->program;
		$response['data']['pagu']['kegiatan'] = $spd->st->pagu->kegiatan;
		$response['data']['pagu']['output'] = $spd->st->pagu->output;
		$response['data']['pagu']['akun'] = $spd->st->pagu->akun;
		$response['data']['pagu']['uraian_akun'] = $spd->st->pagu->uraian_akun;
		$response['data']['pagu']['jumlah_pagu'] = $spd->st->pagu->jumlah_pagu;
		$response['data']['pagu']['terealisasi_pagu'] = $spd->st->pagu->terealisasi_pagu;
		$response['data']['pagu']['sisa_pagu'] = $spd->st->pagu->sisa_pagu;

		//Data Rincian yang sudah tersimpan
		$response['data']['rincian']['lumpsum'] = PengeluaranLumpsum::where('spd_id', $spd->spd_id)->first();
		$response['data']['rincian']['uang_harian'] = PengeluaranUangHarian::where('spd_id', $spd->spd_id)->first();
		$response['data']['rincian']['tiket_pp'] = PengeluaranTransport::where('spd_id', $spd->spd_id)->where('jenis', 'tiket_pp')->first();
		$response['data']['rincian']['airport_tax'] = PengeluaranTransport::where('spd_id', $spd->spd_id)->where('jenis', 'airport_tax')->first();
		$response['data']['rincian']['lainnya'] = PengeluaranTransport::where('spd_id', $spd->spd_id)->where('jenis', 'lainnya')->first();
        $response['data']['rincian']['penginapan'] = PengeluaranPenginapan::where('spd_id', $spd->spd_id)->get();
        $response['data']['rincian']['representatif'] = PengeluaranRepresentatif::where('spd_id', $spd->spd_id)->first();
        $response['data']['rincian']['riil'] = PengeluaranRiil::where('spd_id', $spd->spd_id)->get();

		//Referensi Penginapan
		$response['data']['referensi']['uang_penginapan'] = $this->cekPenginapan($spd->pegawai->pegawai_id, $spd->st->kegiatan->tujuan_id)['harga'];

		//Uang Taksi Asal
		$response['data']['referensi']['uang_taksi_asal'] = UangTaksi::where('tujuan_id', $spd->asal)->first()->jumlah;

		//Uang Taksi Tujuan
		$response['data']['referensi']['uang_taksi_tujuan'] = UangTaksi::where('tujuan_id', $spd->st->kegiatan->tujuan_id)->first()->jumlah;

		//Referensi Uang Harian
		$response['data']['referensi']['uang_harian'] = UangHarianBiasa::where('tujuan_id', $spd->st->kegiatan->tujuan_id)->first();

		//Referensi Uang Rapat
		$response['data']['referensi']['uang_rapat'] = UangHarianRapat::where('tujuan_id', $spd->st->kegiatan->tujuan_id)->first();
		
		//Referensi Uang Representatif
		if ($spd->pegawai->eselon == '2') {
			$response['data']['referensi']['uang_representatif'] = UangRepresentatif::where('uraian_representatif', 'Pejabat Eselon II')->first();
		}elseif ($spd->pegawai->eselon == '1') {
			$response['data']['referensi']['uang_representatif'] = UangRepresentatif::where('uraian_representatif', 'Pejabat Eselon I')->first();
		}elseif ($spd->pegawai->pejabat_negara == 'Y') {
			$response['data']['referensi']['uang_representatif'] = UangRepresentatif::where('uraian_representatif', 'Pejabat Negara')->first();
		}else{
			$response['data']['referensi']['uang_representatif'] = '0';
		}

		//Terbayar
		$terbayar = PengeluaranTerbayar::where('spd_id', $spd->spd_id)->first();
		$response['data']['terbayar'] = (count($terbayar) > 0) ? $terbayar->terbayar : 0;

        return view('rincian-biaya.create', compact('response'));
	}

	public function store(Request $request)
	{
		// dd(request()->all());
		
		$response = [
			'status' => false,
			'data' => [],
			'message' => ''
		];

		$validator = Validator::make($request->all(), [
			'spd_id' => 'required'
		]);

		if ($validator->fails()) {
			$response['message'] = 'Validasi salah';
			return response()->json($response, 400);
		}

		$spd_id = Hashids::connection('spd')->decode($request->spd_id);
		if (count($spd_id) != 1) {
			abort(404);
		}

		// dd($request);
		//SPD
		$spd = SuratPerjadin::findOrFail($spd_id[0]);
		if (!$spd) {
			$response['message'] = 'SPD tidak valid';
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

		//Apakah pegawai bersangkutan memiliki akun
		$user_pegawai = User::where('pegawai_id', $pegawai->pegawai_id)->first();

		//Lumpsum
		$subtotal_lumpsum = $this->simpanLumpsum($request, $spd, $pegawai, $surat_tugas, $kegiatan, $pagu, $tujuan, $user_pegawai);

        //Uang Harian
		$subtotal_uang_harian = $this->simpanUangHarian($request, $spd, $pegawai, $surat_tugas, $kegiatan, $pagu, $tujuan, $user_pegawai);

        //Uang representatif
		$subtotal_representatif = $this->simpanRepresentatif($request, $spd, $pegawai, $surat_tugas, $kegiatan, $pagu, $tujuan, $user_pegawai);

        //Uang Tiket
		$subtotal_tiket = $this->simpanTiket($request, $spd, $pegawai, $surat_tugas, $kegiatan, $pagu, $tujuan, $user_pegawai);

        //Uang Airport Tax
		$subtotal_airport = $this->simpanAitportTax($request, $spd, $pegawai, $surat_tugas, $kegiatan, $pagu, $tujuan, $user_pegawai);

        //Uang Lainnya
		$subtotal_lainnya = $this->simpanLainnya($request, $spd, $pegawai, $surat_tugas, $kegiatan, $pagu, $tujuan, $user_pegawai);

        //Uang Penginapan
		$subtotal_penginapan = $this->simpanPenginapan($request, $spd, $pegawai, $surat_tugas, $kegiatan, $pagu, $tujuan, $user_pegawai);


		//Terbayar
		if (null != $request->terbayar && $request->terbayar > 0) {
			$terbayar = PengeluaranTerbayar::updateOrCreate(
				['spd_id' => $spd->spd_id],
				['spd_id' => $spd->spd_id, 'pagu_id' => $spd->st->pagu->id, 'st_id' => $spd->st->st_id, 'terbayar' => $request->terbayar]
			);

			//Kurangi Pagu
			$paguSekarang = Pagu::findOrFail($spd->st->pagu->id);

			$paguBaru = $paguSekarang->doBayar();
		}

		Session::flash('message', 'Berhasil menyimpan Rincian biaya');
        Session::flash('alert-class', 'alert-success');

        return redirect(url('surat-tugas'));
	}

	public function simpanLumpsum($request, $spd, $pegawai, $surat_tugas, $kegiatan, $pagu, $tujuan, $user_pegawai)
	{
		$sub_total = 0;

		if (null != $request->qty_lumpsum && $request->qty_lumpsum != 0) {
			/*
			|	Periksa apakah pengeluaran lumpsum sudah ada
			|	Bila belum ada, maka buat instance baru.
			|	Bila sudah ada, update yang sudah ada.
			*/

			$pengeluaran_lumpsum = PengeluaranLumpsum::where('spd_id', $spd->spd_id)->first();
			
			if (! $pengeluaran_lumpsum) {
				$pengeluaran_lumpsum = new PengeluaranLumpsum();
			}

			$ref_lumpsum = UangHarianBiasa::where('tujuan_id', $spd->st->kegiatan->tujuan_id)->first();	
			$pengeluaran_lumpsum->spd_id = $spd->spd_id;
			$pengeluaran_lumpsum->pegawai_id = $pegawai->pegawai_id;
			$pengeluaran_lumpsum->pegawai_nama = $pegawai->nama;
			$pengeluaran_lumpsum->pegawai_gol = $pegawai->golongan;
			$pengeluaran_lumpsum->pegawai_pangkat = $pegawai->pangkat;
			$pengeluaran_lumpsum->pegawai_tingkat_perjadin = $pegawai->tingkat_perjadin;
			$pengeluaran_lumpsum->pegawai_pns = $pegawai->pns;
			$pengeluaran_lumpsum->pegawai_eselon = $pegawai->eselon;
			$pengeluaran_lumpsum->pegawai_pejabat_negara = $pegawai->pejabat_negara;
			$pengeluaran_lumpsum->pegawai_pejabat_negara_lainnya = $pegawai->pejabat_negara_lainnya;
			$pengeluaran_lumpsum->pegawai_nip = $pegawai->nip;
			$pengeluaran_lumpsum->pegawai_user = (count($user_pegawai) > 0) ? $user_pegawai->id : null;
			$pengeluaran_lumpsum->kegiatan_id = $kegiatan->kegiatan_id;
			$pengeluaran_lumpsum->kegiatan_sejak = $kegiatan->tanggal_awal;
			$pengeluaran_lumpsum->kegiatan_hingga = $kegiatan->tanggal_awal;
			$pengeluaran_lumpsum->surat_tugas_id = $surat_tugas->st_id;
			$pengeluaran_lumpsum->pagu_id = $pagu->id;
			$pengeluaran_lumpsum->nip_ppk = $pagu->nip_ppk;
			$pengeluaran_lumpsum->nm_ppk = $pagu->nm_ppk;
			$pengeluaran_lumpsum->nip_bendahara = $pagu->nip_bendahara;
			$pengeluaran_lumpsum->nm_bendahara = $pagu->nm_bendahara;
			$pengeluaran_lumpsum->kode_kegiatan = $pagu->kegiatan;
			$pengeluaran_lumpsum->kode_output = $pagu->output;
			$pengeluaran_lumpsum->kode_akun = $pagu->akun;
			$pengeluaran_lumpsum->kode_anak_satker = $pagu->anakSatker->kode;
			// $pengeluaran_lumpsum->satker_id = $;
			$pengeluaran_lumpsum->tujuan_id = $tujuan->id;
			$pengeluaran_lumpsum->ref_id = $ref_lumpsum->id;
			$pengeluaran_lumpsum->ref_max = $ref_lumpsum->luar_kota;
			$pengeluaran_lumpsum->tahun = $pagu->tahun;
			$pengeluaran_lumpsum->qty = $request->qty_lumpsum;
			$pengeluaran_lumpsum->sub_total = $ref_lumpsum->luar_kota * $request->qty_lumpsum;
			$pengeluaran_lumpsum->keterangan = $request->keterangan_lumpsum;

			// dd($pengeluaran_lumpsum);
			if(!$pengeluaran_lumpsum->save()){
				abort(500);
			}

			$sub_total = $pengeluaran_lumpsum->sub_total;
		}

		
		return $sub_total;
	}

	public function simpanUangHarian($request, $spd, $pegawai, $surat_tugas, $kegiatan, $pagu, $tujuan, $user_pegawai)
	{
		// dd($request);
		$sub_total = 0;
		if (null != $request->uang_harian_qty && $request->uang_harian_qty != 0) {

			/*
			|	Periksa apakah pengeluaran harian sudah ada
			|	Bila belum ada, maka buat instance baru.
			|	Bila sudah ada, update yang sudah ada.
			*/
			$pengeluaran_harian = PengeluaranUangHarian::where('spd_id', $spd->spd_id)->first();
			if (! $pengeluaran_harian) {
				$pengeluaran_harian = new PengeluaranUangHarian();
			}

			$pengeluaran_harian->spd_id = $spd->spd_id;
			$pengeluaran_harian->pegawai_id = $pegawai->pegawai_id;
			$pengeluaran_harian->pegawai_nama = $pegawai->nama;
			$pengeluaran_harian->pegawai_gol = $pegawai->golongan;
			$pengeluaran_harian->pegawai_pangkat = $pegawai->pangkat;
			$pengeluaran_harian->pegawai_tingkat_perjadin = $pegawai->tingkat_perjadin;
			$pengeluaran_harian->pegawai_pns = $pegawai->pns;
			$pengeluaran_harian->pegawai_eselon = $pegawai->eselon;
			$pengeluaran_harian->pegawai_pejabat_negara = $pegawai->pejabat_negara;
			$pengeluaran_harian->pegawai_pejabat_negara_lainnya = $pegawai->pejabat_negara_lainnya;
			$pengeluaran_harian->pegawai_nip = $pegawai->nip;
			$pengeluaran_harian->pegawai_user = (count($user_pegawai) > 0) ? $user_pegawai->id : null;
			$pengeluaran_harian->kegiatan_id = $kegiatan->kegiatan_id;
			$pengeluaran_harian->kegiatan_sejak = $kegiatan->tanggal_awal;
			$pengeluaran_harian->kegiatan_hingga = $kegiatan->tanggal_awal;
			$pengeluaran_harian->surat_tugas_id = $surat_tugas->st_id;
			$pengeluaran_harian->pagu_id = $pagu->id;
			$pengeluaran_harian->nip_ppk = $pagu->nip_ppk;
			$pengeluaran_harian->nm_ppk = $pagu->nm_ppk;
			$pengeluaran_harian->nip_bendahara = $pagu->nip_bendahara;
			$pengeluaran_harian->nm_bendahara = $pagu->nm_bendahara;
			$pengeluaran_harian->kode_kegiatan = $pagu->kegiatan;
			$pengeluaran_harian->kode_output = $pagu->output;
			$pengeluaran_harian->kode_akun = $pagu->akun;
			$pengeluaran_harian->kode_anak_satker = $pagu->anakSatker->kode;
			
			$pengeluaran_harian->tujuan_id = $tujuan->id;
			$pengeluaran_harian->jenis_referensi = $request->jenis_uang_harian;
			$pengeluaran_harian->ref_max = $request->uang_harian_jenis;
			$pengeluaran_harian->tahun = $pagu->tahun;
			$pengeluaran_harian->qty = $request->uang_harian_qty;
			$pengeluaran_harian->sub_total = $request->uang_harian_jenis * $request->uang_harian_qty;
			$pengeluaran_harian->keterangan = $request->uang_harian_keterangan;

			if(!$pengeluaran_harian->save()){
				abort(500);
			}

			$sub_total = $pengeluaran_harian->sub_total;
		}
		
		return $sub_total;
	}

	public function simpanRepresentatif($request, $spd, $pegawai, $surat_tugas, $kegiatan, $pagu, $tujuan, $user_pegawai)
	{
		$sub_total = 0;
		if (null != $request->representatif_qty && $request->representatif_qty != 0) {

			/*
			|	Periksa apakah pengeluaran representatif sudah ada
			|	Bila belum ada, maka buat instance baru.
			|	Bila sudah ada, update yang sudah ada.
			*/
			$pengeluaran_representatif = PengeluaranRepresentatif::where('spd_id', $spd->spd_id)->first();
			if (! $pengeluaran_representatif) {
				$pengeluaran_representatif = new PengeluaranRepresentatif();
			}

			$pengeluaran_representatif->spd_id = $spd->spd_id;
			$pengeluaran_representatif->pegawai_id = $pegawai->pegawai_id;
			$pengeluaran_representatif->pegawai_nama = $pegawai->nama;
			$pengeluaran_representatif->pegawai_gol = $pegawai->golongan;
			$pengeluaran_representatif->pegawai_pangkat = $pegawai->pangkat;
			$pengeluaran_representatif->pegawai_tingkat_perjadin = $pegawai->tingkat_perjadin;
			$pengeluaran_representatif->pegawai_pns = $pegawai->pns;
			$pengeluaran_representatif->pegawai_eselon = $pegawai->eselon;
			$pengeluaran_representatif->pegawai_pejabat_negara = $pegawai->pejabat_negara;
			$pengeluaran_representatif->pegawai_pejabat_negara_lainnya = $pegawai->pejabat_negara_lainnya;
			$pengeluaran_representatif->pegawai_nip = $pegawai->nip;
			$pengeluaran_representatif->pegawai_user = (count($user_pegawai) > 0) ? $user_pegawai->id : null;
			$pengeluaran_representatif->kegiatan_id = $kegiatan->kegiatan_id;
			$pengeluaran_representatif->kegiatan_sejak = $kegiatan->tanggal_awal;
			$pengeluaran_representatif->kegiatan_hingga = $kegiatan->tanggal_awal;
			$pengeluaran_representatif->surat_tugas_id = $surat_tugas->st_id;
			$pengeluaran_representatif->pagu_id = $pagu->id;
			$pengeluaran_representatif->nip_ppk = $pagu->nip_ppk;
			$pengeluaran_representatif->nm_ppk = $pagu->nm_ppk;
			$pengeluaran_representatif->nip_bendahara = $pagu->nip_bendahara;
			$pengeluaran_representatif->nm_bendahara = $pagu->nm_bendahara;
			$pengeluaran_representatif->kode_kegiatan = $pagu->kegiatan;
			$pengeluaran_representatif->kode_output = $pagu->output;
			$pengeluaran_representatif->kode_akun = $pagu->akun;
			$pengeluaran_representatif->kode_anak_satker = $pagu->anakSatker->kode;
			

			//Referensi Uang Representatif
			if ($pegawai->eselon == '2') {
				$ref_representatif = UangRepresentatif::where('uraian_representatif', 'Pejabat Eselon II')->first();
				
				$pengeluaran_representatif->jenis_referensi = $ref_representatif->uraian_representatif;
				$pengeluaran_representatif->ref_max = $request->uang_harian_jenis;
				$pengeluaran_representatif->qty = $request->representatif_qty;
				$pengeluaran_representatif->sub_total = $request->representatif_qty * $ref_representatif->ur_lukot;

			}elseif ($pegawai->eselon == '1') {
				$ref_representatif = UangRepresentatif::where('uraian_representatif', 'Pejabat Eselon I')->first();
				$pengeluaran_representatif->jenis_referensi = $ref_representatif->uraian_representatif;
				$pengeluaran_representatif->ref_max = $request->uang_harian_jenis;
				$pengeluaran_representatif->qty = $request->representatif_qty;
				$pengeluaran_representatif->sub_total = $request->representatif_qty * $ref_representatif->ur_lukot;

			}elseif ($pegawai->pejabat_negara == 'Y') {
				$ref_representatif = UangRepresentatif::where('uraian_representatif', 'Pejabat Negara')->first();
				$pengeluaran_representatif->jenis_referensi = $ref_representatif->uraian_representatif;
				$pengeluaran_representatif->ref_max = $request->uang_harian_jenis;
				$pengeluaran_representatif->qty = $request->representatif_qty;
				$pengeluaran_representatif->sub_total = $request->representatif_qty * $ref_representatif->ur_lukot;

			}else{
				$pengeluaran_representatif->jenis_referensi = 0;
				$pengeluaran_representatif->ref_max = 0;
				$pengeluaran_representatif->qty = 0;
				$pengeluaran_representatif->sub_total = 0;
			}

			$pengeluaran_representatif->tujuan_id = $tujuan->id;
			$pengeluaran_representatif->tahun = $pagu->tahun;
			$pengeluaran_representatif->keterangan = $request->representatif_keterangan;

			// dd($pengeluaran_representatif);
			if(!$pengeluaran_representatif->save()){
				abort(500);
			}

			$sub_total = $pengeluaran_representatif->sub_total;
		}

		return $sub_total;
	}

	public function simpanTiket($request, $spd, $pegawai, $surat_tugas, $kegiatan, $pagu, $tujuan, $user_pegawai)
	{
		$sub_total = 0;
		if (null != $request->tiket_pp && $request->tiket_pp != 0) {

			/*
			|	Periksa apakah pengeluaran representatif sudah ada
			|	Bila belum ada, maka buat instance baru.
			|	Bila sudah ada, update yang sudah ada.
			*/
			$pengeluaran_transport = PengeluaranTransport::where('spd_id', $spd->spd_id)->where('jenis', 'tiket_pp')->first();
			if (! $pengeluaran_transport) {
				$pengeluaran_transport = new PengeluaranTransport();
			}

			$pengeluaran_transport->spd_id = $spd->spd_id;
			$pengeluaran_transport->pegawai_id = $pegawai->pegawai_id;
			$pengeluaran_transport->pegawai_nama = $pegawai->nama;
			$pengeluaran_transport->pegawai_gol = $pegawai->golongan;
			$pengeluaran_transport->pegawai_pangkat = $pegawai->pangkat;
			$pengeluaran_transport->pegawai_tingkat_perjadin = $pegawai->tingkat_perjadin;
			$pengeluaran_transport->pegawai_pns = $pegawai->pns;
			$pengeluaran_transport->pegawai_eselon = $pegawai->eselon;
			$pengeluaran_transport->pegawai_pejabat_negara = $pegawai->pejabat_negara;
			$pengeluaran_transport->pegawai_pejabat_negara_lainnya = $pegawai->pejabat_negara_lainnya;
			$pengeluaran_transport->pegawai_nip = $pegawai->nip;
			$pengeluaran_transport->pegawai_user = (count($user_pegawai) > 0) ? $user_pegawai->id : null;
			$pengeluaran_transport->kegiatan_id = $kegiatan->kegiatan_id;
			$pengeluaran_transport->kegiatan_sejak = $kegiatan->tanggal_awal;
			$pengeluaran_transport->kegiatan_hingga = $kegiatan->tanggal_awal;
			$pengeluaran_transport->surat_tugas_id = $surat_tugas->st_id;
			$pengeluaran_transport->pagu_id = $pagu->id;
			$pengeluaran_transport->nip_ppk = $pagu->nip_ppk;
			$pengeluaran_transport->nm_ppk = $pagu->nm_ppk;
			$pengeluaran_transport->nip_bendahara = $pagu->nip_bendahara;
			$pengeluaran_transport->nm_bendahara = $pagu->nm_bendahara;
			$pengeluaran_transport->kode_kegiatan = $pagu->kegiatan;
			$pengeluaran_transport->kode_output = $pagu->output;
			$pengeluaran_transport->kode_akun = $pagu->akun;
			$pengeluaran_transport->kode_anak_satker = $pagu->anakSatker->kode;
			$pengeluaran_transport->tujuan_id = $tujuan->id;
			$pengeluaran_transport->tahun = $pagu->tahun;
			
			$pengeluaran_transport->jenis = 'tiket_pp';
			$pengeluaran_transport->sub_total = $request->tiket_pp;

			$pengeluaran_transport->keterangan = $request->keterangan_lainnya;

			// dd($pengeluaran_transport);
			if(!$pengeluaran_transport->save()){
				abort(500);
			}

			$sub_total = $pengeluaran_transport->sub_total;
		}

		return $sub_total;
	}

	public function simpanAitportTax($request, $spd, $pegawai, $surat_tugas, $kegiatan, $pagu, $tujuan, $user_pegawai)
	{
		$sub_total = 0;
		if (null != $request->airport_tax && $request->airport_tax != 0) {

			/*
			|	Periksa apakah pengeluaran representatif sudah ada
			|	Bila belum ada, maka buat instance baru.
			|	Bila sudah ada, update yang sudah ada.
			*/
			$pengeluaran_transport = PengeluaranTransport::where('spd_id', $spd->spd_id)->where('jenis', 'airport_tax')->first();
			if (! $pengeluaran_transport) {
				$pengeluaran_transport = new PengeluaranTransport();
			}

			$pengeluaran_transport->spd_id = $spd->spd_id;
			$pengeluaran_transport->pegawai_id = $pegawai->pegawai_id;
			$pengeluaran_transport->pegawai_nama = $pegawai->nama;
			$pengeluaran_transport->pegawai_gol = $pegawai->golongan;
			$pengeluaran_transport->pegawai_pangkat = $pegawai->pangkat;
			$pengeluaran_transport->pegawai_tingkat_perjadin = $pegawai->tingkat_perjadin;
			$pengeluaran_transport->pegawai_pns = $pegawai->pns;
			$pengeluaran_transport->pegawai_eselon = $pegawai->eselon;
			$pengeluaran_transport->pegawai_pejabat_negara = $pegawai->pejabat_negara;
			$pengeluaran_transport->pegawai_pejabat_negara_lainnya = $pegawai->pejabat_negara_lainnya;
			$pengeluaran_transport->pegawai_nip = $pegawai->nip;
			$pengeluaran_transport->pegawai_user = (count($user_pegawai) > 0) ? $user_pegawai->id : null;
			$pengeluaran_transport->kegiatan_id = $kegiatan->kegiatan_id;
			$pengeluaran_transport->kegiatan_sejak = $kegiatan->tanggal_awal;
			$pengeluaran_transport->kegiatan_hingga = $kegiatan->tanggal_awal;
			$pengeluaran_transport->surat_tugas_id = $surat_tugas->st_id;
			$pengeluaran_transport->pagu_id = $pagu->id;
			$pengeluaran_transport->nip_ppk = $pagu->nip_ppk;
			$pengeluaran_transport->nm_ppk = $pagu->nm_ppk;
			$pengeluaran_transport->nip_bendahara = $pagu->nip_bendahara;
			$pengeluaran_transport->nm_bendahara = $pagu->nm_bendahara;
			$pengeluaran_transport->kode_kegiatan = $pagu->kegiatan;
			$pengeluaran_transport->kode_output = $pagu->output;
			$pengeluaran_transport->kode_akun = $pagu->akun;
			$pengeluaran_transport->kode_anak_satker = $pagu->anakSatker->kode;
			$pengeluaran_transport->tujuan_id = $tujuan->id;
			$pengeluaran_transport->tahun = $pagu->tahun;
			
			$pengeluaran_transport->jenis = 'airport_tax';
			$pengeluaran_transport->sub_total = $request->airport_tax;

			$pengeluaran_transport->keterangan = $request->keterangan_lainnya;

			// dd($pengeluaran_transport);
			if(!$pengeluaran_transport->save()){
				abort(500);
			}

			$sub_total = $pengeluaran_transport->sub_total;
		}

		return $sub_total;
	}

	public function simpanLainnya($request, $spd, $pegawai, $surat_tugas, $kegiatan, $pagu, $tujuan, $user_pegawai)
	{
		$sub_total = 0;
		if (null != $request->lainnya && $request->lainnya != 0) {

			/*
			|	Periksa apakah pengeluaran representatif sudah ada
			|	Bila belum ada, maka buat instance baru.
			|	Bila sudah ada, update yang sudah ada.
			*/
			$pengeluaran_transport = PengeluaranTransport::where('spd_id', $spd->spd_id)->where('jenis', 'lainnya')->first();
			if (! $pengeluaran_transport) {
				$pengeluaran_transport = new PengeluaranTransport();
			}

			$pengeluaran_transport->spd_id = $spd->spd_id;
			$pengeluaran_transport->pegawai_id = $pegawai->pegawai_id;
			$pengeluaran_transport->pegawai_nama = $pegawai->nama;
			$pengeluaran_transport->pegawai_gol = $pegawai->golongan;
			$pengeluaran_transport->pegawai_pangkat = $pegawai->pangkat;
			$pengeluaran_transport->pegawai_tingkat_perjadin = $pegawai->tingkat_perjadin;
			$pengeluaran_transport->pegawai_pns = $pegawai->pns;
			$pengeluaran_transport->pegawai_eselon = $pegawai->eselon;
			$pengeluaran_transport->pegawai_pejabat_negara = $pegawai->pejabat_negara;
			$pengeluaran_transport->pegawai_pejabat_negara_lainnya = $pegawai->pejabat_negara_lainnya;
			$pengeluaran_transport->pegawai_nip = $pegawai->nip;
			$pengeluaran_transport->pegawai_user = (count($user_pegawai) > 0) ? $user_pegawai->id : null;
			$pengeluaran_transport->kegiatan_id = $kegiatan->kegiatan_id;
			$pengeluaran_transport->kegiatan_sejak = $kegiatan->tanggal_awal;
			$pengeluaran_transport->kegiatan_hingga = $kegiatan->tanggal_awal;
			$pengeluaran_transport->surat_tugas_id = $surat_tugas->st_id;
			$pengeluaran_transport->pagu_id = $pagu->id;
			$pengeluaran_transport->nip_ppk = $pagu->nip_ppk;
			$pengeluaran_transport->nm_ppk = $pagu->nm_ppk;
			$pengeluaran_transport->nip_bendahara = $pagu->nip_bendahara;
			$pengeluaran_transport->nm_bendahara = $pagu->nm_bendahara;
			$pengeluaran_transport->kode_kegiatan = $pagu->kegiatan;
			$pengeluaran_transport->kode_output = $pagu->output;
			$pengeluaran_transport->kode_akun = $pagu->akun;
			$pengeluaran_transport->kode_anak_satker = $pagu->anakSatker->kode;
			$pengeluaran_transport->tujuan_id = $tujuan->id;
			$pengeluaran_transport->tahun = $pagu->tahun;
			
			$pengeluaran_transport->jenis = 'lainnya';
			$pengeluaran_transport->sub_total = $request->lainnya;

			$pengeluaran_transport->keterangan = $request->keterangan_lainnya;

			// dd($pengeluaran_transport);
			if(!$pengeluaran_transport->save()){
				abort(500);
			}

			$sub_total = $pengeluaran_transport->sub_total;
		}

		return $sub_total;
	}

	public function simpanPenginapan($request, $spd, $pegawai, $surat_tugas, $kegiatan, $pagu, $tujuan, $user_pegawai)
	{
		$sub_total = 0;

		if (null != $request->qty_penginapan && is_array($request->qty_penginapan)) {
			for ($i=0; $i < count($request->qty_penginapan) ; $i++) { 
				if ($request->qty_penginapan[$i] != 0 AND $request->harga_penginapan[$i] != 0) {
					
					$ref_penginapan = $this->cekPenginapan($pegawai->pegawai_id, $tujuan->id);

					$pengeluaran_penginapan = new PengeluaranPenginapan();

					if (isset($request->old[$i]) && $request->old[$i] != null) {
						$cekInside = PengeluaranPenginapan::find($request->old[$i]);
						if ($cekInside) {
							$pengeluaran_penginapan	= $cekInside;
						}
					}

					$pengeluaran_penginapan->spd_id = $spd->spd_id;
					$pengeluaran_penginapan->pegawai_id = $pegawai->pegawai_id;
					$pengeluaran_penginapan->pegawai_nama = $pegawai->nama;
					$pengeluaran_penginapan->pegawai_gol = $pegawai->golongan;
					$pengeluaran_penginapan->pegawai_pangkat = $pegawai->pangkat;
					$pengeluaran_penginapan->pegawai_tingkat_perjadin = $pegawai->tingkat_perjadin;
					$pengeluaran_penginapan->pegawai_pns = $pegawai->pns;
					$pengeluaran_penginapan->pegawai_eselon = $pegawai->eselon;
					$pengeluaran_penginapan->pegawai_pejabat_negara = $pegawai->pejabat_negara;
					$pengeluaran_penginapan->pegawai_pejabat_negara_lainnya = $pegawai->pejabat_negara_lainnya;
					$pengeluaran_penginapan->pegawai_nip = $pegawai->nip;
					$pengeluaran_penginapan->pegawai_user = (count($user_pegawai) > 0) ? $user_pegawai->id : null;
					$pengeluaran_penginapan->kegiatan_id = $kegiatan->kegiatan_id;
					$pengeluaran_penginapan->kegiatan_sejak = $kegiatan->tanggal_awal;
					$pengeluaran_penginapan->kegiatan_hingga = $kegiatan->tanggal_awal;
					$pengeluaran_penginapan->surat_tugas_id = $surat_tugas->st_id;
					$pengeluaran_penginapan->pagu_id = $pagu->id;
					$pengeluaran_penginapan->nip_ppk = $pagu->nip_ppk;
					$pengeluaran_penginapan->nm_ppk = $pagu->nm_ppk;
					$pengeluaran_penginapan->nip_bendahara = $pagu->nip_bendahara;
					$pengeluaran_penginapan->nm_bendahara = $pagu->nm_bendahara;
					$pengeluaran_penginapan->kode_kegiatan = $pagu->kegiatan;
					$pengeluaran_penginapan->kode_output = $pagu->output;
					$pengeluaran_penginapan->kode_akun = $pagu->akun;
					$pengeluaran_penginapan->kode_anak_satker = $pagu->anakSatker->kode;
					// $pengeluaran_penginapan->satker_id = $;
					$pengeluaran_penginapan->tujuan_id = $tujuan->id;
					$pengeluaran_penginapan->ref_id = $ref_penginapan['penginapan']->id;
					$pengeluaran_penginapan->ref_max = $ref_penginapan['harga'];
					$pengeluaran_penginapan->tahun = $pagu->tahun;
					$pengeluaran_penginapan->qty = $request->qty_penginapan[$i];
					$pengeluaran_penginapan->harga_satuan = $request->harga_penginapan[$i];
					$pengeluaran_penginapan->sub_total = (($request->harga_penginapan[$i] < $ref_penginapan['harga']) ? $request->harga_penginapan[$i] : $ref_penginapan['harga']) * $request->qty_penginapan[$i];

					// dd($pengeluaran_penginapan);
					if(!$pengeluaran_penginapan->save()){
						abort(500);
					}

					$sub_total += $pengeluaran_penginapan->sub_total;
				}
			}
		}

		return $sub_total;
	}

	public function simpanRiil(Request $r)
	{
		$sub_total = 0;
		$response = [
			'status' => false,
			'data' => [],
			'message' => ''
		];

		$validator = Validator::make($r->all(), [
			'spd_id' => 'required',
			'jenis' => 'required',
			'sub_total' => 'required'
		]);

		if ($validator->fails()) {
			$response['message'] = $validator->messages();
			return response()->json($response, 400);
		}

		$id = Hashids::connection('spd')->decode($r->spd_id);
		if (count($id) != 1) {
			$response['message'] = 'SPD Tidak valid';
			return response()->json($response,404);
		}

		//TODO: Check if the rincian is already created
		$spd = SuratPerjadin::find($id[0]);

		if (!$spd) {
			$response['message'] = 'SPD Tidak valid';
			return response()->json($response,404);
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

		//Apakah pegawai bersangkutan memiliki akun
		$user_pegawai = User::where('pegawai_id', $pegawai->pegawai_id)->first();

		if ($r->jenis != null AND $r->sub_total != 0) {

			$pengeluaran_riil = new PengeluaranRiil();

			$pengeluaran_riil->spd_id = $spd->spd_id;
			$pengeluaran_riil->pegawai_id = $pegawai->pegawai_id;
			$pengeluaran_riil->pegawai_nama = $pegawai->nama;
			$pengeluaran_riil->pegawai_gol = $pegawai->golongan;
			$pengeluaran_riil->pegawai_pangkat = $pegawai->pangkat;
			$pengeluaran_riil->pegawai_tingkat_perjadin = $pegawai->tingkat_perjadin;
			$pengeluaran_riil->pegawai_pns = $pegawai->pns;
			$pengeluaran_riil->pegawai_eselon = $pegawai->eselon;
			$pengeluaran_riil->pegawai_pejabat_negara = $pegawai->pejabat_negara;
			$pengeluaran_riil->pegawai_pejabat_negara_lainnya = $pegawai->pejabat_negara_lainnya;
			$pengeluaran_riil->pegawai_nip = $pegawai->nip;
			$pengeluaran_riil->pegawai_user = (count($user_pegawai) > 0) ? $user_pegawai->id : null;
			$pengeluaran_riil->kegiatan_id = $kegiatan->kegiatan_id;
			$pengeluaran_riil->kegiatan_sejak = $kegiatan->tanggal_awal;
			$pengeluaran_riil->kegiatan_hingga = $kegiatan->tanggal_awal;
			$pengeluaran_riil->surat_tugas_id = $surat_tugas->st_id;
			$pengeluaran_riil->pagu_id = $pagu->id;
			$pengeluaran_riil->nip_ppk = $pagu->nip_ppk;
			$pengeluaran_riil->nm_ppk = $pagu->nm_ppk;
			$pengeluaran_riil->nip_bendahara = $pagu->nip_bendahara;
			$pengeluaran_riil->nm_bendahara = $pagu->nm_bendahara;
			$pengeluaran_riil->kode_kegiatan = $pagu->kegiatan;
			$pengeluaran_riil->kode_output = $pagu->output;
			$pengeluaran_riil->kode_akun = $pagu->akun;
			$pengeluaran_riil->kode_anak_satker = $pagu->anakSatker->kode;
			$pengeluaran_riil->tujuan_id = $tujuan->id;
			$pengeluaran_riil->tahun = $pagu->tahun;
			
			$pengeluaran_riil->jenis = $r->jenis;
			$pengeluaran_riil->qty = $r->qty_riil;
			$pengeluaran_riil->harga_satuan = $r->harga;
			$pengeluaran_riil->ref_max = $r->max;
			$pengeluaran_riil->sub_total = $r->sub_total;

			// dd($pengeluaran_riil);
			if(!$pengeluaran_riil->save()){
				$response['message'] = 'Gagal menyimpan ';
				return response()->json($response, 500);
			}
		}

		$response['status'] = true;
		$response['data'] = $pengeluaran_riil;
		return response()->json($response, 200);
	}

	public function cekPenginapan($pegawai_id, $tujuan_id)
	{
		$pegawai = Pegawai::find($pegawai_id);
		$tujuan = TujuanDinas::find($tujuan_id);

		//Referensi Uang Penginapan
		if ($pegawai->pns == 'PNS') {
			if ($pegawai->golongan == 'I' OR $pegawai->golongan == 'II') {
				$penginapan = UangPenginapan::where('tujuan_id', $tujuan->id)->first();
				$harga = (count($penginapan) > 0) ? $penginapan->golongan_satudua : 0;

			}elseif($pegawai->eselon == '4'){
				$penginapan = UangPenginapan::where('tujuan_id', $tujuan->id)->first();
				$harga = (count($penginapan) > 0) ? $penginapan->eselonempat_goltiga : 0;

			}elseif($pegawai->golongan == 'III'){
				$penginapan = UangPenginapan::where('tujuan_id', $tujuan->id)->first();			
				$harga = (count($penginapan) > 0) ? $penginapan->eselonempat_goltiga : 0;

			}elseif($pegawai->eselon == '3'){
				$penginapan = UangPenginapan::where('tujuan_id', $tujuan->id)->first();
				$harga = (count($penginapan) > 0) ? $penginapan->eselontiga_golempat : 0;

			}elseif($pegawai->golongan == 'IV'){
				$penginapan = UangPenginapan::where('tujuan_id', $tujuan->id)->first();
				$harga = (count($penginapan) > 0) ? $penginapan->eselontiga_golempat : 0;

			}elseif($pegawai->pejabat_negara_lainnya == 'Y'){
				$penginapan = UangPenginapan::where('tujuan_id', $tujuan->id)->first();
				$harga = (count($penginapan) > 0) ? $penginapan->eselon_dua : 0;

			}elseif($pegawai->eselon == '2'){
				$penginapan = UangPenginapan::where('tujuan_id', $tujuan->id)->first();
				$harga = (count($penginapan) > 0) ? $penginapan->eselon_dua : 0;

			}elseif($pegawai->pejabat_negara == 'Y'){
				$penginapan = UangPenginapan::where('tujuan_id', $tujuan->id)->first();
				$harga = (count($penginapan) > 0) ? $penginapan->eselon_satu : 0;

			}else{
				// $pegawai->eselon == '1'
				$penginapan = UangPenginapan::where('tujuan_id', $tujuan->id)->first();
				$harga = (count($penginapan) > 0) ? $penginapan->eselon_satu : 0;
			}

		}else{
			if ($pegawai->tingkat_perjadin == 'C'){
				$penginapan = UangPenginapan::where('tujuan_id', $tujuan->id)->first();
				$harga = (count($penginapan) > 0) ? $penginapan->eselontiga_golempat : 0;

			}elseif ($pegawai->tingkat_perjadin == 'C2'){
				$penginapan = UangPenginapan::where('tujuan_id', $tujuan->id)->first();
				$harga = (count($penginapan) > 0) ? $penginapan->eselonempat_goltiga : 0;

			}else{
				$penginapan = UangPenginapan::where('tujuan_id', $tujuan->id)->first();
				$harga = (count($penginapan) > 0) ? $penginapan->golongan_satudua : 0;
			}
		}

		return ['penginapan' => $penginapan, 'harga' => $harga];
	}

	public function hapusPenginapan(Request $r)
	{
		$response = [
			'status' => false,
			'data' => [],
			'message' => ''
		];

		$validator = Validator::make($r->all(), [
			'id' => 'required'
		]);

		if ($validator->fails()) {
			$response['message'] = $validator->messages();
			return response()->json($response, 400);
		}

		$pengeluaran_penginapan = PengeluaranPenginapan::find($r->id);
		if (!$pengeluaran_penginapan) {
			$response['message'] = 'Data tidak ditemukan';
			return response()->json($response, 404);
		}

		if($pengeluaran_penginapan->delete())
		{
			$response['status'] = true;
			$response['message'] = 'Berhasil menghapus pengeluaran';
		}

		return response()->json($response, 200);
	}

	public function hapusRiil(Request $r)
	{
		$response = [
			'status' => false,
			'data' => [],
			'message' => ''
		];

		$validator = Validator::make($r->all(), [
			'id' => 'required'
		]);

		if ($validator->fails()) {
			$response['message'] = $validator->messages();
			return response()->json($response, 400);
		}

		$pengeluaran_riil = PengeluaranRiil::find($r->id);
		if (!$pengeluaran_riil) {
			$response['message'] = 'Data tidak ditemukan';
			return response()->json($response, 404);
		}

		if($pengeluaran_riil->delete())
		{
			$response['status'] = true;
			$response['message'] = 'Berhasil menghapus pengeluaran';
		}

		return response()->json($response, 200);
	}

	public function cetak($spd_id, Request $request)
	{
		$response = [
			'status' => false,
			'data' => [],
			'message' => ''
		];

		$spd_id = Hashids::connection('spd')->decode($request->spd_id);
		if (count($spd_id) != 1) {
			abort(404);
		}

		// dd($request);
		//SPD
		$spd = SuratPerjadin::with(
			'pengeluaranLumpsum',
			'pengeluaranPenginapan',
			'pengeluaranRepresentatif',
			'pengeluaranRiil',
			'pengeluaranTerbayar',
			'pengeluaranTransport',
			'pengeluaranUangHarian'
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
		// return view('print.rincianbiaya', compact('response'));
		$pdf = PDF::loadView('print.rincianbiaya', compact('response'));
        return @$pdf->stream('Rincin Biaya-' . '.pdf');
	}

	public function rincianBiaya8Jam($st)
	{
		$response = [
			'status' => false,
			'data' => [],
			'message' => ''
		];

		// dd($st->kegiatan);
		$ref = UangHarianRapat::where('tujuan_id', $st->kegiatan->tujuan_id)->first();
		if (count($ref) == 0) {
			$response['message'] = 'Referensi biaya perjalanan 8 Jam ini tidak ditemukan';
			return response()->json($response, 200);
		}

		$response['data']['referensi'] = $ref->fullboard_dakot;
		$response['data']['st'] = $st;

		foreach ($st->detail as $key => $value) {
			$response['data']['pegawai'][] = Pegawai::findOrFail($value->pegawai_id);	
		}

		$response['data']['existingPengeluaran'] = [];
		$checkExisting = PengeluaranRapat8Jam::where('surat_tugas_id', $st->st_id)->get();
		if (count($checkExisting) > 0) {
		 	foreach ($checkExisting as $key => $value) {
		 		$response['data']['existingPengeluaran'][$key] = $value->pegawai_id;
		 	}
		}

		// return response()->json($response, 200);
		return view('rincian-biaya.rincian-8jam', compact('response'));
	}

	public function save8Jam(Request $request) {
		$response = [
			'status' => false,
			'data' => [],
			'message' => ''
		];

		$validator = Validator::make($request->all(), [
			'st_id' => 'required'
		]);

		if ($validator->fails()) {
			$response['message'] = 'Validasi salah';
			return response()->json($response, 400);
		}

		$st_id = Hashids::connection('st')->decode($request->st_id);
		if (count($st_id) != 1) {
			$response['message'] = 'Surat Tugas tidak valid';
			return response()->json($response);
		}

		//ST
		$st = SuratTugas::findOrFail($st_id[0]);
		if (!$st) {
			$response['message'] = 'Surat Tugas tidak valid';
			return response()->json($response);
		}

		$ref = UangHarianRapat::where('tujuan_id', $st->kegiatan->tujuan_id)->first();
		if (count($ref) == 0) {
			$response['message'] = 'Referensi biaya perjalanan 8 Jam ini tidak ditemukan';
			return response()->json($response, 200);
		}

		// dd($request);
		//Cek jumlah Pegawai yang akan disimpan
		$existingPengeluaran = [];
		$existingTerbayar = [];
		if (null != $request->pg_id && is_array($request->pg_id) && count($request->pg_id) > 0) {
			foreach ($request->pg_id as $key => $value) {

				//PEGAWAI
				$pegawai_id = Hashids::connection('pg')->decode($value);
				if (count($pegawai_id) != 1) {
					$response['message'] = 'Pegawai ke:' . $key+1 . ' Tidak ditemukan';
					return response()->json($response);
				}

				$pegawai = Pegawai::findOrFail($pegawai_id[0]);
				if (!$pegawai) {
					$response['message'] = 'Pegawai Tidak ditemukan';
					return response()->json($response);
				}
				//Apakah pegawai bersangkutan memiliki akun
				// dd($pegawai->nama);
				$user_pegawai = User::where('pegawai_id', $pegawai->pegawai_id)->first();
				
				$spd = SuratPerjadin::where('pegawai_id', $pegawai->pegawai_id)->where('surat_tugas_id', $st->st_id)->first();

				$pengeluaran_8jam = PengeluaranRapat8Jam::where('spd_id', $spd->spd_id)->first();
				if (! $pengeluaran_8jam) {
					$pengeluaran_8jam = new PengeluaranRapat8Jam();
				}

				$pengeluaran_8jam->spd_id = $spd->spd_id;
				$pengeluaran_8jam->pegawai_id = $pegawai->pegawai_id;
				$pengeluaran_8jam->pegawai_nama = $pegawai->nama;
				$pengeluaran_8jam->pegawai_gol = $pegawai->golongan;
				$pengeluaran_8jam->pegawai_pangkat = $pegawai->pangkat;
				$pengeluaran_8jam->pegawai_tingkat_perjadin = $pegawai->tingkat_perjadin;
				$pengeluaran_8jam->pegawai_pns = $pegawai->pns;
				$pengeluaran_8jam->pegawai_eselon = $pegawai->eselon;
				$pengeluaran_8jam->pegawai_pejabat_negara = $pegawai->pejabat_negara;
				$pengeluaran_8jam->pegawai_pejabat_negara_lainnya = $pegawai->pejabat_negara_lainnya;
				$pengeluaran_8jam->pegawai_nip = $pegawai->nip;
				$pengeluaran_8jam->pegawai_user = (count($user_pegawai) > 0) ? $user_pegawai->id : null;
				$pengeluaran_8jam->kegiatan_id = $st->kegiatan->kegiatan_id;
				$pengeluaran_8jam->kegiatan_sejak = $st->kegiatan->tanggal_awal;
				$pengeluaran_8jam->kegiatan_hingga = $st->kegiatan->tanggal_awal;
				$pengeluaran_8jam->surat_tugas_id = $st->st_id;
				$pengeluaran_8jam->pagu_id = $st->pagu->id;
				$pengeluaran_8jam->nip_ppk = $st->pagu->nip_ppk;
				$pengeluaran_8jam->nm_ppk = $st->pagu->nm_ppk;
				$pengeluaran_8jam->nip_bendahara = $st->pagu->nip_bendahara;
				$pengeluaran_8jam->nm_bendahara = $st->pagu->nm_bendahara;
				$pengeluaran_8jam->kode_kegiatan = $st->pagu->kegiatan;
				$pengeluaran_8jam->kode_output = $st->pagu->output;
				$pengeluaran_8jam->kode_akun = $st->pagu->akun;
				$pengeluaran_8jam->kode_anak_satker = $st->pagu->anakSatker->kode;
				
				$pengeluaran_8jam->tujuan_id = $st->kegiatan->tujuan_id;
				$pengeluaran_8jam->jenis_referensi = 'Uang Rapat 8 Jam';
				$pengeluaran_8jam->ref_max = $ref->fullboard_dakot;
				$pengeluaran_8jam->tahun = $st->pagu->tahun;
				$pengeluaran_8jam->qty = 1;
				$pengeluaran_8jam->sub_total = $ref->fullboard_dakot;

				if(!$pengeluaran_8jam->save()){
					abort(500);
				}

				//INSERT TERBAYAR
				$terbayar = PengeluaranTerbayar::updateOrCreate(
					['spd_id' => $spd->spd_id],
					['spd_id' => $spd->spd_id, 'pagu_id' => $spd->st->pagu->id, 'st_id' => $st->st_id, 'terbayar' => $ref->fullboard_dakot]
				);

				$existingTerbayar[$key] = $terbayar->id;
				$existingPengeluaran[$key] = $pengeluaran_8jam->id; 
			}

			//Hapus pengeluaran yang tidak dicheck
			PengeluaranRapat8Jam::where('surat_tugas_id', $st->st_id)->whereNotIn('id', $existingPengeluaran)->delete();

            //Hapus Terbayar yang tidak dicheck
			PengeluaranTerbayar::where('st_id', $st->st_id)->whereNotIn('id', $existingTerbayar)->delete();

			//Hitung & Kurangi Pagu
			$paguSekarang = Pagu::findOrFail($st->pagu->id);
			$paguBaru = $paguSekarang->doBayar();

			Session::flash('message', 'Berhasil menyimpan Rincian biaya');
        	Session::flash('alert-class', 'alert-success');

        	return redirect(url('spd'));
		}else{
			$response['message'] = 'Tidak ada yang menerima uang rapat?';
			return response()->json($response, 404);
		}
	}


	//Luar Negeri
	public function rincianBiayaLuarNegeri($spd)
	{
		// return $spd;
		return view('rincian-biaya.rincian-biaya-luar-negeri', compact('spd'));
	}

	//Cetak Tanda Terima 8 Jam
	public function cetakTandaTerima8Jam($st)
	{
		$response = [
			'status' => false,
			'data' => [],
			'message' => ''
		];


		$st_id = Hashids::connection('st')->decode($st);
		if (count($st_id) < 1) {
			$response['message'] = 'Surat Tugas tidak valid';
			return response()->json($response, 404);	
		}

		//Surat Tugas
		$st = SuratTugas::findOrFail($st_id[0]);
		if (!$st) {
			$response['message'] = 'Surat Tugas tidak valid';
			return response()->json($response, 404);
		}

		// dd($st->kegiatan);
		$ref = UangHarianRapat::where('tujuan_id', $st->kegiatan->tujuan_id)->first();
		if (count($ref) == 0) {
			$response['message'] = 'Referensi biaya perjalanan 8 Jam ini tidak ditemukan';
			return response()->json($response, 200);
		}

		$response['data']['referensi'] = $ref->fullboard_dakot;
		$response['data']['st'] = $st;

		foreach ($st->detail as $key => $value) {
			$response['data']['pegawai'][] = Pegawai::findOrFail($value->pegawai_id);	
		}

		$response['data']['existingPengeluaran'] = [];
		$checkExisting = PengeluaranRapat8Jam::where('surat_tugas_id', $st->st_id)->get();
		if (count($checkExisting) > 0) {
		 	foreach ($checkExisting as $key => $value) {
		 		$response['data']['existingPengeluaran'][$key] = $value->pegawai_id;
		 	}
		}

		// return response()->json($response, 200);
		// return view('print.tanda-terima-8jam', compact('response'));
		$pdf = PDF::loadView('print.tanda-terima-8jam', compact('response'))->setPaper('legal', 'landscape');
        return @$pdf->stream('Tanda Terima-' . $st->hashid . '.pdf');
	}
}
