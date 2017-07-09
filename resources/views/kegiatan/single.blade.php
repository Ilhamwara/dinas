@extends('layouts.master')

@section('css')
<link href="{{url('assets')}}/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
<link href="{{url('assets')}}/css/select2.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('head_title', 'Detail Kegiatan')


@section('title')
{{$kegiatan->nama_kegiatan}}
@endsection

@section('breadcrumb')
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
    </li>
    <li>
        <a href="{{url('kegiatan')}}">Data Kegiatan</a>
    </li>
    <li class="active">
        {{$kegiatan->nama_kegiatan}}
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
<div class="col-lg-12">
    <section class="box">
        <div class="content-body" id="kegiatan-body">
            <div class="row">
                <form class="form-horizontal" id="kegiatanForm">
                    <div class="col-md-12">                       
                        <div class="form-group row">
                            <label class="control-label col-md-3">Nama Kegiatan*</label>                            
                            <div class="col-md-7">
                                <input type="text" value="{{$kegiatan->nama_kegiatan}}" class="form-control" name="nama_kegiatan" id="nama_kegiatan" data-validation="required" required disabled="disabled" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Nama Penyelenggara</label>
                            <div class="col-md-7">
                                <input type="text" value="{{$kegiatan->nama_penyelenggara}}" class="form-control" name="nama_penyelenggara" id="nama_penyelenggara" disabled="disabled" readonly>
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label class="control-label col-md-3">Tahun Anggaran</label>                            
                            <div class="col-md-7">
                                <input type="text" value="" max="4" class="form-control" name="tahun_anggaran" id="tahun_anggaran" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3" >Akun Kegiatan</label>
                            <div class="col-md-7">
                                <input type="text" value="" class="form-control" name="akun_kegiatan" required>
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label class="control-label col-md-3" >Lokasi Kegiatan*</label>
                            <div class="col-md-7">
                                {{-- <input type="text" value="" class="form-control" name="lokasi_kegiatan" required> --}}
                                <select name="lokasi_kegiatan" class="form-control" id="lokasi_kegiatan" required="required" disabled="disabled" readonly>
                                    @forelse($tujuan as $k => $v)
                                        <option value="{{$v->id}}" @if($kegiatan->lokasi_kegiatan == $v->tujuan) selected @endif>{{$v->tujuan}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="masabakti" class="control-label col-md-3">Tanggal Pelaksanaan*</label>
                            <div class="col-md-7">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="form-control" name="sejak" id="sejak" value="{{\App\Library\Datify::readify($kegiatan->tanggal_awal)}}" required disabled="disabled" readonly>
                                    <span class="input-group-addon">s/d</span>
                                    <input type="text" class="form-control" name="hingga" id="hingga" value="{{\App\Library\Datify::readify($kegiatan->tanggal_akhir)}}" required disabled="disabled" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="padding: 20px 0px;">

                        <div class="col-md-7 col-md-offset-3">             
                            <a href="{{url('kegiatan/edit/' . $kegiatan->kegiatan_id)}}" class="btn btn-primary pull-right" id="saveKegiatan"><i class="fa fa-pencil"></i> Edit</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<div class="col-md-12" id="stContainer">
    <div class="box">
        <div class="content-body">
            
            <table class="table table-condensed table-hover table-striped">
                <thead>
                    <tr>
                        <th>No. Surat</th>
                        <th>Peserta</th>
                    </tr>
                </thead>
                <tbody id="suratTugasRow">
                    @forelse($kegiatan->st as $k => $v)
                        <tr>
                            <td><strong>{{$v->no_st}}</strong><br>
                                Tanggal: {{$v->tanggal_surat}}<br>
                                Dikeluarkan di: {{$v->tempat_dikeluarkan_surat}}<br>
                                Penandatangan: {{$v->nama_inspektur}}
                            </td>
                            <td id="kolom_peserta_{{$v->st_id}}">

                                @forelse($v->detail as $key => $value)
                                    - {{$value->pegawai->nama}}  ({{$value->pegawai->nip}})<br>
                                @empty
                                @endforelse
                            </td>
                        </tr>
                    @empty
                        <tr  id="psST">
                            <td colspan="2">Belum ada surat tugas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
