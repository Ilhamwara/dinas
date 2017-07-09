@extends('layouts.master')

@section('css')
    <link href="{{asset('assets')}}/css/button-datatables.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets')}}/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        strong:parent {
            text-align: right;
        }
    </style>
@endsection

@section('head_title', 'Surat Tugas')

@section('title')
Surat Tugas
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    Surat Tugas
</li>
@endsection

@section('content')

 <div class="modal fade " tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail Surat Tugas</h4>
            </div>
            <div class="modal-body">
                <div id="loading" style="text-align: center">
                    <i class="fa fa-spinner fa-spin fa-3x"></i>
                    <br>
                    Loading
                </div>
                <div id="container">
                    <dl class="dl-horizontal">
                        <dt>No Surat</dt>
                            <dd id="mno_st"></dd>
                        <dt>Jenis Kegiatan</dt>
                            <dd id="mjenis_kegiatan"></dd>
                        <dt>Tempat Terbit Surat</dt>
                            <dd id="mtempat_dikeluarkan_surat"></dd>
                        <dt>Tanggal Surat</dt>
                            <dd id="mtanggal_surat"></dd>
                        <dt>Nama Kegiatan</dt>
                            <dd id="mnama_kegiatan"></dd>
                        <dt>Tujuan Dinas</dt>
                            <dd id="mtujuan_dinas"></dd>
                        <dt>Sejak</dt>
                            <dd id="mtanggal_awal"></dd>
                        <dt>Hingga</dt>
                            <dd id="mtanggal_akhir"></dd>
                        
                        <dt>Penandatangan</dt>
                            <dd><span id="mnama_inspektur"></span> (<span id="mnip_inspektur"></span>)</dd>
                    </dl>
                    <a href="{{url('laporan')}}"></a>
                    <hr>
                    <h4>Peserta Perjalanan Dinas</h4>
                    <table id="mpeserta" class="table table-hover table-condensed table-striped"></table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="" class="btn btn-success" target="_blank" id="mcetaknominatif">Cetak Nominatif <i class="fa fa-print"></i></a>
                <a href="" class="btn btn-primary" target="_blank" id="mcetak">Cetak <i class="fa fa-print"></i></a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div class="panel panel-default col-lg-12">
    <div class="panel-body">

        @if(Auth::user()->type == 'admin' OR Auth::user()->type == 'spk')
            <a href="{{url('kegiatan?alert-class=alert-info&message=' . urlencode('Untuk membuat surat tugas, silahkan pilih atau buat kegiatan di bawah ini'))}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Surat Tugas</a>
        @endif
        <br>
        <br>
        <br>
       {!! $dataTable->table() !!}
    </div>
</div>

@endsection

@section('js')
    <script src="{{asset('assets')}}/js/jquery-datatables.js" type="text/javascript"></script> 
    <script src="{{asset('assets')}}/js/button-datatables.js" type="text/javascript"></script> 
    <script src="{{asset('assets')}}/js/zip-datatables.js" type="text/javascript"></script> 
    <script src="{{asset('assets')}}/js/pdf-datatables.js" type="text/javascript"></script> 
    <script src="{{asset('assets')}}/js/fvs-datatables.js" type="text/javascript"></script> 
    <script src="{{asset('assets')}}/js/button-flash.js" type="text/javascript"></script> 
    <script src="{{asset('assets')}}/js/print-datatables.js" type="text/javascript"></script> 
    <script src="{{asset('assets')}}/js/button-html5-datatables.js" type="text/javascript"></script> 
    <script src="{{asset('assets')}}/js/datatables.js" type="text/javascript"></script>
    {!! $dataTable->scripts() !!}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            @if(Session::has('pesan_error'))
                notie.alert('warning', '{{Session::get('pesan_error')}}', 2);
            @endif
        });  
    </script>

    <script type="text/javascript">
        function find(id){
            $('.modal').modal();
            $.ajax({
                url: '{{url('surat-tugas')}}' + '/' + id,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function(){
                    $('#container').hide();
                    $('#mpeserta').html('');
                    $('#loading').show();
                },
                success: function(res){
                    $('#container').show();
                    if(res.status){
                        var url = '{{url('surat-tugas/cetak')}}' + '/' + res.data.st_id;
                        var urlnominatif = '{{url('nominatif/cetak')}}' + '/' + res.data.st_id;
                        $('#mno_st').text('').text(res.data.no_st);
                        $('#mcetak').attr('href', '').attr('href', url);
                        
                        if (res.data.jenis_kegiatan == 'dalam_kota_8jam') {
                            $('.cetak-8-jam').remove();
                            $('#mcetaknominatif').attr('href', '').addClass('disabled');
                            $('<a href="{{url('surat-tugas/cetak-spd-8jam')}}/' + res.data.st_id + '" target="_blank" class="btn btn-warning cetak-8-jam">Cetak SPD 8 Jam</a>').insertAfter('#mcetaknominatif');
                        }else{
                            $('#mcetaknominatif').attr('href', '').removeClass('disabled').attr('href', urlnominatif);
                            $('.cetak-8-jam').remove();
                        }

                        var jenis_kegiatan_label = '';
                        if (res.data.jenis_kegiatan == 'biasa') {
                            jenis_kegiatan_label = '<span class="label label-success"><i class="fa fa-train"></i> BIASA</span>';
                        }else if (res.data.jenis_kegiatan == 'dalam_kota_8jam') {
                            jenis_kegiatan_label = '<span class="label label-primary"><i class="fa fa-taxi"></i> DALAM KOTA 8 JAM</span>';
                        }else if (res.data.jenis_kegiatan == 'luar_negeri'){
                            jenis_kegiatan_label = '<span class="label label-danger"><i class="fa fa-plane"></i> LUAR NEGERI</span>';
                        }else if (res.data.jenis_kegiatan == 'konsinyering'){
                            jenis_kegiatan_label = '<span class="label label-warning"><i class="fa fa-bus"></i> KONSINYERING</span>';
                        }

                        $('#mjenis_kegiatan').html('').html(jenis_kegiatan_label);
                        $('#mnama_kegiatan').text('').text(res.data.nama_kegiatan);
                        $('#mid_kegiatan').text('').text(res.data.id_kegiatan);
                        $('#mtujuan_dinas').text('').text(res.data.tujuan_dinas);
                        $('#mtanggal_awal').text('').text(res.data.tanggal_awal);
                        $('#mtanggal_akhir').text('').text(res.data.tanggal_akhir);
                        $('#mtempat_dikeluarkan_surat').text('').text(res.data.tempat_dikeluarkan_surat);
                        $('#mtanggal_surat').text('').text(res.data.tanggal_surat);
                        $('#mnama_inspektur').text('').text(res.data.nama_inspektur);
                        $('#mnip_inspektur').text('').text(res.data.nip_inspektur);
                        $('#peserta').html('');
                        $.each( res.data.peserta, function( key, value ) {
                            var pender = '<tr><td>'+(key+1)+'</td><td><a href="{{url('pegawai/profile/')}}' + '/' + value.id + '">'+ value.nama +'<br><small>'+ ((value.nip != null) ? value.nip : '-') +' </small></a></td><td>';
                        if (res.data.jenis_kegiatan != 'dalam_kota_8jam') {
                            if (value.spd_id != null) {
                                pender += '<div class="btn-group">'
                                            +'<a class="btn btn-default btn-xs">Action</a>'
                                            +'<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                                                +'<span class="caret"></span>'
                                                +'<span class="sr-only">Toggle Dropdown</span>'
                                            +'</button>'
                                            +'<ul class="dropdown-menu">'
                                                +'<li class="dropdown-header">SPD</li>'
                                                +'<li class="disabled"><a href="#"><i class="fa fa-envelope"></i>&nbsp;Buat</a></li>'
                                                +'<li><a href="{{url('spd/edit')}}/' + value.spd_id + '"><i class="fa fa-pencil"></i>&nbsp;Edit</a></li>'
                                                +'<li><a href="{{url('spd/cetak')}}' + '/' + value.spd_id + '" target="_blank"><i class="fa fa-print"></i>&nbsp;Cetak</a></li>'
                                                +'<li class="dropdown-header">Rincian Biaya</li>';
                                
                                if(value.rincian_biaya == 0){
                                    pender +=   '<li><a href="{{url('rincian-biaya/create')}}' + '/' + value.spd_id + '"><i class="fa fa-calculator"></i>&nbsp;Buat/Edit</a></li>'
                                                +'<li class="disabled"><a href="#"><i class="fa fa-print"></i>&nbsp;Cetak</a></li>';
                                }else{
                                    pender +=   '<li><a href="{{url('rincian-biaya/create')}}' + '/' + value.spd_id + '"><i class="fa fa-calculator"></i>&nbsp;Buat/Edit</a></li>'
                                                +'<li><a href="{{url('rincian-biaya/cetak')}}' + '/' + value.spd_id + '" target="_blank"><i class="fa fa-print"></i>&nbsp;Cetak</a></li>'
                                                +'<li><a href="{{url('riil/cetak')}}' + '/' + value.spd_id + '" target="_blank"><i class="fa fa-print"></i>&nbsp;Cetak Riil</a></li>';
                                }

                                pender +=       '</ul>'
                                            +'</div>';
                            }else{
                                pender += '<div class="btn-group">'
                                            +'<a class="btn btn-default btn-xs">Action</a>'
                                            +'<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                                                +'<span class="caret"></span>'
                                                +'<span class="sr-only">Toggle Dropdown</span>'
                                            +'</button>'
                                            +'<ul class="dropdown-menu">'
                                                +'<li class="dropdown-header">SPD</li>'
                                                +'<li><a href="{{url('spd/create')}}' + '/' + res.data.hashid +'/' + value.hashid + '"><i class="fa fa-envelope"></i>&nbsp;Buat</a></li>'
                                                +'<li class="disabled"><a href="#"><i class="fa fa-print"></i>&nbsp;SPD</a></li>'
                                                +'<li class="dropdown-header">Rincian Biaya</li>'
                                                +'<li  class="disabled"><a href="#"><i class="fa fa-calculator"></i>&nbsp;Buat/Edit</a></li>'
                                                +'<li class="disabled"><a href="#"><i class="fa fa-print"></i>&nbsp;Cetak</a></li>'
                                            +'</ul>'
                                            +'</div>';
                            }
                        }
                            pender += '</td></tr>';

                            $('#mpeserta').append(pender);
                        });

                    }else{
                        notie.alert('error', 'Ups, ada yang error');
                        window.location.reload();
                    }

                    $('#loading').hide();
                },
                error: function(res){
                    $('.modal').hide();
                    console.log(res);
                    notie.alert('error', 'Ups, ada yang error');
                    window.location.reload();
                    $('#loading').hide();
                }
            });
        }

        function find8jam(id){
            $('.modal').modal();
            $.ajax({
                url: '{{url('surat-tugas')}}' + '/' + id,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function(){
                    $('#container').hide();
                    $('#mpeserta').html('');
                    $('#loading').show();
                },
                success: function(res){
                    $('#container').show();
                    if(res.status){
                        var url = '{{url('surat-tugas/cetak/')}}' + res.data.st_id;
                        var urlnominatif = '{{url('nominatif/cetak')}}' + '/' + res.data.st_id;
                        $('#mno_st').text('').text(res.data.no_st);
                        $('#mcetak').attr('href', '').attr('href', url);
                        $('#mcetaknominatif').attr('href', '').attr('href', urlnominatif);
                        $('#mnama_kegiatan').text('').text(res.data.nama_kegiatan);
                        $('#mid_kegiatan').text('').text(res.data.id_kegiatan);
                        $('#mtujuan_dinas').text('').text(res.data.tujuan_dinas);
                        $('#mtanggal_awal').text('').text(res.data.tanggal_awal);
                        $('#mtanggal_akhir').text('').text(res.data.tanggal_akhir);
                        $('#mtempat_dikeluarkan_surat').text('').text(res.data.tempat_dikeluarkan_surat);
                        $('#mtanggal_surat').text('').text(res.data.tanggal_surat);
                        $('#mnama_inspektur').text('').text(res.data.nama_inspektur);
                        $('#mnip_inspektur').text('').text(res.data.nip_inspektur);
                        $('#peserta').html('');
                        $.each( res.data.peserta, function( key, value ) {
                            var pender = '<tr><td>'+(key+1)+'</td><td><a href="{{url('pegawai/profile/')}}' + '/' + '/' + value.id + '">'+ value.nama +'<br><small>'+ ((value.nip != null) ? value.nip : '-') +' </small></a></td><td>';
                            if (value.spd_id != null) {
                                pender += '<div class="btn-group">'
                                            +'<a class="btn btn-default btn-xs">Action</a>'
                                            +'<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                                                +'<span class="caret"></span>'
                                                +'<span class="sr-only">Toggle Dropdown</span>'
                                            +'</button>'
                                            +'<ul class="dropdown-menu">'
                                                +'<li class="dropdown-header">SPD</li>'
                                                +'<li class="disabled"><a href="#"><i class="fa fa-envelope"></i>&nbsp;Buat</a></li>'
                                                +'<li><a href="{{url('spd/cetak/')}}' + '/' + value.spd_id + '" target="_blank"><i class="fa fa-print"></i>&nbsp;Cetak</a></li>'
                                                +'<li class="dropdown-header">Rincian Biaya</li>';
                                
                                if(value.rincian_biaya == 0){
                                    pender +=   '<li><a href="{{url('rincian-biaya/create')}}' + '/' + value.spd_id + '"><i class="fa fa-calculator"></i>&nbsp;Buat/Edit</a></li>'
                                                +'<li class="disabled"><a href="#"><i class="fa fa-print"></i>&nbsp;Cetak</a></li>';
                                }else{
                                    pender +=   '<li><a href="{{url('rincian-biaya/create')}}' + '/' + value.spd_id + '"><i class="fa fa-calculator"></i>&nbsp;Buat/Edit</a></li>'
                                                +'<li><a href="{{url('rincian-biaya/cetak')}}' + '/' + value.spd_id + '" target="_blank"><i class="fa fa-print"></i>&nbsp;Cetak</a></li>'
                                                +'<li><a href="{{url('riil/cetak')}}' + '/' + value.spd_id + '" target="_blank"><i class="fa fa-print"></i>&nbsp;Cetak Riil</a></li>';
                                }

                                pender +=       '</ul>'
                                            +'</div>';
                            }else{
                                pender += '<div class="btn-group">'
                                            +'<a class="btn btn-default btn-xs">Action</a>'
                                            +'<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                                                +'<span class="caret"></span>'
                                                +'<span class="sr-only">Toggle Dropdown</span>'
                                            +'</button>'
                                            +'<ul class="dropdown-menu">'
                                                +'<li class="dropdown-header">SPD</li>'
                                                +'<li><a href="{{url('spd/create')}}' + '/' + res.data.hashid +'/' + value.hashid + '"><i class="fa fa-envelope"></i>&nbsp;Buat</a></li>'
                                                +'<li class="disabled"><a href="#"><i class="fa fa-print"></i>&nbsp;SPD</a></li>'
                                                +'<li class="dropdown-header">Rincian Biaya</li>'
                                                +'<li  class="disabled"><a href="#"><i class="fa fa-calculator"></i>&nbsp;Buat/Edit</a></li>'
                                                +'<li class="disabled"><a href="#"><i class="fa fa-print"></i>&nbsp;Cetak</a></li>'
                                            +'</ul>'
                                            +'</div>';
                            }

                            pender += '</td></tr>';

                            $('#mpeserta').append(pender);
                        });

                    }else{
                        notie.alert('error', 'Ups, ada yang error');
                        window.location.reload();
                    }

                    $('#loading').hide();
                },
                error: function(res){
                    $('.modal').hide();
                    console.log(res);
                    notie.alert('error', 'Ups, ada yang error');
                    window.location.reload();
                    $('#loading').hide();
                }
            });
        }
    </script>
@endsection
