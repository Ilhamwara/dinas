@extends('layouts.master')

@section('css')
<link href="{{url('assets')}}/css/button-datatables.css" rel="stylesheet" type="text/css"/>
<link href="{{url('assets')}}/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('head_title', 'Tambah Uang Representatif')

@section('title')
Tambah Uang Representatif
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('uang-representatif')}}"><i class="fa fa-universal-access"></i> &nbsp;Uang Representatif</a>
</li>
<li class="active">Tambah Uang Representatif</li>
@endsection

@section('content')

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<div class="panel panel-default col-lg-12">
    <div class="panel-body">
        <form method="post" action="{{url('uang-representatif/tambah-proses/')}}" role="form" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-md-3">Nama Representatif</label>
                <div class="col-md-6">
                    <select name="nama_representatif" class="form-control" required="required">
                        <option value="Pejabat Negara">Pejabat Negara</option>
                        <option value="Pejabat Eselon I">Pejabat Eselon 1</option>
                        <option value="Pejabat Eselon II">Pejabat Eselon II</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Luar Kota</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><b>Rp</b></span>
                        <input type="text" class="form-control" name="lukot" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Dalam Kota</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><b>Rp</b></span>
                        <input type="text" class="form-control" name="dalkot" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{csrf_field()}}
                <div class="col-md-2 pull-right">
                    <button class="btn btn-success">Simpan</button>                      
                </div>
                <div class="col-md-1 pull-right" style="margin: 0px 5px;">
                    <a href="{{url('uang-representatif')}}" class="btn btn-default">Kembali</a>  
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
@endsection
