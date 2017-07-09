@extends('layouts.master')

@section('head_title', 'Upload Laporan Perjalanan Dinas')
@section('title')
Upload Laporan Perjalanan Dinas
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    Upload Laporan Perjalanan Dinas
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
				<form method="post" action="" enctype="multipart/form-data">
					{{csrf_field()}}
					<div class="form-group">
						<label for="file" class="control-label col-md-2">File</label>
						<div class="col-md-10">
							<input type="file" name="upload" accept="application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword" required>
							<span class="help-block">File hanya berupa file PDF atau Ms. Word.<br> Maks. 8MB</span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-2">
							<input type="hidden" name="spd_id" value="{{$spd->hashid}}">
							<input type="hidden" name="st_id" value="{{$spd->st->hashid}}">
						</div>
						<div class="col-md-10">
							<button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-upload"></i> Upload</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		
	</div>
@endsection

@section('js')
@endsection