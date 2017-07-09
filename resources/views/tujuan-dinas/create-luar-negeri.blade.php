@extends('layouts.master')

@section('css')

@endsection

@section('head_title', 'Tambah Tujuan Dinas Luar Negeri')

@section('title')
Tambah Tujuan Dinas Luar Negeri
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('tujuan-luar-negeri')}}"> Tujuan Luar Negeri</a>
</li>
<li class="active">
    Tambah Tujuan Dinas Luar Negeri
</li>
@endsection

@section('content')

@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div class="panel panel-default col-lg-12">
    <div class="panel-body">
        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="tujuan" class="control-label col-md-3">Nama Tujuan (Negara)</label>
                <div class="col-md-6">                    
                    <input type="text" name="tujuan" class="form-control" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-primary pull-right">Simpan &nbsp;<i class="fa fa-save"></i></button>
                </div>
            </div>
        </form>
        
    </div>
</div>

@endsection

@section('js')
    
@endsection
