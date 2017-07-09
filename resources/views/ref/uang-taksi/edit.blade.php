@extends('layouts.master')

@section('css')
<link href="{{url('assets')}}/css/button-datatables.css" rel="stylesheet" type="text/css"/>
<link href="{{url('assets')}}/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('head_title', 'Tambah Uang Taksi')

@section('title')
Tambah Uang Taksi
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('uang-taksi')}}"><i class="fa fa-cab"></i> &nbsp;Uang Taksi</a>
</li>
<li class="active">Tambah Uang Taksi</li>
@endsection

@section('content')

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<div class="panel panel-default col-lg-12">
    <div class="panel-body">
        <form method="post" action="{{url('uang-taksi/edit-proses/'.$UangTaksi->id)}}" role="form" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-md-3">Tujuan Dinas</label>
                <div class="col-md-6">
                    <select name="tujuan_dinas_id" class="form-control" required="required">
                        @forelse($UangTaksiAll as $k => $v)
                        <option value="{{$v->id}}" @if($v->id == $UangTaksi->id) selected @endif>{{$v->tujuan_dinas}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Nominal</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><b>Rp</b></span>
                        <input type="text" class="form-control" name="jumlah" required value="{{$UangTaksi->jumlah}}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{csrf_field()}}
                <div class="col-md-2 pull-right">
                    <button class="btn btn-success">Simpan</button>                      
                </div>
                <div class="col-md-1 pull-right" style="margin: 0px 5px;">
                    <a href="{{url('uang-taksi')}}" class="btn btn-default">Kembali</a>  
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
@endsection
