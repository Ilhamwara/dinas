{{-- <h6>Surat Perjalanan Dinas (SPD)</h6> --}}
@extends('layouts.master')

@section('css')
    <link href="{{url('assets')}}/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets')}}/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets')}}/css/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        .main  {border-collapse:collapse;border-spacing:0;width: 100%;}
        .main td{font-family:Arial, sans-serif;font-size:12px;padding:5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
        .main th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
        .main .main-yw4l{vertical-align:top}
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{font-family:Arial, sans-serif;font-size:12px;padding:5px;overflow:hidden;word-break:normal;}
        .tg th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:5px;overflow:hidden;word-break:normal;}
        .tg .tg-yw4l{vertical-align:middle;}
        .ttd  {border-collapse:collapse;border-spacing:0;}
        .ttd td{font-family:Arial, sans-serif;font-size:12px;padding:2px;overflow:hidden;word-break:normal;}
        .ttd th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:2px;overflow:hidden;word-break:normal;}
        .ttd .ttd-yw4l{vertical-align:top}
        .form-control {
            /*border: 1px solid #fc0;*/
        }
    </style>
@endsection

@section('head_title', 'Buat SPD')


@section('title')
Buat SPD
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('spd')}}"><i class="fa fa-envelope"></i> &nbsp;SPD</a>
</li>
<li class="active">
    Buat SPD
</li>
@endsection

@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Ada yang tidak beres</strong><br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form role="form" class="form-horizontal" id="mainForm" method="post" action="{{url('spd/store')}}" >
<div class="col-lg-12">
    <div class="box">
        <div class="content-body">

            <table class="tg">
                <tr>
                    <td class="tg-031e">Lembar Ke</td>
                    <td class="tg-031e">:</td>
                    <td class="tg-031e"></td>
                </tr>
                <tr>
                    <td class="tg-031e">Kode No</td>
                    <td class="tg-031e">:</td>
                    <td class="tg-031e"></td>
                </tr>
                <tr>
                    <td class="tg-yw4l">Nomor  </td>
                    <td class="tg-031e">:</td>
                    <td class="tg-yw4l">
                        <input type="text" name="nomor_surat" class="form-control input-sm" style="width: 400px;" required="required" value="{{$suratTugas->pagu->anakSatker->nomor_spd . '/' . $suratTugas->pagu->tahun}}" readonly autofocus>
                    </td>
                </tr>
            </table>

            {{-- <h5 style="text-align: center;margin: 10px;">Surat Perjalanan Dinas (SPD)</h5> --}}

            <table class="main">
                <tr>
                    <td class="main-031e" style="text-align: center;width: 10px;">1</td>
                    <td class="main-031e">Pejabat berwenang yang memberikan perintah</td>
                    <td class="main-yw4l" colspan="2">Pejabat Pembuat Komitmen Kegiatan</td>
                </tr>
                <tr>
                    <td class="main-yw4l" style="text-align: center;width: 10px;">2</td>
                    <td class="main-yw4l">Nama Pegawai yang diperintahkann</td>
                    <td class="main-yw4l" colspan="2">
                        <input type="text" name="nama_pegawai" class="form-control input-sm" value="{{$pegawai->nama}}" readonly>
                        <input type="hidden" name="id_pegawai" value="{{$pegawai->pegawai_id}}">
                    </td>
                </tr>
                <tr>
                    <td class="main-031e" style="text-align: center;width: 10px;">3</td>
                    <td class="main-031e">a. Pangkat/Gol<br>b. Jabatan dan Instansi<br>c. Tingkat Biaya Perjalanan Dinas</td>
                    <td class="main-yw4l" colspan="2">
                        <div class="input-group form-group-sm" style="width: 100%;">
                            <span class="input-group-addon" id="basic-addon1">a. </span>
                            <input type="text" name="pangkat_pegawai" class="form-control" aria-describedby="basic-addon1" value="{{$pegawai->pangkat . '/' . $pegawai->golongan}}" readonly>
                        </div>
                        <div class="input-group form-group-sm" style="width: 100%;">
                            <span class="input-group-addon" id="basic-addon1">b. </span>
                            <input type="text" name="golongan_pegawai" class="form-control" aria-describedby="basic-addon1" value="{{$pegawai->jabatan}}" readonly>
                        </div>
                        <div class="input-group form-group-sm" style="width: 100%;">
                            <span class="input-group-addon" id="basic-addon1">c. </span>
                            <input type="text" name="kelas_pegawai" class="form-control" aria-describedby="basic-addon1" value="{{$pegawai->tingkat_perjadin}}" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="main-031e" style="text-align: center;width: 10px;">4</td>
                    <td class="main-031e">Maksud Perjalanan DInas</td>
                    <td class="main-yw4l" colspan="2">
                        <textarea name="maksud_perjadin" class="form-control input-sm" required="required" readonly>{{$suratTugas->kegiatan->nama_kegiatan}}</textarea>
                    </td>
                </tr>
                <tr>
                    <td class="main-yw4l" style="text-align: center;width: 10px;">5</td>
                    <td class="main-yw4l">Alat angkutan yang dipergunakan</td>
                    <td class="main-yw4l" colspan="2">
                        {{-- <input type="text" name="alat_angkutan" class="form-control input-sm"> --}}
                        <select name="alat_angkutan" class="form-control input-sm">
                            <option value="Pesawat" @if(isset($spd) AND $spd->tipe_transport == 'Pesawat') selected @endif>Pesawat</option>
                            <option value="Taxi" @if(isset($spd) AND $spd->tipe_transport == 'Taxi') selected @endif>Taxi</option>
                            <option value="Kereta" @if(isset($spd) AND $spd->tipe_transport == 'Kereta') selected @endif>Kereta</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="main-yw4l" style="text-align: center;width: 10px;">6</td>
                    <td class="main-yw4l">a. Tempat Berangkat<br>b. Tempat Tujuan</td>
                    <td class="main-yw4l" colspan="2">
                        <div class="input-group form-group-sm" style="width: 100%;">
                            <span class="input-group-addon" id="basic-addon1">a. </span>
                            {{-- <input type="text" name="tempat_berangkat_perjadin" class="form-control" aria-describedby="basic-addon1" value="Jakarta" required="required"> --}}
                            <select name="tempat_berangkat_perjadin" class="form-control" required="required">
                                @forelse($tujuan as $k => $v)
                                    <option value="{{$v->id}}" @if($v->id == 13) selected @endif>{{$v->tujuan}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="input-group form-group-sm" style="width: 100%;">
                            <span class="input-group-addon" id="basic-addon1">b. </span>
                            <input type="text" name="tujuan_dinas" class="form-control" aria-describedby="basic-addon1" value="{{$suratTugas->tujuan_dinas}}" readonly>
                            
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="main-yw4l" style="text-align: center;width: 10px;">7</td>
                    <td class="main-yw4l">a. Lamanya perjalanan dinas<br>b. Tanggal Berangkat<br>c. Tanggal harus kembali</td>
                    <td class="main-yw4l" colspan="2">
                        <div class="input-group form-group-sm" style="width: 100%;">
                            <span class="input-group-addon" id="basic-addon1">a. </span>
                            <input type="text" name="lama_perjalanan" class="form-control" aria-describedby="basic-addon1" value="{{$lamaPerjalanan}} hari" readonly>
                        </div>
                        <div class="input-group form-group-sm" style="width: 100%;">
                            <span class="input-group-addon" id="basic-addon1">b. </span>
                            <input type="text" name="sejak" id="sejak" class="form-control" aria-describedby="basic-addon1" value="{{\App\Library\Datify::readify(substr($suratTugas->tanggal_awal, 0, 10))}}" readonly>
                        </div>
                        <div class="input-group form-group-sm" style="width: 100%;">
                            <span class="input-group-addon" id="basic-addon1">c. </span>
                            <input type="text" name="hingga" id="hingga" class="form-control" aria-describedby="basic-addon1" value="{{\App\Library\Datify::readify(substr($suratTugas->tanggal_akhir, 0, 10))}}" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="main-yw4l" style="text-align: center;width: 10px;">8</td>
                    <td class="main-yw4l">
                        Pengikut: Nama<br>
                        <div class="input-group form-group-sm" style="width: 100%;">
                            <span class="input-group-addon" id="basic-addon1">1. </span>
                            <input type="text" name="nama_pengikut[]" class="form-control" aria-describedby="basic-addon1" value="">
                        </div>
                    <td class="main-yw4l">
                        Tanggal Lahir<br>
                        <div class="input-group form-group-sm" style="width: 100%;">
                            <span class="input-group-addon" id="basic-addon1">1. </span>
                            <input type="text" name="tgl_lahir_pengikut[]" class="form-control" aria-describedby="basic-addon1" value="">
                        </div>
                    </td>
                    <td class="main-yw4l">
                        Keterangan<br>
                        <div class="input-group form-group-sm" style="width: 100%;">
                            <span class="input-group-addon" id="basic-addon1">1. </span>
                            <input type="text" name="keterangan_pengikut[]" class="form-control" aria-describedby="basic-addon1" value="">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="main-yw4l" style="text-align: center;width: 10px;">9</td>
                    <td class="main-yw4l">Pembebanan anggaran:<br>a. Instansi<br>b. Akun</td>
                    <td class="main-yw4l" colspan="2" style="width: 50%">
                        {{$suratTugas->pagu->tahun}}<br>
                        <div class="input-group form-group-sm" style="width: 100%;">
                            <span class="input-group-addon" id="basic-addon1">a. </span>
                            <input type="text" name="beban_instansi" id="beban_instansi" class="form-control" required="required" readonly value="Kemenko. Perekonomian RI">
                            {{-- <input type="text" name="beban_instansi" class="form-control" aria-describedby="basic-addon1" value=""> --}}
                        </div>
                        <div class="input-group form-group-sm" style="width: 100%;">
                            <span class="input-group-addon" id="basic-addon1">b. </span>
                            <input type="text" name="beban_akun" class="form-control" aria-describedby="basic-addon1" value="{{$suratTugas->pagu->kegiatan  . '.' . $suratTugas->pagu->output . '.' . $suratTugas->pagu->akun}}" required readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="main-yw4l" style="text-align: center;width: 10px;">10</td>
                    <td class="main-yw4l">Keteragan lain-lain</td>
                    <td class="main-yw4l" colspan="2">
                        <textarea name="keterangan" class="form-control input-sm"></textarea>
                    </td>
                </tr>
            </table>

            {{-- <div class="col-md-12">    --}}
            <hr>
                <table class="ttd">
                <tr>
                    <td class="ttd-yw4l">Dikeluarkan di</td>
                    <td class="ttd-yw4l">:</td>
                    <td class="ttd-yw4l">
                        <input type="text" name="tempat_dikeluarkan_surat" class="form-control input-sm" style="width: 400px;" required="required" value="Jakarta">
                    </td>
                </tr>
                <tr>
                    <td class="ttd-031e">Pada Tanggal</td>
                    <td class="ttd-031e">:</td>
                    <td class="ttd-yw4l">
                        <input type="text" id="tgl_surat" name="tgl_surat" class="form-control input-sm" style="width: 400px;" value="{{(isset($tglSpd)) ? \App\Library\Datify::readify(substr($tglSpd, 0, 10)) : ''}}"  required>
                    </td>
                </tr>
                <tr>
                    <td class="ttd-031e" colspan="3">Pejabat Pembuat Komitmen Kegiatan</td>
                </tr>
                <tr>
                    <td class="ttd-031e" colspan="3" style="padding-top: 72px;font-weight: bold;">
                        {{-- <strong style="text-decoration: underline;">Agam embun Sunarpati</strong> --}}
                        <input type="text" name="pejabat" class="form-control input-sm" required="required" id="pejabat" readonly value="{{$suratTugas->pagu->nm_ppk}}">
                    </td>
                </tr>
                <tr>
                    <td class="ttd-031e" colspan="3" style="padding-top: 0;">
                        NIP. <span id="nip">{{$suratTugas->pagu->nip_ppk}}</span>
                        <input type="hidden" name="nip_pejabat" id="nip_pejabat" value="{{$suratTugas->pagu->nip_ppk}}">
                    </td>
                </tr>
                </table>

                <br>
                <hr>
                    {{csrf_field()}}
                    <input type="hidden" name="st_id" value="{{$suratTugas->st_id}}">
                    <input type="hidden" name="edit" value="{{$edit}}">
                    <button type="submit" class="btn btn-success pull-right">Simpan &nbsp;<i class="fa fa-save"></i></button>
                <br>
            {{-- </div> --}}
        </div>
    </div>
</div>
</form>
@endsection

@section('js')
    <script type="text/javascript" src="{{url('assets')}}/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="{{url('assets')}}/js/bootstrap-datepicker.id.min.js"></script>
    <script type="text/javascript" src="{{url('assets')}}/js/select2.min.js"></script>
    <script type="text/javascript" src="{{url('assets')}}/js/sweetalert2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            //Datepicker
            var d = new Date();
            var month = d.getMonth()+1;
            var day = d.getDate();
            var year = d.getFullYear();
            $('#tgl_surat').datepicker({
                format : 'dd MM yyyy',
                clearBtn: true,
                language: 'id',
                autoclose: true,
                todayHighlight: true
            });

            //Select2
            // $('#pejabat').select2();
        });

        $('#mainForm').submit(function(){
            
        });
    </script>
@endsection
