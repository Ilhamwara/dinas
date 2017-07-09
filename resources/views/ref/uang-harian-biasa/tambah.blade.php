@extends('layouts.master')

@section('css')
<link href="{{url('assets')}}/css/button-datatables.css" rel="stylesheet" type="text/css"/>
<link href="{{url('assets')}}/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('head_title', 'Tambah Uang Harian Biasa')

@section('title')
Tambah Uang Harian Biasa
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('uang-harian')}}"><i class="fa fa-calendar"></i> &nbsp;Uang Harian Biasa</a>
</li>
<li class="active">Tambah Uang Harian Biasa</li>
@endsection

@section('content')

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<div class="panel panel-default col-lg-12">
    <div class="panel-body">
        <form method="post" action="{{url('uang-harian/tambah-proses/')}}" role="form" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-md-3">Tujuan Dinas</label>
                <div class="col-md-6">
                    <select name="tujuan_dinas_id" class="form-control" required="required">
                        @forelse($UangHarianAll as $k => $v)
                        <option value="{{$v->id}}">{{$v->tujuan_dinas}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Luar Kota</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><b>Rp</b></span>
                        <input type="text" class="form-control" name="uang_harian_luar_kota" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Dalam Kota</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><b>Rp</b></span>
                        <input type="text" class="form-control" name="uang_harian_dalam_kota" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Diklat</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><b>Rp</b></span>
                        <input type="text" class="form-control" name="uang_harian_diklat" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{csrf_field()}}
                <div class="col-md-2 pull-right">
                    <button class="btn btn-success">Simpan</button>                      
                </div>
                <div class="col-md-1 pull-right" style="margin: 0px 5px;">
                    <a href="{{url('uang-harian')}}" class="btn btn-default">Kembali</a>  
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
@endsection
