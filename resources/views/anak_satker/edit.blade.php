@extends('layouts.master')

@section('css')

@endsection

@section('head_title', 'Edit Anak Satker')


@section('title')
Edit Anak Satker
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('anak-satker')}}"><i class="fa fa-legal"></i> &nbsp;Data Anak Satker</a>
</li>
<li class="active">
    Edit Anak Satker
</li>
@endsection

@section('content')

@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<div class="col-lg-12">
    <section class="box">
        <div class="content-body">
            <form role="form" method="post" action="" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-md-2">Tahun</label>
                    <div class="col-md-3">
                        <select name="tahun" class="form-control" id="tahun" required>
                            @for($i = date('Y'); $i < date('Y') + 4; $i++)
                                <option value="{{$i}}" @if($i == $anak_satker->tahun) selected @endif>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Kode Anak Satker</label>
                    <div class="col-md-3">
                        <input type="text" name="kode" id="kode" class="form-control" value="{{$anak_satker->kode}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Unit Kerja</label>
                    <div class="col-md-6">
                        <select name="unit_kerja" id="unit_kerja" class="form-control" required>
                            @forelse($satker as $k => $v)
                                <option value="{{$v->satker_id}}" @if($v->satker_id == $anak_satker->id_unit_kerja) selected @endif>{{$v->unit_kerja}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Alokasi Nomor SPD</label>
                    <div class="col-md-3">
                        <input type="text" name="nomor_spd" id="nomor_spd" class="form-control" value="{{$anak_satker->nomor_spd}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">PPK</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Nama</span>
                            <input type="text" class="form-control" name="nama_ppk" value="{{$anak_satker->nama_ppk}}" placeholder="Nama" aria-describedby="basic-addon1" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">NIP</span>
                            <input type="text" class="form-control" name="nip_ppk" value="{{$anak_satker->nip_ppk}}" placeholder="NIP" aria-describedby="basic-addon1" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Bendahara</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Nama</span>
                            <input type="text" class="form-control" name="nama_bendahara" value="{{$anak_satker->nama_bendahara}}" placeholder="Nama" aria-describedby="basic-addon1" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">NIP</span>
                            <input type="text" class="form-control" name="nip_bendahara" value="{{$anak_satker->nip_bendahara}}" placeholder="NIP" aria-describedby="basic-addon1" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2">
                        {{csrf_field()}}
                    </div>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-success pull-right">Simpan <i class="fa fa-save"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection