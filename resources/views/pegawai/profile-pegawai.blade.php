@extends('layouts.master')

@section('css')
<link href="{{url('assets')}}/css/button-datatables.css" rel="stylesheet" type="text/css"/>
<link href="{{url('assets')}}/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('head_title', 'Profile Pegawai')

@section('title')
Profile
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('pegawai')}}">Data Pegawai</a>
</li>
<li class="active">
    Profile
</li>
@endsection

@section('content')
<div class="col-lg-12">
    <section class="box">
        <div class="content-body" style="overflow: hidden;">
            <div class="col-md-6">
                <div class="uprofile-info text-center">
                    <img src="{{url('assets')}}/images/user.jpg" class="img-circle" alt="profile" width="150" height="150">
                    <ul class="list-unstyled" style="margin-top: 10px;">
                        <li>{{$pegawai->nama}}</li>                    
                        <li>{{$pegawai->nip}}</li>
                        <li>{{$pegawai->status}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="uprofile-info">                
                    {{-- <h4><b>Detail</b></h4> --}}
                    <dl class="dl-horizontal">
                        <dt>PNS</dt>
                        <dd>{{$pegawai->pns}}</dd>
                        <dt>Unit Kerja</dt>
                        <dd>{{$pegawai->unit_kerja}}</dd>
                        <dt>Golongan</dt>
                        <dd>{{$pegawai->golongan}}</dd>
                        <dt>Pangkat</dt>
                        <dd>{{$pegawai->pangkat}}</dd>
                        <dt>Nama Pangkat</dt>
                        <dd>{{$pegawai->nama_pangkat}}</dd>
                        <dt>Jabatan</dt>
                        <dd>{{$pegawai->jabatan}}</dd>
                        <dt>Eselon</dt>
                        <dd>{{$pegawai->eselon}}</dd>
                        <dt>Tingkat Perjadin</dt>
                        <dd>{{$pegawai->tingkat_perjadin}}</dd>
                    </dl>                                                                                                                     
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection
