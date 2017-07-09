@extends('layouts.master')

@section('css')
    <link href="{{url('assets')}}/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        dt, dd{
            line-height: 2;
        }
    </style>
@endsection

@section('head_title', 'Rincian Biaya Perjadin')

@section('title')
    Rincian Biaya Perjalanan Dinas Luar Negeri
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    Rincian Biaya Perjalanan Dinas Luar Negeri
</li>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form role="form" method="POST" action="" class="form-horizontal">
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt>Nama Kegiatan</dt>
                        <dd>
                            {{$spd->st->kegiatan->nama_kegiatan}}
                        </dd>
                        <dt>Jenis Kegiatan</dt>
                        <dd>
                            <span class="label label-danger"><i class="fa fa-plane"></i> LUAR NEGERI</span>
                        </dd>
                        <dt>Lokasi Kegiatan</dt>
                        <dd>
                            {{$spd->st->kegiatan->lokasi_kegiatan}}
                        </dd>
                        <dt>Tanggal Pelaksanaan</dt>
                        <dd>
                            {{\App\Library\Datify::readify($spd->st->kegiatan->tanggal_awal) . ' s/d ' . \App\Library\Datify::readify($spd->st->kegiatan->tanggal_akhir)}}
                        </dd>
                        <dt>Pelaksana</dt>
                        <dd>
                            {{$spd->nama_pegawai}}<br>
                            NIP. {{$spd->nip}}
                        </dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="qty" class="control-label col-md-3">Jumlah</label>
                        <div class="col-md-9">
                            <input type="number" name="qty" class="form-control" required min="1" step="1" max="7">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ref" class="control-label col-md-3">Maksimum</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">$</span>
                                <input type="text" class="form-control" value="" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection 

@section('js')
<script type="text/javascript" src="{{asset('assets/js/terbilang.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/rupiah.js')}}"></script>
<script type="text/javascript" src="{{url('assets')}}/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="{{url('assets')}}/js/bootstrap-datepicker.id.min.js"></script>

@endsection