@extends('layouts.master')

@section('css')
{{-- <link href="{{url('assets')}}/css/button-datatables.css" rel="stylesheet" type="text/css"/> --}}
<link href="{{url('assets')}}/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
    .dropdown-menu>li>form>button {
        display: block;
        padding: 3px 20px;
        clear: both;
        font-weight: 400;
        line-height: 1.42857143;
        color: #333;
        white-space: nowrap;
        background: transparent;
        border: 0px;
    }
    .dropdown-menu>li>form>button:hover{
        color: red;
    }

    .shtct {
        width: 100%;
        margin-bottom: 20px;
    }

    #dataTableBuilder_length {
        position: absolute;
    }
</style>
@endsection

@section('head_title', 'Perjalanan Dinas')


@section('title')
Data Perjalanan Dinas
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    Data Perjalanan Dinas
</li>
@endsection

@section('content')

<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="menuModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="menuModal">Pilih Jenis Perjalanan Dinas</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <a href="{{url('kegiatan/tambah')}}" class="btn btn-sm shtct btn-success">
                    <i class="fa fa-train fa-2x"></i><br>Perjalanan Dinas Biasa
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{url('konsinyering/tambah')}}" class="btn btn-sm shtct btn-warning">
                    <i class="fa fa-bus fa-2x"></i><br>Konsinyering Dalam & Luar Kota
                </a>
            </div>
            <hr>
            <div class="col-md-6">
                <a href="{{url('kegiatan-dinas-dalam-kota-8-jam/tambah')}}" class="btn btn-sm shtct btn-primary">
                    <i class="fa fa-taxi fa-2x"></i><br>Perjalanan Dinas Dalam Kota s/d 8 Jam
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{url('kegiatan-luar-negeri/tambah')}}" class="btn btn-sm shtct btn-danger">
                    <i class="fa fa-plane fa-2x"></i><br>Perjalanan Dinas Luar Negeri
                </a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade " id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail Perjalanan Dinas</h4>
            </div>
            <div class="modal-body">
                <div id="loading" style="text-align: center">
                    <i class="fa fa-spinner fa-spin fa-3x"></i>
                    <br>
                    Loading
                </div>
                <div id="container">
                    <dl class="dl-horizontal">
                        <dt>ID</dt>
                            <dd id="mid_kegiatan"></dd>
                        <dt>Nama</dt>
                            <dd id="mnama_kegiatan"></dd>
                        <dt>Jenis</dt>
                            <dd id="mjenis_kegiatan"></dd>
                        <dt>Penyelenggara</dt>
                            <dd id="mnama_penyelenggara"></dd>
                        <dt>Lokasi</dt>
                            <dd id="mlokasi_kegiatan"></dd>
                        <dt>Sejak</dt>
                            <dd id="mtanggal_awal"></dd>
                        <dt>Hingga</dt>
                            <dd id="mtanggal_akhir"></dd>
                    </dl>
                    <hr>
                    <h4>Surat Tugas</h4>
                    <table id="" class="table table-hover table-condensed table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Surat</th>
                                <th>Peserta</th>
                            </tr>
                        </thead>
                        <tbody id="msurat_tugas"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{-- <a href="" class="btn btn-primary" target="_blank" id="mcetak">Cetak <i class="fa fa-print"></i></a> --}}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@if(request('message'))
    <p class="alert {{ request('alert-class') }}">{{ request('message') }}</p>
@endif

@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div class="col-lg-12">
    <section class="box">
        <div class="content-body">
            {{-- <div class="btn-group  pull-right"> --}}
                <a href="#" class="btn btn-success pull-right" onclick="showModal()">Tambah Perjalanan Dinas</a>
                {{-- <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button> --}}
                {{-- <ul class="dropdown-menu">
                    <li>
                        <a href="{{url('kegiatan/tambah')}}">Kegiatan Biasa</a>
                    </li>
                    <li>
                        <a href="{{url('konsinyering/tambah')}}" class="">Konsinyering Dalam Kota & Luar Kota</a>
                    </li>
                    <li>
                        <a href="{{url('kegiatan-dinas-dalam-kota-8-jam/tambah')}}" class="">Kegiatan Dinas Dalam Kota 8 Jam</a>
                    </li>
                    <li>
                        <a href="{{url('kegiatan-luar-negeri/tambah')}}" class="">Kegiatan Luar Negeri</a>
                    </li>
                </ul> --}}
            {{-- </div> --}}
            {{-- <a href="{{url('kegiatan/tambah')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Kegiatan</a> --}}
            <br>
            <br>
            <br>
            {!! $dataTable->table() !!}
        </div>
    </section>
</div>
@endsection


@section('js')
<script src="{{url('assets')}}/js/jquery-datatables.js" type="text/javascript"></script> 
{{-- <script src="{{url('assets')}}/js/button-datatables.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/js/zip-datatables.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/js/pdf-datatables.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/js/fvs-datatables.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/js/button-flash.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/js/print-datatables.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/js/button-html5-datatables.js" type="text/javascript"></script>  --}}
{{-- <script src="{{url('assets')}}/js/datatables.js" type="text/javascript"></script> --}}


{{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css"> --}}
{{-- <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script> --}}
{{-- <script src="/vendor/datatables/buttons.server-side.js"></script> --}}
 {{-- {!! $dataTable->scripts() !!} --}}
{{-- <script type="text/javascript">
 (function (window, $) {
    window.LaravelDataTables = window.LaravelDataTables || {};
    window.LaravelDataTables["dataTableBuilder"] = $("#dataTableBuilder").DataTable({
        "serverSide": true,
        "processing": true,
        "ajax": "",
        "columns": [{
            "name": "kegiatan_id",
            "data": "kegiatan_id",
            "title": "Kegiatan Id",
            "orderable": true,
            "searchable": true
        }, {
            "name": "nama_kegiatan",
            "data": "nama_kegiatan",
            "title": "Nama Kegiatan",
            "orderable": true,
            "searchable": true
        }, {
            "name": "jenis_kegiatan",
            "data": "jenis_kegiatan",
            "title": "Jenis Kegiatan",
            "orderable": true,
            "searchable": true
        }, {
            "name": "nama_penyelenggara",
            "data": "nama_penyelenggara",
            "title": "Penyelenggara",
            "orderable": true,
            "searchable": true
        },{
            "name": "lokasi_kegiatan",
            "data": "lokasi_kegiatan",
            "title": "Lokasi Kegiatan",
            "orderable": true,
            "searchable": true
        }, {
            "name": "Surat Tugas",
            "data": "Surat Tugas",
            "title": "Surat Tugas",
            "orderable": false,
            "searchable": false
        }, {
            "defaultContent": "",
            "data": "action",
            "name": "action",
            "title": "Action",
            "render": null,
            "orderable": false,
            "searchable": false,
            "width": "80px"
        }],
        "order": [
            [0, "desc"]
        ]
    });
})(window, jQuery);
</script> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
    <script type="text/javascript">
        function detail(id){
            $('#myModal').modal();
            $.ajax({
                url: '{{url('kegiatan/detail')}}/' + id,
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
                        $('#mid_kegiatan').text('').text(res.data.kegiatan.id);
                        $('#mnama_kegiatan').text('').text(res.data.kegiatan.nama_kegiatan);
                        
                        var jenis_kegiatan_label = '';
                        if (res.data.kegiatan.jenis_kegiatan == 'biasa') {
                            jenis_kegiatan_label = '<span class="label label-success"><i class="fa fa-train"></i> BIASA</span>';
                        }else if (res.data.kegiatan.jenis_kegiatan == 'dalam_kota_8jam') {
                            jenis_kegiatan_label = '<span class="label label-primary"><i class="fa fa-taxi"></i> DALAM KOTA 8 JAM</span>';
                        }else if (res.data.kegiatan.jenis_kegiatan == 'luar_negeri'){
                            jenis_kegiatan_label = '<span class="label label-danger"><i class="fa fa-plane"></i> LUAR NEGERI</span>';
                        }else if (res.data.kegiatan.jenis_kegiatan == 'konsinyering'){
                            jenis_kegiatan_label = '<span class="label label-warning"><i class="fa fa-bus"></i> KONSINYERING</span>';
                        }

                        $('#mjenis_kegiatan').html('').html(jenis_kegiatan_label);
                        $('#mnama_penyelenggara').text('').text(res.data.kegiatan.nama_penyelenggara);
                        $('#mlokasi_kegiatan').text('').text(res.data.kegiatan.lokasi_kegiatan);
                        $('#mtanggal_awal').text('').text(res.data.kegiatan.sejak);
                        $('#mtanggal_akhir').text('').text(res.data.kegiatan.hingga);
                       
                        $('#msurat_tugas').html('');
                        if($.isArray(res.data.kegiatan.surat_tugas)){
                            $.each( res.data.kegiatan.surat_tugas, function( key, value ) {
                                $('#msurat_tugas').append('<tr><td>'+(key+1)+'</td><td><strong>' + value.no_st + '</strong><br>Tanggal: '+value.tanggal_surat+'<br>Dikeluarkan di: ' + value.tempat_dikeluarkan_surat + '<br>Penandatangan: '+value.nama_inspektur+'</td><td id="kolom_peserta_' + (key+1) + '"></td></tr>');
                                
                                if($.isArray(res.data.kegiatan.surat_tugas[key].peserta)){
                                    $.each( res.data.kegiatan.surat_tugas[key].peserta, function( k, v ) {
                                        $('#kolom_peserta_' + (key+1)).append('- '+ v.nama +' ('+v.nip+')<br>');
                                        
                                    });
                                }
                            });
                        }else{
                            $('#msurat_tugas').append('<tr><td colspan="3">Belum ada surat tugas untuk kegiatan ini</td></tr>');
                        }

                    }else{
                        notie.alert('error', 'Ups, ada yang error');
                        // window.location.reload();
                    }

                    $('#loading').hide();
                },
                error: function(res){
                    $('.modal').hide();
                    console.log(res);
                    notie.alert('error', 'Ups, ada yang error');
                    // window.location.reload();
                    $('#loading').hide();
                }
            });
        }

        function showModal() {
            $('#menuModal').modal();
        }
    </script>
@endsection