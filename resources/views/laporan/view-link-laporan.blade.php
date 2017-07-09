@extends('layouts.master')

@section('head_title', 'Download Laporan Perjalanan Dinas')
@section('title')
Download Laporan Perjalanan Dinas
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    Download Laporan Perjalanan Dinas
</li>
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="col-md-6" style="background: #eee">
				<h4>Rincian SPD</h4>
				<dl class="dl-horizontal">
					<dt>Nama Kegiatan</dt>
						<dd>{{$spd->st->kegiatan->nama_kegiatan}}</dd>
					<dt>No Surat Tugas</dt>
                        <dd id="mno_st">{{$spd->st->no_st}}</dd>
                    <dt>Tujuan Dinas</dt>
                        <dd id="mtujuan_dinas">{{$spd->st->kegiatan->lokasi_kegiatan}}</dd>
                    <dt>Sejak</dt>
                        <dd id="mtanggal_awal">{{$spd->st->kegiatan->tanggal_awal}}</dd>
                    <dt>Hingga</dt>
                        <dd id="mtanggal_akhir">{{$spd->st->kegiatan->tanggal_akhir}}</dd>
				</dl>
			</div>
			<div class="col-md-6">
				<a href="{{url('laporan/download/' . $laporan->first()->file)}}" target="_blank" class="btn btn-sm btn-danger btn-block">Download <i class="fa fa-download"></i></a>
			</div>
		</div>
		
	</div>
@endsection

@section('js')
@endsection