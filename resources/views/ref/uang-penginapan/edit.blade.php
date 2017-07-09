@extends('layouts.master')

@section('css')
<link href="{{url('assets')}}/css/button-datatables.css" rel="stylesheet" type="text/css"/>
<link href="{{url('assets')}}/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('head_title', 'Edit Uang Penginapan')

@section('title')
Edit Uang Penginapan
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('uang-penginapan')}}"><i class="fa fa-building"></i> &nbsp;Uang Penginapan</a>
</li>
<li class="active">Edit Uang Penginapan</li>
@endsection

@section('content')

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<div class="panel panel-default col-lg-12">
    <div class="panel-body">
        <form method="post" action="{{url('uang-penginapan/edit-proses/'.$UangPenginapan->id)}}" role="form" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-md-3">Tujuan Dinas</label>
                <div class="col-md-6">
                    <select name="tujuan_dinas_id" class="form-control" required="required">
                        @forelse($UangPenginapanAll as $k => $v)
                        <option value="{{$v->id}}" @if($v->id == $UangPenginapan->id) selected @endif>{{$v->tujuan_dinas}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Eselon I</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><b>Rp</b></span>
                        <input type="text" class="form-control" name="eselon_satu" value="{{$UangPenginapan->eselon_satu}}" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Eselon II</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><b>Rp</b></span>
                        <input type="text" class="form-control" name="eselon_dua" value="{{$UangPenginapan->eselon_dua}}" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Eselon III Gol IV</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><b>Rp</b></span>
                        <input type="text" class="form-control" name="eselon_tiga_gol_empat" value="{{$UangPenginapan->eselontiga_golempat}}" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Eselon IV Gol III</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><b>Rp</b></span>
                        <input type="text" class="form-control" name="eselon_empat_gol_tiga" value="{{$UangPenginapan->eselonempat_goltiga}}" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Gol I II</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon"><b>Rp</b></span>
                        <input type="text" class="form-control" name="gol_satu_dua" value="{{$UangPenginapan->golongan_satudua}}" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{csrf_field()}}
                <div class="col-md-2 pull-right">
                    <button class="btn btn-success">Simpan</button>                      
                </div>
                <div class="col-md-1 pull-right" style="margin: 0px 5px;">
                    <a href="{{url('uang-penginapan')}}" class="btn btn-default">Kembali</a>  
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
@endsection
