<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Nominatif;
use App\SuratPerjadin;
use App\SuratTugas;
use App\DataTables\NominatifDataTable;
use App\Laporan;
use Session;

class NominatifController extends Controller
{
    //

	public function index(NominatifDataTable $dataTable)
	{
		return $dataTable->render('nominatif.index');
	}
	public function tambah()
	{
		return view('nominatif.tambah');
	}

	public function cetak($id, Request $request)
	{


		$response = [
			'status' => false,
			'data' => [],
			'message' => ''
		];

		$suratTugas = SuratTugas::find($id);
		if (!$suratTugas) {
			$response['message'] = 'Surat Tugas tidak ditemukan';
			return response()->json($response, 404);
		}

		//Cek Laporan
		$laporan = Laporan::where('surat_tugas_id', $suratTugas->st_id)->count();
		if ($laporan < 1) {
			$response['message'] = 'Perjalanan ini belum dilaporkan';

			Session::flash('pesan_error', 'Perjalanan ini belum dilaporkan');

			return redirect()->back();
			return response()->json($response, 404);
		}


		$spd = SuratPerjadin::with(
			'st',
			'pegawai',
			'pengeluaranLumpsum',
			'pengeluaranPenginapan',
			'pengeluaranRepresentatif',
			'pengeluaranRiil',
			'pengeluaranTerbayar',
			'pengeluaranTransport',
			'pengeluaranUangHarian'
		)->where('surat_tugas_id', $suratTugas->st_id)->get();
		
		if (count($spd) == 0) {
			$response['message'] = 'Belum ada spd yang dibuat pada surat tugas ini';
			return response()->json($response, 200);
		}

		$response['status'] = true;
		$response['data'] = $spd;

		// return response()->json($response, 200);
		// return view('print.nominatif', compact('response'));
		$pdf = PDF::loadView('print.nominatif', compact('response'))->setPaper('legal', 'landscape');
        return @$pdf->stream('Nominatif' . '.pdf');
	}
}
