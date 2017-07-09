@extends('layouts.master')
@section('css')
    <link href="{{url('assets')}}/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
    <style>
        .nomor{
            text-align:center;
        }

        .container{
            width: 1029px;
            height: 1197px;
        }

        ul > li{
            list-style: none;
            margin: 5px 0px;
        }

        ol > li{
           margin: 15px 0px;   
        }

       .padding-left-0{
            padding-left: 0px !important;
        }
        .padding-right-0{
           padding-right: 0px !important;   
        }

        #jumlah_total {
            font-size: large;
            background: rgba(255, 235, 59, 0.19);
            font-family: monospace;
        }

        input[type=number] {
            font-family: monospace;
        }
    </style>
@endsection
@section('head_title', 'Rincian Biaya Perjadin')
@section('title')
Rincian Biaya Perjalanan Dinas
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    Rincian Biaya Perjalanan Dinas
</li>
@endsection
@section('content')
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ URL::to('referensi/import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><b>Rincian Biaya Riil</b></h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                  <tr>
                                    <th style="text-align:center;">No</th>
                                    <th style="text-align:center;">Uraian</th>
                                    <th style="text-align:center;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <tr class="item">
                                    <td style="text-align:center;">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="tambahRiil()"><i class="fa fa-plus"></i></button>
                                        </td>
                                    <td>
                                        <select class="form-control jenis_pengeluaran_riil" name="jenis_pengeluaran_riil[]">
                                            <option value="Kantor Bandara PP">Kantor Bandara PP</option>
                                            <option value="Hotel Bandara PP">Hotel Bandara PP</option>
                                            <option value="Sewa Kendaraan Antar Kabupaten">Sewa Kendaraan Antar Kabupaten</option>
                                            <option value="Transportasi Darat Ibukota Provinsi ke Kabupaten">Transportasi Darat Ibukota Provinsi ke Kabupaten</option>
                                            <option value="Biaya Riil Penginapan">Biaya Riil Penginapan</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp</span>
                                            <input type="number" name="subtotal_pengeluaran_riil[]" class="form-control subtotal_pengeluaran_riil" max="{{$response['data']['referensi']['uang_taksi_asal'] * 2}}" data-placement="bottom" title="Max: {{$response['data']['referensi']['uang_taksi_asal']}}" value="0">
                                        </div>
                                        </td>
                                </tr>
                                <tr id="jumlahnya">
                                    <td class="nomor"></td>
                                    <td style="text-align:center;">Jumlah</td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp</span>
                                            <input type="number" min="0" name="total_riil" class="form-control" readonly id="total_riil" value="0">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    {{csrf_field()}}
                    <button type="button" class="btn btn-primary" id="simpanRiil">Simpan <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="col-lg-12">
    <section class="box">
        <div class="content-body">

            <div class="alert alert-default">
                <h4 style="text-align: center; text-transform: uppercase;"><b>Data Rincian Surat</b></h4>
                <table style="width: 100%">
                    <tr>
                        <td><b>Nama</b></td>
                        <td>:</td>
                        <td>{{$response['data']['pegawai']['nama']}}</td>
                    </tr>
                    <tr>
                        <td><b>Golongan</b></td>
                        <td>:</td>
                        <td>{{$response['data']['pegawai']['golongan']}}</td>
                    </tr>
                    <tr>
                        <td><b>Pangkat</b></td>
                        <td>:</td>
                        <td>{{$response['data']['pegawai']['pangkat']}}</td>
                    </tr>
                    <tr>
                        <td><b>Tingkat</b></td>
                        <td>:</td>
                        <td>{{$response['data']['pegawai']['tingkat_perjadin']}}</td>
                    </tr>
                    <tr>
                        <td><b>Tujuan</b></td>
                        <td>:</td>
                        <td>{{$response['data']['kegiatan']['lokasi_kegiatan']}}</td>
                    </tr>
                    <tr>
                        <td><b>Nama Kegiatan</b></td>
                        <td>:</td>
                        <td>{{$response['data']['kegiatan']['nama_kegiatan']}}</td>
                    </tr>
                </table>
            </div>

            <br>
            <hr>
            <br>
            <form method="POST" action="{{url('rincian-biaya')}}" id="rForm" target="_blank">
                <h4 style="text-align: center; text-transform: uppercase;"><b>Rincian Biaya Perjalanan Dinas</b></h4>
                <br>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td style="border:none;">Lampiran SPD No</td>
                            <td style="border:none;">:</td>
                            <td style="border:none;"><input type="text" name="" class="form-control" value="{{$response['data']['nomor_spd']}}" style="width: 400px;" readonly></td>
                        </tr>
                        <tr>
                            <td style="border:none;">Tanggal</td>
                            <td style="border:none;">:</td>
                            <td style="border:none;"><input type="text" name="" class="form-control" value="{{\App\Library\Datify::readify(substr($response['data']['tanggal_surat'], 0, 10))}}" style="width: 400px;" readonly></td>
                        </tr>
                    </table>
                </div>
                
                <div class="text-center">
                    <b>Perincian Perhitungan Biaya Perjanan Dinas</b>
                </div>
                <br>
                <br>
                <div class="table-responsive">
                  <table class="table table-bordered">
                      <tr>
                        <th style="text-align:center; width:5%;">No</th>
                        <th style="text-align:center; width:50%;">Perincian Biaya</th>
                        <th style="text-align:center; width:20%;">Jumlah</th>
                        <th style="text-align:center; width:25%;">Keterangan</th>
                    </tr>
                    <tr>
                        <td class="nomor">1</td>
                        <td>
                            Uang Lumpsum <br><br>
                            <div class="col-md-6 padding-left-0">
                                <input type="number" name="qty_lumpsum" class="form-control fillable" min="0" value="{{(count($response['data']['rincian']['lumpsum']) > 0) ? $response['data']['rincian']['lumpsum']->qty:'0'}}" id="qty_lumpsum" data-content="Uang Lumpsum ke: {{$response['data']['kegiatan']['lokasi_kegiatan']}} <br> {{$response['data']['referensi']['uang_harian']->luar_kota}} / Orang per hari" data-placement="top">
                            </div>
                            <div class="col-md-6 padding-left-0 padding-right-0">
                                <input type="number" name="harga_lumpsum" class="form-control" id="harga_lumpsum" placeholder="" value="{{$response['data']['referensi']['uang_harian']->luar_kota}}" readonly>
                            </div>
                        </td>
                        <td>
                            <br><br>
                            <input type="text" name="subtotal_lumpsum" id="subtotal_lumpsum" value="{{(count($response['data']['rincian']['lumpsum']) > 0) ? $response['data']['rincian']['lumpsum']->sub_total:'0'}}" class="form-control" readonly>
                        </td>
                        <td>
                            <textarea name="keterangan_lumpsum" class="form-control" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                      <td class="nomor">2</td>
                      <td>
                        <div class="col-md-12 padding-right-0 padding-left-0">
                            <select  id="uang_harian_jenis" class="form-control" name="uang_harian_jenis">
                                <option value="0">--Pilih Uang Harian--</option>
                                <option value="{{$response['data']['referensi']['uang_harian']->dalam_kota}}" @if((count($response['data']['rincian']['uang_harian']) > 0) && $response['data']['rincian']['uang_harian']->jenis_referensi == 'Uang Harian Dalam Kota ( > 8 jam)') selected @endif>Uang Harian Dalam Kota ( > 8 jam)</option>
                                <option value="{{$response['data']['referensi']['uang_harian']->diklat}}" @if((count($response['data']['rincian']['uang_harian']) > 0) && $response['data']['rincian']['uang_harian']->jenis_referensi == 'Uang Harian Diklat') selected @endif>Uang Harian Diklat</option>
                                <option value="{{$response['data']['referensi']['uang_rapat']->fullboard_dakot}}" @if((count($response['data']['rincian']['uang_harian']) > 0) && $response['data']['rincian']['uang_harian']->jenis_referensi == 'Uang Rapat Fullboard Dalam Kota') selected @endif>Uang Rapat Fullboard Dalam Kota</option>
                                <option value="{{$response['data']['referensi']['uang_rapat']->fullboard_lukot}}" @if((count($response['data']['rincian']['uang_harian']) > 0) && $response['data']['rincian']['uang_harian']->jenis_referensi == 'Uang Rapat Fullboard Luar Kota') selected @endif>Uang Rapat Fullboard Luar Kota</option>
                                <option value="{{$response['data']['referensi']['uang_rapat']->fullhalf_dakot}}" @if((count($response['data']['rincian']['uang_harian']) > 0) && $response['data']['rincian']['uang_harian']->jenis_referensi == 'Uang Rapat Halfday Dalam Kota') selected @endif>Uang Rapat Halfday Dalam Kota</option>
                            </select>
                            <input type="hidden" name="jenis_uang_harian" id="jenis_uang_harian" value="{{((count($response['data']['rincian']['uang_harian']) > 0) ? $response['data']['rincian']['uang_harian']->jenis_referensi : '')}}">
                        </div>
                        <br><br><br>
                        <div class="col-md-6 padding-left-0">
                            <div class="form-group">
                                <input type="number" class="form-control fillable" id="uang_harian_qty" name="uang_harian_qty" min="0" value="{{(count($response['data']['rincian']['uang_harian']) > 0) ? $response['data']['rincian']['uang_harian']->qty : '0'}}">
                            </div>
                        </div>
                        <div class="col-md-6 padding-left-0 padding-right-0">
                            <div class="form-group">
                                <input type="number" class="form-control" id="uang_harian_harga" name="uang_harian_harga" value="{{(count($response['data']['rincian']['uang_harian']) > 0) ? $response['data']['rincian']['uang_harian']->ref_max : '0'}}" placeholder="Harga" readonly>
                            </div>
                        </div>
                    </td>
                    <td>
                        <br><br><br>
                        <input type="text" name="uang_harian_subtotal" id="uang_harian_subtotal" class="form-control" value="{{(count($response['data']['rincian']['uang_harian']) > 0) ? $response['data']['rincian']['uang_harian']->sub_total : '0'}}" readonly>
                    </td>
                    <td>
                        <textarea name="uang_harian_keterangan" class="form-control" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="nomor">3</td>
                    <td>
                        Uang Representasi
                        <br><br>
                        <div class="col-md-6 padding-left-0">
                            <div class="form-group">
                                <input type="number" class="form-control fillable" id="representatif_qty" name="representatif_qty" min="0" @if($response['data']['referensi']['uang_representatif'] == '0') disabled data-toggle="popover" data-content="Pejabat ini tidak berhak mendapat uang representasi.<br>Pejabat Negara: N<br>Eselon: {{$response['data']['referensi']['uang_representatif']}}" @endif value="{{(count($response['data']['rincian']['representatif']) > 0) ? $response['data']['rincian']['representatif']->qty : '0'}}">
                            </div>
                        </div>
                        <div class="col-md-6 padding-left-0 padding-right-0">
                            <div class="form-group">
                                <input type="number" class="form-control" id="representatif_harga" name="representatif_harga" placeholder="Harga" @if($response['data']['referensi']['uang_representatif'] != '0') value="{{$response['data']['referensi']['uang_representatif']->ur_lukot}}" @else value="0" @endif readonly>
                            </div>
                        </div>
                    </td>
                    <td>
                        <br><br>
                        <input type="text" name="representatif_subtotal" id="representatif_subtotal" class="form-control" value="{{(count($response['data']['rincian']['representatif']) > 0) ? $response['data']['rincian']['representatif']->sub_total : '0'}}" readonly style="width: 200px;">
                    </td>
                    <td>
                        <textarea name="representatif_keterangan" class="form-control" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="nomor">4</td>
                    <td>
                        Biaya Transport<br>
                        <ol type="a">
                            <li>Tiket PP</li>
                            {{-- <li>Airport Tax</li> --}}
                            <li>Lainnya</li>
                        </ol>
                    </td>
                    <td>
                        <br>
                        <ul class="padding-left-0">
                            <li><input type="number" value="{{(count($response['data']['rincian']['tiket_pp']) > 0) ? $response['data']['rincian']['tiket_pp']->sub_total : '0'}}" name="tiket_pp" id="tiket_pp" class="form-control fillable"></li>
                            {{-- <li><input type="number" value="{{(count($response['data']['rincian']['airport_tax']) > 0) ? $response['data']['rincian']['airport_tax']->sub_total : '0'}}" name="airport_tax" id="airport_tax" class="form-control fillable"></li> --}}
                            <li><input type="number" value="{{(count($response['data']['rincian']['lainnya']) > 0) ? $response['data']['rincian']['lainnya']->sub_total : '0'}}" name="lainnya" id="lainnya" class="form-control fillable"></li>
                        </ul>
                    </td>
                    <td>
                        <textarea name="keterangan_lainnya" class="form-control" rows="7"></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="nomor">
                        5
                        <br><br>
                        <div class="col-md-5 padding-left-0 padding-right-0">
                            <a class="btn btn-info" id="tmbl_penginapan" onClick="tambahPenginapan()" title="Tambah">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </td>
                    <td id="peng">
                        Biaya Penginapan <br><br>
                        <div class="input-group">
                            @if(count($response['data']['rincian']['penginapan']) > 0)
                                @foreach($response['data']['rincian']['penginapan'] as $k => $v)
                                    @if($k == 0)
                                        <div class="input-group">
                                            <div class="input-daterange input-group" id="datepicker">
                                                <span class="input-group-addon">Jml</span>
                                                <input type="number" class="form-control qty_penginapan fillable" min="0" value="{{$v->qty}}" step="1" name="qty_penginapan[]">
                                                <span class="input-group-addon">Rp. </span>
                                                <input type="number" class="form-control harga_penginapan fillable"  name="harga_penginapan[]" style="min-width: 150px" data-toggle="tooltip" title="Max: {{$response['data']['referensi']['uang_penginapan']}}" max="{{$response['data']['referensi']['uang_penginapan']}}" min="0" value="{{$v->harga_satuan}}" step="1">
                                                <input type="hidden" class="subP" name="old[]" value="{{$v->id}}">
                                                <span class="input-group-btn">
                                                    <button class="btn" type="button" onclick="hapusPenginapan({{$v->id}}, $(this), true)"><i class="fa fa-trash"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="input-group"><br>
                                            <div class="input-daterange input-group" id="datepicker">
                                                <span class="input-group-addon">Jml</span>
                                                <input type="number" class="form-control qty_penginapan fillable" min="0" value="{{$v->qty}}" step="1" name="qty_penginapan[]">
                                                <span class="input-group-addon">Rp. </span>
                                                <input type="number" class="form-control harga_penginapan fillable"  name="harga_penginapan[]" style="min-width: 150px" data-toggle="tooltip" title="Max: zxczxc{{$response['data']['referensi']['uang_penginapan']}}" max="{{$response['data']['referensi']['uang_penginapan']}}" min="0" value="{{$v->harga_satuan}}" step="1">
                                                <input type="hidden" class="subP" name="old[]" value="{{$v->id}}">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-danger" type="button" onclick="hapusPenginapan({{$v->id}}, $(this), false)"><i class="fa fa-trash" style="color: red;"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="input-daterange input-group" id="datepicker">
                                    <span class="input-group-addon">Jml</span>
                                    <input type="number" class="form-control qty_penginapan fillable" min="0" value="0" step="1" name="qty_penginapan[]">
                                    <span class="input-group-addon">Rp. </span>
                                    <input type="number" class="form-control harga_penginapan fillable"  name="harga_penginapan[]" style="min-width: 150px" data-toggle="tooltip" title="Max: {{$response['data']['referensi']['uang_penginapan']}}" max="{{$response['data']['referensi']['uang_penginapan']}}" min="0" value="0" step="1">
                                    <span class="input-group-btn">
                                        <button class="btn" type="button" disabled><i class="fa fa-trash"></i></button>
                                    </span>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <br><br>
                        <input type="text" name="subtotal_penginapan" id="subtotal_penginapan" value="0" class="form-control" readonly>
                    </td>
                    <td>
                        <textarea name="keterangan" class="form-control" rows="4"></textarea>
                    </td>
                </tr>
                <tr id="">
                    <td class="nomor">
                        6 <br><br>
                        <div class="col-md-5 padding-left-0 padding-right-0">
                            <a class="btn btn-info" data-toggle="modal" data-target="#myModal" title="Tambah">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </td>
                    <td>
                        Daftar Pengeluaran Riil
                        <div class="input-group" id="riilContainer">

                        <?php $subRiil = 0;?>

                        @forelse($response['data']['rincian']['riil'] as $k => $v)

                            <?php $subRiil += $v->sub_total; ?>

                            {!!($k > 0) ? '<br>' : ''!!}

                            @if($v->jenis == 'Biaya Riil Penginapan')
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="form-control" disabled value="{{$v->jenis}}" style="width: 300px;">
                                    <span class="input-group-addon">{{$v->qty}} x {{number_format($v->harga_satuan, 0, ',', '.')}} =</span>
                                    <input type="number" class="form-control riil_item" style="width: 100px;" readonly value="{{$v->sub_total}}">
                                    <span class="input-group-btn">
                                        <button class="btn" type="button" onclick="hapusRiil({{$v->id}}, $(this))"><i class="fa fa-trash" style="color: red;"></i></button>
                                    </span>
                                </div>
                            @else
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="form-control" disabled value="{{$v->jenis}}">
                                    <span class="input-group-addon">Rp. </span>
                                    <input type="number" class="form-control riil_item" style="min-width: 150px" readonly value="{{$v->sub_total}}">
                                    <span class="input-group-btn">
                                        <button class="btn" type="button" onclick="hapusRiil({{$v->id}}, $(this))"><i class="fa fa-trash" style="color: red;"></i></button>
                                    </span>
                                </div>
                            @endif
                            
                        @empty
                        @endforelse
                        </div>
                    </td>
                    <td>
                        <br><br>
                        <input type="text" name="rill_subtotal" id="riil_subtotal" class="form-control" value="{{($subRiil)}}" readonly>
                    </td>
                    <td>
                        <textarea name="keterangan" class="form-control" rows="4"></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="nomor">7</td>
                    <td class="text-center">Jumlah</td>
                    <td colspan="2">
                        <input type="text" name="jumlah_total" id="jumlah_total" class="form-control" readonly value="0">
                        <input type="hidden" name="jumlah_total_hidden" id="jumlah_total_hidden" value="0">
                    </td>
                </tr>
                <tr>
                    <td class="nomor">8</td>
                    <td class="" colspan="3">
                        <div class="input-daterange input-group" id="datepicker">
                            {{-- <span class="input-group-addon">Terbilang</span> --}}
                            <label class="control-label">Terbilang</label>
                            <input type="text" name="jumlah_total_terbilang" id="jumlah_total_terbilang" class="form-control" readonly>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row">
            <div class="col-md-3 pull-right">
                <input type="text" name="tanggal" class="form-control" id="tanggal"> 
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4 pull-left">
                <p class="text-center">Telah dibayar sejumlah</p>
                <input type="text" name="" class="form-control fillable" readonly>
            </div>
            <div class="col-md-4 pull-right">
               <p class="text-center">Telah diterima jumlah uang</p>
               <input type="text" name="" class="form-control" readonly>
           </div>
       </div>
       <br>
       <div class="row">
        <div class="col-md-4 pull-left">
            <p class="text-center">Bendahara Pengeluaran Pembantu</p>
            <br><br><br><br><br>
            <ul>
                <li><input type="text" name="" class="form-control" value="{{$response['data']['pagu']['nama_bendahara']}}" placeholder="Nama Bendahara" readonly></li>
                <li><input type="text" name="" class="form-control" value="{{$response['data']['pagu']['nip_bendahara']}}" placeholder="NIP" readonly></li>
            </ul>
        </div>
        <div class="col-md-4 pull-right">
            <p class="text-center">Yang Menerima</p>
            <br><br><br><br><br>
            <ul>
                <li><input type="text" name="nama_pelaksana" id="nama_pelaksana" class="form-control" value="{{$response['data']['pegawai']['nama']}}" readonly></li>
                <li><input type="text" name="nip_pelaksana" class="form-control" id="nip_pelaksana" value="{{$response['data']['pegawai']['nip']}}" readonly></li>
            </ul>
        </div>
    </div>
    <hr>
    <h4 style="text-align:center;"><b>Perhitungan SPD Rampung</b></h4>
    <br>

    <div class="row">
        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="border:none;">Ditetapkan sejumlah</td>
                            <td style="border:none;">:</td>
                            <td style="border:none;"><input type="number" name="grand_total" id="grand_total" class="form-control" style="width: 200px;" readonly></td>
                        </tr>
                        <tr>
                            <td style="border:none;">Yang telah dibayar sejumlah</td>
                            <td style="border:none;">:</td>
                            <td style="border:none;"><input type="number" name="terbayar" value="{{$response['data']['terbayar']}}" class="form-control" style="width: 200px;"></td>
                        </tr>
                        <tr>
                            <td style="border:none;">Sisa kurang/lebih</td>
                            <td style="border:none;">:</td>
                            <td style="border:none;"><input type="number" name="kekurangan" class="form-control" style="width: 200px;" readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 pull-right">
            <p class="text-center">a.n Kuasa Pengguna Anggaran <br> Pejabat Pembuat Komitmen Anggaran</p>
            <br><br><br><br><br>
            <ul>
                <li><input type="text" name="" class="form-control" value="{{$response['data']['pagu']['nama_ppk']}}" readonly></li>
                <li><input type="text" name="" class="form-control" value="{{$response['data']['pagu']['nip_ppk']}}" readonly></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 pull-left">
            <input type="hidden" name="spd_id" value="{{$response['data']['hashid']}}">
            <input type="hidden" name="spd_id" value="{{$response['data']['hashid']}}">
            {{csrf_field()}}
            <button class="btn btn-primary" type="submit">Simpan</button>

        </div>
    </div>
</form>
</div>
</section>
</div>
@endsection 

@section('js')
<script type="text/javascript" src="{{asset('assets/js/terbilang.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/rupiah.js')}}"></script>
<script type="text/javascript" src="{{url('assets')}}/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="{{url('assets')}}/js/bootstrap-datepicker.id.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        hitungPenginapan();
        countRepresentatif();
        hitung_total();
        $('#subtotal_lumpsum').val(rupiahkan($('#subtotal_lumpsum').val()));
        $('#uang_harian_subtotal').val(rupiahkan($('#uang_harian_subtotal').val()));
        $('#riil_subtotal').val(rupiahkan($('#riil_subtotal').val()));
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover({html:true});
        //Datepicker
        var d = new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var year = d.getFullYear();
        $('#tanggal').datepicker({
            format : 'dd MM yyyy',
            clearBtn: true,
            language: 'id',
            autoclose: true,
            todayHighlight: true
        });
    });

    $(document).on('blur', '.fillable',function(){
        if ($(this).val().length == 0) {
            $(this).val('0');            
        }
    });

    $(document).on('focus', '.fillable',function(){
        if ($(this).val().length == 0 || $(this).val() == 0) {
            $(this).val('');
        }
    });


    function tambahPenginapan() {
        var strVar="";
            strVar += "<div class=\"input-group\"><br>";
            strVar += "    <div class=\"input-daterange input-group\" id=\"datepicker\">";
            strVar += "        <span class=\"input-group-addon\">Jml<\/span>";
            strVar += "        <input type=\"number\" class=\"form-control qty_penginapan fillable\" min=\"0\" step=\"1\" name=\"qty_penginapan[]\">";
            strVar += "        <span class=\"input-group-addon\">Rp. <\/span>";
            strVar += "        <input type=\"number\" class=\"form-control  harga_penginapan fillable\" min=\"0\" step=\"1\" data-toggle=\"tooltip\" title=\"Max: {{$response['data']['referensi']['uang_penginapan']}}\" max=\"{{$response['data']['referensi']['uang_penginapan']}}\" style=\"min-width: 150px\" name=\"harga_penginapan[]\">";
            strVar += "        <span class=\"input-group-btn input-group-btn-danger\">";
            strVar += "            <button class=\"btn btn-danger\" type=\"button\" onclick=\"$(this).parent().parent().parent().remove();recalculatePenginapan($(this));\"><i class=\"fa fa-trash\" style=\"color:red;\"><\/i><\/button>";
            strVar += "        <\/span>";
            strVar += "    <\/div>";
            strVar += "<\/div>";

        $('#peng').append(strVar);
        $('[data-toggle="tooltip"]').tooltip();
    }

    function limitThis(obj) {
        if ( ! obj.attr('max')){
            return false;
        }

        var maxim = parseInt(obj.attr('max'));
        if (parseInt(obj.val()) > maxim) {
            notie.alert('warning', 'Maximum ' + maxim, 1);
            obj.val(maxim).focus().removeClass('animated shake').addClass('animated shake');
        }
    }

    //Penginapan
    function hitungPenginapan() {
        var total = 0;
        $('.harga_penginapan').each(function (index, value) {
            var curQty = ($(value).parent().find('.qty_penginapan').val().length == 0) ? 0 : $(value).parent().find('.qty_penginapan').val();
            var curPrice = ($(value).val().length == 0) ? 0 : $(value).val();
            total = total + (parseInt(curQty) * parseInt(curPrice));
            $('#subtotal_penginapan').val(rupiahkan(total));
        });
    }

    function recalculatePenginapan(objct) {
        var o = limitThis(objct);
        var total = 0;
        $('.harga_penginapan').each(function (index, value) {
            var curQty = ($(value).parent().find('.qty_penginapan').val().length == 0) ? 0 : $(value).parent().find('.qty_penginapan').val();
            var curPrice = ($(value).val().length == 0) ? 0 : $(value).val();
            total = total + (parseInt(curQty) * parseInt(curPrice));
            $('#subtotal_penginapan').val(rupiahkan(total));
        });
    }

    function countPenginapan(obj) {
        var qty = (obj.val().length == 0) ? 0 : obj.val();
            var price = (obj.parent().find('.harga_penginapan').val().length == 0) ? 0 : obj.parent().find('.harga_penginapan').val();
            var sub = parseInt(qty) * parseInt(price);
            recalculatePenginapan(obj);
    }

    $(document).on({
        change: function() {
            countPenginapan($(this));
        },
        keyup: function() {
            countPenginapan($(this));
        }
    }, '.qty_penginapan');

    function countHargaPenginapan(obj) {
        var price = (obj.val().length == 0) ? 0 : obj.val();
        var qty = (obj.parent().find('.qty_penginapan').val().length == 0) ? 0 : obj.parent().find('.qty_penginapan').val();
        var sub = parseInt(qty) * parseInt(price);
        recalculatePenginapan(obj);
    }

    $(document).on({
        change: function() {
            countHargaPenginapan($(this));
        },
        keyup: function() {
            countHargaPenginapan($(this));
        }
    }, '.harga_penginapan');

    //Lumpsum
    function countLumpsum(obj) {
        var ref = parseInt(($('#harga_lumpsum').val().length == 0) ? 0 : $('#harga_lumpsum').val());
        var qty = parseInt((obj.val().length == 0) ? 0 : obj.val());
        $('#subtotal_lumpsum').val(rupiahkan(ref * qty));
    }

    $(document).on({
        change: function() {
            countLumpsum($(this));
        },
        keyup: function() {
            countLumpsum($(this));
        }
    }, '#qty_lumpsum');


    //Uang Harian
    function countUangHarian(obj) {
        if (parseInt($('#uang_harian_jenis').val()) == 0) {
            notie.alert('info', 'Silahkan pilih jenis uang harian', 1);
            $('#uang_harian_jenis').focus().removeClass('animated shake').addClass('animated shake');
            return false;
        }

        var qty = parseInt((obj.val().length > 0) ? obj.val() : 0);
        var price = parseInt($('#uang_harian_harga').val());
        var sub = parseInt(qty * price);
        $('#uang_harian_subtotal').val(rupiahkan(sub));
    }

    $(document).on('change', '#uang_harian_jenis', function() {
        $('#uang_harian_qty, #uang_harian_subtotal').val('0');
        $('#uang_harian_harga').val(($(this).val().length == 0) ? 0 : $(this).val());
        if (parseInt($(this).val()) != 0) {
            $('#jenis_uang_harian').val($('#uang_harian_jenis option:selected').text());
        }
    });

    $(document).on({
        change: function() {
            countUangHarian($(this));
        },
        keyup: function() {
            countUangHarian($(this));
        }
    }, '#uang_harian_qty');

    //Uang Representatif
    function countRepresentatif() {
        var ref = parseInt(($('#representatif_harga').val().length == 0) ? 0 : $('#representatif_harga').val());
        var qty = parseInt(($('#representatif_qty').val().length == 0) ? 0 : $('#representatif_qty').val());
        $('#representatif_subtotal').val(rupiahkan(ref * qty));
    }

    $(document).on({
        change: function(){
            countRepresentatif();
        },
        keyup: function() {
            countRepresentatif();
        }
    }, '#representatif_qty');

    $(document).on({
        change : function(){
            hitung_total();
        },
        keypress : function(){
            hitung_total();
        },
        keydown : function(){
            hitung_total();
        },
        keyup : function() {
            hitung_total();
        }
    }, 'input');

    function hitung_total() {
        var lumpsum             = parseInt(($('#subtotal_lumpsum').val().length == 0) ? 0 : kembalikan($('#subtotal_lumpsum').val()));
        var uang_harian         = parseInt(($('#uang_harian_subtotal').val().length == 0) ? 0 : kembalikan($('#uang_harian_subtotal').val()));
        var uang_representasi   = parseInt(($('#representatif_subtotal').val().length == 0) ? 0 : kembalikan($('#representatif_subtotal').val()));
        var penginapan          = parseInt(($('#subtotal_penginapan').val().length == 0) ? 0 : kembalikan($('#subtotal_penginapan').val()));
        var tiket_pp            = parseInt(($('#tiket_pp').val().length == 0) ? 0 : kembalikan($('#tiket_pp').val()));
        // var airport_tax         = parseInt(($('#airport_tax').val().length == 0) ? 0 : kembalikan($('#airport_tax').val()));
        var airport_tax         = 0;
        var lainnya             = parseInt(($('#lainnya').val().length == 0) ? 0 : kembalikan($('#lainnya').val()));
        var riil                = parseInt(($('#riil_subtotal').val().length == 0) ? 0 : kembalikan($('#riil_subtotal').val()));
        
        var tot                 = parseInt(lumpsum + uang_harian + uang_representasi + tiket_pp + penginapan + airport_tax + lainnya + riil);
        
        $('#jumlah_total').val(rupiahkan(tot, true));
        $('#jumlah_total_terbilang').val(terbilang(tot));
    }

    function tambahRiil(){

        var strVar="";
            strVar += "<tr class=\"item tambahan\">";
            strVar += "    <td style=\"text-align:center;\">";
            strVar += "         <button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"$(this).parent().parent().remove();recalculateRiil();\"><i class=\"fa fa-trash-o\"><\/i><\/button>";
            strVar += "    <\/td>";
            strVar += "    <td>";
            strVar += "        <select class=\"form-control jenis_pengeluaran_riil\" name=\"jenis_pengeluaran_riil[]\">";
            strVar += "            <option value=\"Kantor Bandara PP\">Kantor Bandara PP<\/option>";
            strVar += "            <option value=\"Hotel Bandara PP\">Hotel Bandara PP<\/option>";
            strVar += "            <option value=\"Sewa Kendaraan Antar Kabupaten\">Sewa Kendaraan Antar Kabupaten<\/option>";
            strVar += "            <option value=\"Transportasi Darat Ibukota Provinsi ke Kabupaten\">Transportasi Darat Ibukota Provinsi ke Kabupaten<\/option>";
            strVar += "            <option value=\"Biaya Riil Penginapan\">Biaya Riil Penginapan<\/option>";
            strVar += "        <\/select>";
            strVar += "    <\/td>";
            strVar += "    <td>";
            strVar += "        <div class=\"input-group\">";
            strVar += "            <span class=\"input-group-addon\">Rp<\/span>";
            strVar += "            <input type=\"number\" min=\"0\" name=\"subtotal_pengeluaran_riil[]\" class=\"form-control subtotal_pengeluaran_riil\" max=\"{{$response['data']['referensi']['uang_taksi_asal'] * 2}}\">";
            strVar += "        <\/div>";
            strVar += "        <\/td>";
            strVar += "<\/tr>";
    
        $(strVar).insertBefore($('#jumlahnya'));
    
    }

    function recalculateRiil(){
    
        var total = 0;
        $('.subtotal_pengeluaran_riil').each(function(index, value){
            total += parseInt(($(value).val().length == 0) ? 0 : $(value).val());
        });
    
        $('#total_riil').val(total);
    }


    function cekRiilMax(obj) {
        if (obj.attr('max').length > 0) {
            // console.log(obj.val());
            var maxim = parseInt(obj.attr('max'));
            if (parseInt(obj.val()) > maxim) {
                notie.alert('warning', 'Maximum: ' + rupiahkan(maxim, true), 1);
                obj.val(maxim);
                obj.addClass('animated shake');
            }
        }
    }

    $(document).on({
        change: function() {
            cekRiilMax($(this));
            recalculateRiil();
        },
        keyup:  function() {
            cekRiilMax($(this));
            recalculateRiil();
        },
        focus: function() {
            if (parseInt($(this).val()) == 0 && !$(this).attr('readonly')) {
                $(this).val('');
            }
        },
        blur: function() {
          if ($(this).val().length == 0 && !$(this).attr('readonly')) {
                $(this).val('0');
            }  
        }
    }, '.subtotal_pengeluaran_riil');

    $(document).on('click', '#simpanRiil', function() {
       
       $('.subtotal_pengeluaran_riil').each(function(index, value){
            if ($(this).val().length > 0 && $(this).val() > 0) {
                if ($(this).attr('readonly')) {
                    // alert('readonly');
                    sendRiil(   
                        'spd_id=' + $('input[name="spd_id"]').val() +  
                        '&jenis=' + $(this).parent().parent().parent().find('.jenis_pengeluaran_riil').val() + 
                        '&qty_riil=' + parseInt($(this).parent().parent().parent().find('.qty_riil').val()) + 
                        '&harga=' + parseInt($(this).parent().parent().parent().find('.harga_riil').val()) + 
                        '&max=' + parseInt($(this).parent().parent().parent().find('.harga_riil').attr('max')) + 
                        // '&max=' + parseInt($(this).attr('max')) + '&sub_total=' + parseInt($(this).val()) + 
                        '&sub_total=' + parseInt($(this).val()) +
                        '&_token={{csrf_token()}}'
                    );

                }else{
                    sendRiil(
                        'spd_id=' + $('input[name="spd_id"]').val() +
                        '&jenis=' + $(this).parent().parent().parent().find('.jenis_pengeluaran_riil').val() +
                        '&max=' + parseInt($(this).attr('max')) +
                        '&sub_total=' + parseInt($(this).val()) +
                        '&_token={{csrf_token()}}'
                    );
                }
            }
        });
    });

    function sendRiil(argument) {
        $.ajax({
            url : '{{url('simpan_pengeluaran_riil')}}',
            type : 'POST',
            data : argument,
            beforeSend : function() {
                $('#simpanRiil').html('<i class="fa fa-spinner fa-spin"></i> Loading...').prop('disabled', true);
                $('.subtotal_pengeluaran_riil, jenis_pengeluaran_riil').prop('disabled', true);
            },
            success : function(response) {
                $('#simpanRiil').html('Simpan <i class="fa fa-save"></i>').prop('disabled', false);
                $('.subtotal_pengeluaran_riil, jenis_pengeluaran_riil').prop('disabled', false);
                
                if (response.status) {
                    notie.alert('success', 'Berhasil menyimpan pengeluaran riil', 1);

                    if(response.data.jenis == 'Biaya Riil Penginapan'){
                        var pender = '<br><div class="input-daterange input-group" id="datepicker">'
                                        +'<input type="text" class="form-control" disabled value="' + response.data.jenis + '" style="width: 300px;">'
                                        +'<span class="input-group-addon">'+ response.data.qty +' x ' + response.data.harga_satuan +' = </span>'
                                        +'<input type="number" class="form-control riil_item" style="width: 100px;" readonly value="'+ response.data.sub_total +'">'
                                        +'<span class="input-group-btn">'
                                            +'<button class="btn" type="button" onclick="hapusRiil(' + response.data.id + ', $(this))"><i class="fa fa-trash" style="color: red;"></i></button>'
                                        +'</span>'
                                     +'</div>';
                    }else{
                        var pender = '<br><div class="input-daterange input-group" id="datepicker">'
                                        +'<input type="text" class="form-control" disabled value="'+ response.data.jenis +'">'
                                        +'<span class="input-group-addon">Rp. </span>'
                                        +'<input type="number" class="form-control riil_item" style="min-width: 150px" readonly value="' + response.data.sub_total + '">'
                                        +'<span class="input-group-btn">'
                                        +'    <button class="btn" type="button" onclick="hapusRiil(' + response.data.id + ', $(this))"><i class="fa fa-trash" style="color: red;"></i></button>'
                                        +'</span>'
                                    '</div>';
                    }

                    $('#riilContainer').append(pender);

                    var has = 0;
                    var current = kembalikan($('#riil_subtotal').val());
                    var addition = parseInt($('#total_riil').val());
                    has = current + addition;
                    $('#riil_subtotal').val(rupiahkan(has));
                    // alert('Has:' + has +' Current:' + current + ' addition:' + addition);
                    resetRiil();

                    $('.tambahan').remove();

                    hitung_total();
                    $('#myModal').modal('hide');
                }else{
                    notie.alert('error', 'Terjadi kesalahan memproses.', 3);
                }

            },
            error : function(){
                $('#simpanRiil').html('Simpan <i class="fa fa-save"></i>').prop('disabled', false);
                $('.subtotal_pengeluaran_riil, jenis_pengeluaran_riil').prop('disabled', false);
            }
        })
    }

    function resetRiil() {
        $('.tambahan').remove();
        $('.subtotal_pengeluaran_riil').val('');

        recalculateRiil();
    }

    function hapusPenginapan(id, obj, first = true) {

        $.ajax({
            url : '{{url('rincian-biaya/hapus-penginapan')}}',
            type : 'POST',
            data : 'id=' + id + '&_token={{csrf_token()}}' ,
            beforeSend : function() {
                obj.parent().parent().find('.form-control').attr('readonly', true);
                obj.html('<i class="fa fa-spinner fa-spin></i>');
            },
            success : function(response) {
                
                if (response.status) {
                    notie.alert('success', 'Berhasil menghapus pengunapan', 1);
                    if (!first) {
                        obj.parent().parent().parent().remove();
                    }else{
                        obj.parent().parent().find('.form-control').attr('readonly', false).val('0');
                        obj.html('<i class="fa fa-trash-o"></i>').prop('disabled', true).removeAttr('onclick');
                    }

                }else{
                    notie.alert('error', 'Terjadi kesalahan memproses.', 3);
                }

                var total = 0;
                $('.harga_penginapan').each(function (index, value) {
                    var curQty = ($(value).parent().find('.qty_penginapan').val().length == 0) ? 0 : $(value).parent().find('.qty_penginapan').val();
                    var curPrice = ($(value).val().length == 0) ? 0 : $(value).val();
                    total = total + (parseInt(curQty) * parseInt(curPrice));
                    $('#subtotal_penginapan').val(rupiahkan(total));
                });

                hitung_total();
            },
            error : function(){
                obj.parent().parent().find('.form-control').attr('readonly', false);
                
                var total = 0;
                $('.harga_penginapan').each(function (index, value) {
                    var curQty = ($(value).parent().find('.qty_penginapan').val().length == 0) ? 0 : $(value).parent().find('.qty_penginapan').val();
                    var curPrice = ($(value).val().length == 0) ? 0 : $(value).val();
                    total = total + (parseInt(curQty) * parseInt(curPrice));
                    $('#subtotal_penginapan').val(rupiahkan(total));
                });
                hitung_total();
            }
        });
    }

    function hapusRiil(id, obj) {
        // console.log(obj);

        $.ajax({
            url : '{{url('rincian-biaya/hapus-riil')}}',
            type : 'POST',
            data : 'id=' + id + '&_token={{csrf_token()}}' ,
            beforeSend : function() {
                obj.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            },
            success : function(response) {
                
                if (response.status) {
                    notie.alert('success', 'Berhasil menghapus pengeluaran riil', 1);
                    obj.parent().parent().prev().remove();
                    obj.parent().parent().remove();

                }else{
                    notie.alert('error', 'Terjadi kesalahan memproses.', 2);
                }

                var total = 0;
                $('.riil_item').each(function (index, value) {
                    total = total + parseInt($(value).val());
                });

                $('#riil_subtotal').val(rupiahkan(total));

                hitung_total();
            },
            error : function(){
                obj.html('<i class="fa fa-trash-o"></i>').prop('disabled', false);
                hitung_total();
            }
        });
    }

    $(document).on('change', '.jenis_pengeluaran_riil', function() {
       
        var jenis = $(this).find(':selected').val();
            $(this).parent().parent().find('.subtotal_pengeluaran_riil').val('0');
             
             recalculateRiil();
        if (jenis == 'Biaya Riil Penginapan') {
            var refPenginapan = parseInt({{$response['data']['referensi']['uang_penginapan']}});
            var maxPenginapan = parseInt(0.3 * refPenginapan);
            $(this).parent().parent().find('.subtotal_pengeluaran_riil').prop('max', '').prop('readonly', true);
            $(this).wrap('<div class="form-group"><div class="col-md-6"></div></div>');
            $(this).parent().parent().append('<div class="col-md-2"><input type="number" name="qty_riil[]" data-toggle="tooltip" title="Jumlah" class="form-control qty_riil" min="0" step="1"></div><div class="col-md-4"><input type="number" data-toggle="tooltip" title="Harga" name="harga_riil_penginapan[]" class="form-control harga_riil" min="0" step="1" max="'+maxPenginapan+'"></div>');
            $('[data-toggle="tooltip"]').tooltip();

        } else if(jenis == 'Kantor Bandara PP'){
            var maxUangTaksiAsal = parseInt({{$response['data']['referensi']['uang_taksi_asal']}} * 2);
            if ($(this).parent().parent().attr('class') == 'form-group') {
                $(this).parent().parent().find('input[name="qty_riil[]"]').parent().remove();
                $(this).parent().parent().find('.harga_riil').parent().remove();
                $(this).unwrap().unwrap();
            }

            $(this).parent().parent()
                .find('.subtotal_pengeluaran_riil')
                .attr('max', maxUangTaksiAsal).prop('readonly', false);

        } else if(jenis == 'Hotel Bandara PP'){
            var maxUangTaksiTujuan = parseInt({{$response['data']['referensi']['uang_taksi_tujuan']}} * 2);
            if ($(this).parent().parent().attr('class') == 'form-group') {
                $(this).parent().parent().find('input[name="qty_riil[]"]').parent().remove();
                $(this).parent().parent().find('.harga_riil').parent().remove();
                $(this).unwrap().unwrap();
            }

            $(this).parent().parent()
                .find('.subtotal_pengeluaran_riil')
                .attr('max', maxUangTaksiTujuan).prop('readonly', false);

        } else {
            if ($(this).parent().parent().attr('class') == 'form-group') {
                $(this).parent().parent().find('input[name="qty_riil[]"]').parent().remove();
                $(this).parent().parent().find('.harga_riil').parent().remove();
                $(this).unwrap().unwrap();
            }

            $(this).parent().parent()
                .find('.subtotal_pengeluaran_riil')
                .val('0').attr('max','').prop('readonly', false);
        }
    });

    $(document).on({
        change : function() {
            var harga = $(this).parent().parent().parent().find('.harga_riil');
            if (harga.length > 0 && parseInt(harga.val()) > 0) {
                console.log(harga.val());
                $(this).parent().parent().parent().parent().find('.subtotal_pengeluaran_riil').val(parseInt($(this).val() * harga.val()));
            }
            recalculateRiil();
        },
        keyup : function() {
            var harga = $(this).parent().parent().parent().find('.harga_riil');
            if (harga.length > 0 && parseInt(harga.val()) > 0) {
                console.log(harga.val());
                $(this).parent().parent().parent().parent().find('.subtotal_pengeluaran_riil').val(parseInt($(this).val() * harga.val()));
            }

            recalculateRiil();
        }
    }, '.qty_riil');

    $(document).on({
        change : function() {
            var qty = $(this).parent().parent().parent().find('.qty_riil');
            if (qty.length > 0 && parseInt(qty.val()) > 0) {
                // console.log(qty.val());
                if(parseInt($(this).val()) > parseInt($(this).attr('max'))){
                    notie.alert('warning', 'Maksimum: 3% x {{$response['data']['referensi']['uang_penginapan']}} = {{$response['data']['referensi']['uang_penginapan'] * 0.3}}', 2);
                    $(this).val({{$response['data']['referensi']['uang_penginapan'] * 0.3}}).addClass('animated shake');
                }
             
                $(this).parent().parent().parent().parent().find('.subtotal_pengeluaran_riil').val(parseInt($(this).val() * qty.val()));
            }
            
            recalculateRiil();
        },
        keyup : function() {
            var qty = $(this).parent().parent().parent().find('.qty_riil');
            if (qty.length > 0 && parseInt(qty.val()) > 0) {
                // console.log(qty.val());
                if(parseInt($(this).val()) > parseInt($(this).attr('max'))){
                    notie.alert('warning', 'Maksimum: 3% x {{$response['data']['referensi']['uang_penginapan']}} = {{$response['data']['referensi']['uang_penginapan'] * 0.3}}', 2);
                    $(this).val({{$response['data']['referensi']['uang_penginapan'] * 0.3}}).addClass('animated shake');
                }

                $(this).parent().parent().parent().parent().find('.subtotal_pengeluaran_riil').val(parseInt($(this).val() * qty.val()));
            }

            recalculateRiil();
        }
    }, '.harga_riil');

</script>
@endsection