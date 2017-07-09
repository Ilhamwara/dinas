@extends('layouts.master')

@section('css')
    <link href="{{url('assets')}}/css/button-datatables.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets')}}/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('head_title', 'Tambah Uang Harian Luar')

@section('title')
    Tambah Uang Harian Luar
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('uang-harian-luar-negeri')}}"><i class="fa fa-calendar"></i> &nbsp;Uang Harian Luar</a>
</li>
<li class="active">Tambah Uang Harian Luar</li>
@endsection

@section('content')

@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<div class="panel panel-default col-lg-12">
    <div class="panel-body">
        <form method="post" action="{{url('uang-harian-luar-negeri/tambah-proses/')}}" role="form" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-md-3">Negara</label>
                <div class="col-md-6">
                    {{-- <input type="text" class="form-control" name="negara" required> --}}
                    <select name="negara" id="negara" class="form-control" required>
                        @forelse($tujuanDinas as $k => $v)
                            <option value="{{$v->id}}">{{$v->tujuan}}</option>
                        @empty
                            <option>BELUM ADA TUJUAN DINAS LUAR NEGERI</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Golongan A</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><b>$</b></span>
                        <input type="number" class="form-control" name="gol_a" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Golongan B</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><b>$</b></span>
                        <input type="number" class="form-control" name="gol_b" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Golongan C</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><b>$</b></span>
                        <input type="number" class="form-control" name="gol_c" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Golongan D</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><b>$</b></span>
                        <input type="number" class="form-control" name="gol_d" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{csrf_field()}}
                <div class="col-md-2 pull-right">
                    <button class="btn btn-success">Simpan</button>                      
                </div>
                <div class="col-md-1 pull-right" style="margin: 0px 5px;">
                    <a href="{{url('uang-harian-luar-negeri')}}" class="btn btn-default">Kembali</a>  
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
@endsection
