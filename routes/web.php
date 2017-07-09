<?php
// use Hash;
Route::get('genPassword', function()
{
	return Hash::make('Pasword1');
});
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::post('customlogin', ['as'=> 'customlogin', 'uses' => 'MyCustomController@authenticate']);

Route::get('/', function () {
	return redirect('login');
});



Route::get('view-print', ['as' => 'view-print', function() {
	return view('view-print');
}]);

Route::get('biaya-print', ['as' => 'biaya-print', function() {
	return view('print.rincianbiaya');
}]);


/*
|--------------------------------------------------------------------------
|  ADMSPK MIDDLEWARE
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['admSpk']], function(){
//Pegawai
	Route::get('pegawai', 				['as' => 'pegawai', 			'uses' => 'PegawaiController@index']);
	Route::get('pegawaii', 				['as' => 'pegawaii', 			'uses' => 'PegawaiController@indexx']);
	Route::get('pegawai/tambah', 		['as' => 'pegawai.tambah.get', 	'uses' => 'PegawaiController@create']);
	Route::post('pegawai/tambah', 		['as' => 'pegawai.tambah.post', 'uses' => 'PegawaiController@save']);
	Route::post('pegawai/simpanAjax', 	['as' => 'pegawai.ajax.post',   'uses' => 'PegawaiController@saveAjax']);
	
	Route::get('pegawai/edit/{id}', 	['as' => 'pegawai.edit.get', 	'uses' => 'PegawaiController@edit']);
	Route::post('pegawai/edit/{id}', 	['as' => 'pegawai.edit.post', 	'uses' => 'PegawaiController@update']);
	Route::get('pegawai/profile/{id}', 	['as' => 'pegawai.profile', 	'uses' => 'PegawaiController@show']);
	
//SATKER
	Route::get('satker', ['as' => 'satker', 'uses' => 'SatkerController@index']);
	
//KEGIATAN
	Route::get('kegiatan', 				['as' => 'kegiatan', 					'uses' => 'KegiatanController@index']);
	Route::get('kegiatan/detail/{id}', 	['as' => 'kegiatan.detail', 			'uses' => 'KegiatanController@detail']);
	Route::get('kegiatan/single/{id}', 	['as' => 'kegiatan.single', 			'uses' => 'KegiatanController@single']);
	Route::get('kegiatan/tambah', 		['as' => 'kegiatan.tambah', 			'uses' => 'KegiatanController@create']);
	Route::get('kegiatan-luar-negeri/tambah', 		['as' => 'kegiatan.tambah.luar.negeri', 			'uses' => 'KegiatanController@createLuarNegeri']);
	Route::get('kegiatan/edit/{id}',	['as' => 'kegiatan.edit', 				'uses' => 'KegiatanController@edit']);
	Route::post('kegiatan/tambah', 		['as' => 'kegiatan.tambah.post', 		'uses' => 'KegiatanController@store']);
	Route::post('kegiatan/updateajax', 	['as' => 'kegiatan.updateajax', 		'uses' => 'KegiatanController@updateAjax']);
	Route::post('kegiatan/tambahajax', 	['as' => 'kegiatan.tambah.post.ajax', 	'uses' => 'KegiatanController@storeAjax']);
	Route::post('hapuskegiatan', 		['as' => 'kegiatan.hapus', 				'uses' => 'KegiatanController@destroy']);

//KEGIATAN KOLEKTIF
	Route::get('kegiatan-kolektif/tambah',	['as' => 'kegiatan.kolektif.tambah', 'uses' => 'KegiatanController@tambahKegiatanKolektif']);

	Route::get('kegiatan-dinas-dalam-kota-8-jam/tambah',	['as' => 'kegiatan.8.jam.tambah', 'uses' => 'KegiatanController@tambahKegiatan8Jam']);
	Route::post('kegiatan/tambahajax_8_jam', 	['as' => 'kegiatan.tambah.post.ajax.8.jam', 	'uses' => 'KegiatanController@storeAjax8Jam']);

//KEGIATAN LUAR NEGERI
	Route::post('kegiatan/tambahajax_luar_negeri', 	['as' => 'kegiatan.tambah.post.ajax.luar.negeri', 	'uses' => 'KegiatanController@storeAjaxLuarNegeri']);

//KONSINYERING
	Route::get('konsinyering/tambah', ['as' => 'konsinyering.tambah', 'uses' => 'KegiatanController@tambahKonsinyering']);
	Route::post('kegiatan/tambahajaxkonsinyering', 	['as' => 'kegiatan.tambah.post.ajax', 	'uses' => 'KegiatanController@storeAjaxKonsinyering']);

//SURAT TUGAS
	// Route::get('surat-tugas', 							['as' => 'surat-tugas', 					'uses' => 'SuratTugasController@index']);
	// Route::get('surat-tugas/cetak/{id}', 				['as' => 'surat-tugas.cetak', 				'uses' => 'SuratTugasController@cetak']);
	Route::get('surat-tugas/tambah/{kegiatan?}', 		['as' => 'surat-tugas.tambah', 				'uses' => 'SuratTugasController@create']);
	Route::post('surat-tugas/tambah/{kegiatan?}', 		['as' => 'surat-tugas.tambah.post', 		'uses' => 'SuratTugasController@store']);
	Route::post('surat-tugas/tambahajax', 				['as' => 'surat-tugas.tambah.post.ajax', 	'uses' => 'SuratTugasController@storeAjax']);
	// Route::get('surat-tugas/{id}', 						['as' => 'surat-tugas.show', 				'uses' => 'SuratTugasController@showAjax']);

//SURAT PERJADIN
	//Route::get('spd', 								['as' => 'spd', 				'uses' => 'SuratPerjadinController@index']);
	Route::get('spd/create/{st?}/{pegawai?}', 		['as' => 'spd.create.get', 		'uses' => 'SuratPerjadinController@create']);
	Route::get('spd/cetak/{id}', 					['as' => 'spd.cetak', 			'uses' => 'SuratPerjadinController@cetak']);
	Route::get('spd/edit/{id}', 					['as' => 'spd.edit', 			'uses' => 'SuratPerjadinController@edit']);
	// Route::post('spd/create/{st?}/{pegawai?}', 		['as' => 'spd.create.post', 	'uses' => 'SuratPerjadinController@store']);
	Route::post('spd/store', 						['as' => 'store', 				'uses' => 'SuratPerjadinController@store']);
	Route::get('cetak-spd', function(){
		return view('print.spd');
	});

//PANGKAT GOL
	Route::get('pangkatgol/search', ['as' => 'pangkatgol', 	'uses' => 'PangkatGolController@search']);

//RINCIAN BIAYA PERJADIN
	Route::get('rincian-biaya/create/{spd_id}',	 	['as' => 'rincian-biaya.create',			'uses' 	=> 'RincianBiayaController@create']);
	Route::post('rincian-biaya/create/{spd_id}',	['as' => 'rincian-biaya.post',				'uses' 	=> 'RincianBiayaController@save8Jam']);
	Route::get('rincian-biaya/cetak/{spd_id}',	 	['as' => 'rincian-biaya.cetak',				'uses' 	=> 'RincianBiayaController@cetak']);
	Route::get('biaya-perjalanan-dinas',		 	['as' => 'biaya-perjalanan-dinas',			'uses' 	=> 'RincianBiayaController@index']);
	Route::post('rincian-biaya',			 		['as' => 'rincian-biaya.store',				'uses' 	=> 'RincianBiayaController@store']);
	Route::post('rincian-biaya/hapus-penginapan',	['as' => 'rincian-biaya.hapus-penginapan',	'uses' 	=> 'RincianBiayaController@hapusPenginapan']);
	Route::post('rincian-biaya/hapus-riil',			['as' => 'rincian-biaya.hapus-riil',		'uses' 	=> 'RincianBiayaController@hapusRiil']);

//PENGELUARAN RIIL
	Route::get('pengeluaran-riil',			['as' => 'pengeluaran-riil',		'uses' => 'PengeluaranRiilController@index']);
	Route::post('simpan_pengeluaran_riil',	['as' => 'pengeluaran-riil.simpan',	'uses' => 'RincianBiayaController@simpanRiil']);

//PAGU
	Route::get('pagu',          ['as' => 'pagu',	     'uses' => 'PaguController@index']);
	Route::get('pagu/create', 	['as' => 'pagu.create',	 'uses' => 'PaguController@create']);
	Route::post('pagu/import', 	['as' => 'pagu.import',	 'uses' => 'PaguController@importExcel']);
	Route::get('pagu/nested', 	['as' => 'pagu.nested',  'uses' => 'PaguController@getNested']);

//ANAK SATKER
	Route::get('anak-satker',              ['as' => 'anak-satker',	               'uses' => 'AnakSatkerController@index']);
	Route::get('anak-satker/create',       ['as' => 'anak-satker.create',	       'uses' => 'AnakSatkerController@create']);
	Route::post('anak-satker/create',      ['as' => 'anak-satker.create.post',     'uses' => 'AnakSatkerController@store']);
	Route::get('anak-satker/edit/{id}',    ['as' => 'anak-satker.edit',	           'uses' => 'AnakSatkerController@edit']);
	Route::post('anak-satker/edit/{id}',   ['as' => 'anak-satker.update',	       'uses' => 'AnakSatkerController@update']);

//NOMINATIF
	Route::get('nominatif',    ['as' => 'nominatif', 'uses' => 'NominatifController@index']);
	Route::get('nominatif/tambah',    ['as' => 'nominatif.tambah', 'uses' => 'NominatifController@tambah']);


//Tujuan Perjalanan
	Route::get('tujuan',    ['as' => 'tujuan', 'uses' => 'TujuanPerjalananController@index']);
	Route::get('tujuan-luar-negeri',    ['as' => 'tujuan-luar-negeri', 'uses' => 'TujuanPerjalananController@indexLuarNegeri']);
	Route::get('tujuan/create-luar-negeri',    ['as' => 'tujuan-luar-negeri.create', 'uses' => 'TujuanPerjalananController@createLuarNegeri']);


});

Route::group(['middleware' => ['admin']], function(){
							/////////////////////////////////
							/////REFERENSI DALAM NEGERI/////
							////////////////////////////////
	//REFERENSI
	Route::get('referensi', 				['as' => 'referensi', 				'uses' => 'ReferensiController@index']);
	Route::get('referensi/tambah', 			['as' => 'referensi.tambah', 		'uses' => 'ReferensiController@create']);
	Route::post('referensi/tambah', 		['as' => 'referensi.tambah.post', 	'uses' => 'ReferensiController@save']);
	Route::get('referensi/edit/{id}', 		['as' => 'referensi.edit', 			'uses' => 'ReferensiController@edit']);
	Route::post('referensi/edit/{id}', 		['as' => 'referensi.edit', 			'uses' => 'ReferensiController@update']);
	Route::post('referensi/import', 		['as' => 'referensi.import',	 	'uses' => 'ReferensiController@importExcel']);

	//REFERENSI
	Route::get('referensi-lama', 				['as' => 'referensi-lama', 				'uses' => 'ReferensiController@indexLama']);
	Route::get('referensi-lama/tambah', 		['as' => 'referensi-lama.tambah', 		'uses' => 'ReferensiController@create']);
	Route::post('referensi-lama/tambah', 		['as' => 'referensi-lama.tambah.post', 	'uses' => 'ReferensiController@saveLama']);
	Route::get('referensi-lama/edit/{id}', 		['as' => 'referensi-lama.edit', 		'uses' => 'ReferensiController@editLama']);
	Route::post('referensi-lama/edit/{id}', 	['as' => 'referensi-lama.edit', 		'uses' => 'ReferensiController@update']);
	
	//Manajemen User
	Route::get('user',                 ['as' => 'user',                'uses' => 'UserController@index']);
	Route::get('user/create',          ['as' => 'user.create',         'uses' => 'UserController@create']);
	Route::get('user/edit/{hasid}',    ['as' => 'user.edit',           'uses' => 'UserController@edit']);
	Route::get('user/detail/{hasid}',  ['as' => 'user.detail',         'uses' => 'UserController@detail']);
	Route::get('user/delete/{hasid}',  ['as' => 'user.delete',         'uses' => 'UserController@delete']);
	Route::post('user/edit/{hasid}',   ['as' => 'user.update',         'uses' => 'UserController@update']);
	Route::post('user/create',         ['as' => 'user.create.post',    'uses' => 'UserController@store']);


	//Uang Harian
	Route::get('uang-harian',	['as' => 'uang-harian.index',	'uses' => 'UangHarianBiasaController@index']);
	Route::get('uang-harian/edit/{id}',	['as' => 'uang-harian.edit',	'uses' => 'UangHarianBiasaController@edit']);
	Route::post('uang-harian/edit-proses/{id}',	['as' => 'uang-harian.edit-proses',	'uses' => 'UangHarianBiasaController@editProses']);
	Route::get('uang-harian/tambah',         ['as' => 'uang-harian.tambah',    'uses' => 'UangHarianBiasaController@tambah']);
	Route::post('uang-harian/tambah-proses',         ['as' => 'uang-harian.tambah-proses',    'uses' => 'UangHarianBiasaController@simpan']);
	Route::post('uang-harian/import', 	['as' => 'uang-harian.import',	 'uses' => 'UangHarianBiasaController@importExcel']);

	//Uang Penginapan
	Route::get('uang-penginapan',	['as' => 'uang-penginapan.index',	'uses' => 'UangPenginapanController@index']);
	Route::get('uang-penginapan/edit/{id}',	['as' => 'uang-penginapan.edit',	'uses' => 'UangPenginapanController@edit']);
	Route::post('uang-penginapan/edit-proses/{id}',	['as' => 'uang-penginapan.edit-proses',	'uses' => 'UangPenginapanController@editProses']);
	Route::get('uang-penginapan/tambah',         ['as' => 'uang-penginapan.tambah',    'uses' => 'UangPenginapanController@tambah']);
	Route::post('uang-penginapan/tambah-proses',         ['as' => 'uang-penginapan.tambah-proses',    'uses' => 'UangPenginapanController@simpan']);
	Route::post('uang-penginapan/import', 	['as' => 'uang-harian.import',	 'uses' => 'UangPenginapanController@importExcel']);

	//Uang Representatif
	Route::get('uang-representatif',	['as' => 'uang-representatif.index',	'uses' => 'UangRepresentatifController@index']);
	Route::get('uang-representatif/edit/{id}',	['as' => 'uang-representatif.edit',	'uses' => 'UangRepresentatifController@edit']);
	Route::post('uang-representatif/edit-proses/{id}',	['as' => 'uang-representatif.edit-proses',	'uses' => 'UangRepresentatifController@editProses']);
	Route::get('uang-representatif/tambah',         ['as' => 'uang-representatif.tambah',    'uses' => 'UangRepresentatifController@tambah']);
	Route::post('uang-representatif/tambah-proses',         ['as' => 'uang-representatif.tambah-proses',    'uses' => 'UangRepresentatifController@simpan']);
	Route::post('uang-representatif/import', 	['as' => 'uang-harian.import',	 'uses' => 'UangRepresentatifController@importExcel']);

	//Uang Harian Rapat
	Route::get('uang-harian-rapat',	['as' => 'uang-harian-rapat.index',	'uses' => 'UangHarianRapatController@index']);
	Route::get('uang-harian-rapat/edit/{id}',	['as' => 'uang-harian-rapat.edit',	'uses' => 'UangHarianRapatController@edit']);
	Route::post('uang-harian-rapat/edit-proses/{id}',	['as' => 'uang-harian-rapat.edit-proses',	'uses' => 'UangHarianRapatController@editProses']);
	Route::get('uang-harian-rapat/tambah',         ['as' => 'uang-harian-rapat.tambah',    'uses' => 'UangHarianRapatController@tambah']);
	Route::post('uang-harian-rapat/tambah-proses',         ['as' => 'uang-harian-rapat.tambah-proses',    'uses' => 'UangHarianRapatController@simpan']);
	Route::post('uang-harian-rapat/import', 	['as' => 'uang-harian-rapat.import',	 'uses' => 'UangHarianRapatController@importExcel']);

	//Uang Taksi
	Route::get('uang-taksi',	['as' => 'uang-taksi.index',	'uses' => 'UangHarianTaksiController@index']);
	Route::get('uang-taksi/edit/{id}',	['as' => 'uang-taksi.edit',	'uses' => 'UangHarianTaksiController@edit']);
	Route::post('uang-taksi/edit-proses/{id}',	['as' => 'uang-taksi.edit-proses',	'uses' => 'UangHarianTaksiController@editProses']);
	Route::get('uang-taksi/tambah',         ['as' => 'uang-taksi.tambah',    'uses' => 'UangHarianTaksiController@tambah']);
	Route::post('uang-taksi/tambah-proses',         ['as' => 'uang-taksi.tambah-proses',    'uses' => 'UangHarianTaksiController@simpan']);
	Route::post('uang-taksi/import', 	['as' => 'uang-taksi.import',	 'uses' => 'UangHarianTaksiController@importExcel']);

	//Uang Transport
	Route::get('uang-transport',	['as' => 'uang-transport.index',	'uses' => 'UangTransportController@index']);
	Route::get('uang-transport/edit/{id}',	['as' => 'uang-transport.edit',	'uses' => 'UangTransportController@edit']);
	Route::post('uang-transport/edit-proses/{id}',	['as' => 'uang-transport.edit-proses',	'uses' => 'UangTransportController@editProses']);
	Route::get('uang-transport/tambah',         ['as' => 'uang-transport.tambah',    'uses' => 'UangTransportController@tambah']);
	Route::post('uang-transport/tambah-proses',         ['as' => 'uang-transport.tambah-proses',    'uses' => 'UangTransportController@simpan']);
	Route::post('uang-transport/import', 	['as' => 'uang-transport.import',	 'uses' => 'UangTransportController@importExcel']);

							/////////////////////////////////
							/////REFERENSI LUAR NEGERI/////
							////////////////////////////////

	//Uang Harian Luar Negeri

	Route::get('uang-harian-luar-negeri',	['as' => 'uang-harian-luar-negeri.index',	'uses' => 'UangHarianLuarController@index']);
	Route::get('uang-harian-luar-negeri/edit/{id}',	['as' => 'uang-harian-luar-negeri.edit',	'uses' => 'UangHarianLuarController@edit']);
	Route::post('uang-harian-luar-negeri/edit-proses/{id}',	['as' => 'uang-harian-luar-negeri.edit-proses',	'uses' => 'UangHarianLuarController@editProses']);
	Route::get('uang-harian-luar-negeri/tambah',         ['as' => 'uang-harian-luar-negeri.tambah',    'uses' => 'UangHarianLuarController@tambah']);
	Route::post('uang-harian-luar-negeri/tambah-proses',         ['as' => 'uang-harian-luar-negeri.tambah-proses',    'uses' => 'UangHarianLuarController@simpan']);
	Route::post('uang-harian-luar-negeri/import', 	['as' => 'uang-harian-luar-negeri.import',	 'uses' => 'UangHarianLuarController@importExcel']);


});

Route::group(['middleware' => ['admSpkPg']], function(){
	Route::get('setting', ['as' => 'setting', 'uses' => 'UserController@setting']);
	Route::post('setting', ['as' => 'setting', 'uses' => 'UserController@settingUpdatePassword']);

	Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@dashboard']);
	Route::get('home', ['as' => 'home', 'uses' => 'HomeController@dashboard']);
	
	// Surat Tugas
	Route::get('surat-tugas', 				['as' => 'surat-tugas', 		'uses' => 'SuratTugasController@index']);
	Route::get('surat-tugas/cetak/{id}', 	['as' => 'surat-tugas.cetak', 	'uses' => 'SuratTugasController@cetak']);
	Route::get('surat-tugas/{id}', 			['as' => 'surat-tugas.show', 	'uses' => 'SuratTugasController@showAjax']);
	Route::get('surat-tugas/cetak-spd-8jam/{id}', ['as' => 'surat-tugas.cetak.8jam', 'uses' => 'SuratTugasController@cetak8jam']);

	
	//Monitoring
	Route::get('monitoring', ['as' => 'monitoring.index', 'uses' => 'MonitoringController@index']); 

	//Nominatif
	Route::get('nominatif/cetak/{id}', ['as' => 'nominatif.cetak', 'uses' => 'NominatifController@cetak']); 
	Route::get('riil/cetak/{id}', ['as' => 'nominatif.cetak', 'uses' => 'PengeluaranRiilController@cetak']); 

//SPD
	Route::get('spd', 	['as' => 'spd', 'uses' => 'SuratPerjadinController@index']);

//Laporan
	Route::get('laporan', 	['as' => 'laporan.index', 'uses' => 'LaporanController@index']);
	Route::get('laporan/{spd_id}', 	['as' => 'laporan.upload', 'uses' => 'LaporanController@cekLaporan']);
	Route::post('laporan/{spd_id}', 	['as' => 'laporan.see', 'uses' => 'LaporanController@uploadLaporan']);
	Route::get('laporan/download/{filename}', ['as' => 'laporan.do-download', 'uses' => 'LaporanController@doDownload']);

//Tanda Terima
	Route::get('surat-tugas/cetak-tanda-terima-8jam/{st}', ['as' => 'tanda.terima.8jam', 'uses' => 'RincianBiayaController@cetakTandaTerima8Jam']);
});


Route::group(['middleware' => ['pegawai']], function(){

});

Auth::routes();


// Route::get('sulapUserPegawai', function()
// {
// 	$response = [];
// 	$pegawai = \App\Pegawai::where('pegawai_id', '>', 348 )->get();
//     if ($pegawai) {
//         foreach ($pegawai as $key => $value) {
//             $user = new \App\User();
//             $user->name = $value->nama;
//             $user->pegawai_id = $value->pegawai_id;
//             $user->type = 'pegawai';
//             $user->password = Hash::make('qwerty');

//             if($value->nip != null && $value->bip != '-' && $value->nip != '0') {
//                 $user->username = $value->nip;            
//             }else{
//                 $user->username = 'user-' . random_int(1, 9999);
//             }
            
//             $user->save();
//             $response['data'][$key]['pegawai']['nama'] = $value->nama;
//             $response['data'][$key]['pegawai']['nip'] = $value->nip;
//             $response['data'][$key]['user']['username'] = $user->username;
//             $response['data'][$key]['user']['password'] = $user->pasword;
            
//             $kelipatan = $key+1;
//             $pecah = str_split($kelipatan);
//             if (end($pecah) == '0') {
//             	sleep(3);
//             }
//         }
//     }

//     return response()->json($response,200);
// });
// // Route::get('/home', 'HomeController@index');
