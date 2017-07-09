@extends('layouts.master')

@section('css')
<link href="{{url('assets')}}/css/button-datatables.css" rel="stylesheet" type="text/css"/>
<link href="{{url('assets')}}/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('head_title', 'Edit Referensi')

@section('title')
Edit Referensi
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('referensi')}}"><i class="fa fa-list-ol"></i> &nbsp;Referensi</a>
</li>
<li class="active">
    Edit Referensi
</li>
@endsection

@section('content')

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<div class="panel panel-default col-lg-12">
    <div class="panel-body">
        <form method="post" action="" role="form" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-md-3">Jenis Referensi</label>
                <div class="col-md-6">
                    <select name="jenis_referensi" class="form-control" required="required" id="jenis_referensi">
                        @forelse($jenisReferensi as $k => $v)
                        <option value="{{$v->id}}" @if($v->id == $referensi->jenis_referensi) selected @endif>{{$v->nama}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Tujuan Dinas</label>
                <div class="col-md-6">
                    <select name="tujuan" class="form-control" required="required" id="tujuan">
                        @forelse($tujuanDinas as $k => $v)
                        <option value="{{$v->id}}" @if($v->id == $referensi->tujuan_id) selected @endif>{{$v->tujuan}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Kelas</label>
                <div class="col-md-1">
                    <input type="radio" name="kelas" value="A" @if($referensi->kelas == 'A') checked @endif required> A
                </div>
                <div class="col-md-1">
                    <input type="radio" name="kelas" value="B" @if($referensi->kelas == 'B') checked @endif required> B
                </div>
                <div class="col-md-1">
                    <input type="radio" name="kelas" value="C" @if($referensi->kelas == 'C') checked @endif required> C
                </div>
                <div class="col-md-3">
                    <input type="radio" name="kelas" value="Netral" @if($referensi->kelas == 'Netral') checked @endif required> Netral
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Nama</label>
                <div class="col-md-6">
                    <!-- <input type="text" class="form-control" name="nama_referensi" value="{{$referensi->nama}}" required > -->
                    <select name="nama_referensi" class="form-control" required="required" id="tujuan">
                        <option value="Sewa Kendaraan Roda 4" @if($referensi->nama == 'Sewa Kendaraan Roda 4') selected @endif>Sewa Kendaraan Roda 4</option>
                        <option value="Sewa Kendaraan Bus Sedang" @if($referensi->nama == 'Sewa Kendaraan Bus Sedang') selected @endif>Sewa Kendaraan Bus Sedang</option>
                        <option value="Sewa Kendaraan Bus Besar" @if($referensi->nama == 'Sewa Kendaraan Bus Besar') selected @endif>Sewa Kendaraan Bus Besar</option>
                        <option value="Uang Harian Biasa Dalam Kota" @if($referensi->nama == 'Uang Harian Biasa Dalam Kota') selected @endif>Uang Harian Biasa Dalam Kota</option>
                        <option value="Uang Harian Biasa Luar Kota" @if($referensi->nama == 'Uang Harian Biasa Luar Kota') selected @endif>Uang Harian Biasa Luar Kota</option>
                        <option value="Uang Harian Biasa Diklat" @if($referensi->nama == 'Uang Harian Biasa Diklat') selected @endif>Uang Harian Biasa Diklat</option>
                        <option value="Uang Harian Rapat Fullboard Dalam Kota" @if($referensi->nama == 'Uang Harian Rapat Fullboard Dalam Kota') selected @endif>Uang Harian Rapat Fullboard Dalam Kota</option>
                        <option value="Uang Harian Rapat Fullboard Luar Kota" @if($referensi->nama == 'Uang Harian Rapat Fullboard Luar Kota') selected @endif>Uang Harian Rapat Fullboard Luar Kota</option>
                        <option value="Uang Harian Rapat FullHalf Dalam Kota" @if($referensi->nama == 'Uang Harian Rapat FullHalf Dalam Kota') selected @endif>Uang Harian Rapat Fullhalf Dalam Kota</option>
                        <option value="Uang Penginapan" @if($referensi->nama == 'Uang Penginapan') selected @endif>Uang Penginapan</option>
                        <option value="Uang Taksi" @if($referensi->nama == 'Uang Taksi') selected @endif>Uang Taksi</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Tahun</label>
                <div class="col-md-6">
                    <select class="form-control" name="tahun" id="tahun" required>
                        @for($i = (date('Y') -2); $i <= (date('Y') +2); $i++)
                        <option value="{{$i}}" @if($i == $referensi->tahun) selected @endif>{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Harga</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Rp. </span>
                        <input type="number" min="1" step="1" name="harga" value="{{$referensi->harga}}" class="form-control" required="required" data-inputmask="'mask': '9'">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$referensi->id}}">
                </div>
                <div class="col-md-6">
                    <a href="{{url('referensi')}}" class="btn btn-default pull-left">Kembali</a>
                    <button type="submit" class="btn btn-success pull-right">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection


@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $(":input").inputmask();
    });
</script>
@endsection
