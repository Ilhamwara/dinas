@extends('layouts.master')

@section('css')
<link href="{{url('assets')}}/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
<link href="{{url('assets')}}/css/select2.min.css" rel="stylesheet" type="text/css"/>

@endsection

@section('head_title', 'Tambah Kegiatan')


@section('title')
Tambah Data Kegiatan Kolektif
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('kegiatan')}}">Data Kegiatan</a>
</li>
<li class="active">
    Tambah Data Kegiatan Kolektif
</li>
@endsection

@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Ada yang tidak beres</strong><br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="col-lg-12">
    <section class="box">
        <div class="content-body" id="kegiatan-body">
            <div class="row">
                <form class="form-horizontal" id="kegiatanForm">
                    <div class="col-md-12">                       
                        <div class="form-group row">
                            <label class="control-label col-md-3">Nama Kegiatan*</label>                            
                            <div class="col-md-7">
                                <input type="text" value="" class="form-control" name="nama_kegiatan" id="nama_kegiatan" data-validation="required" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Nama Penyelenggara</label>
                            <div class="col-md-7">
                                <input type="text" value="" class="form-control" name="nama_penyelenggara" id="nama_penyelenggara">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3" >Lokasi Kegiatan*</label>
                            <div class="col-md-7">
                                <select name="lokasi_kegiatan" class="form-control" id="lokasi_kegiatan" required="required">
                                    @forelse($tujuan as $k => $v)
                                    <option value="{{$v->id}}">{{$v->tujuan}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="masabakti" class="control-label col-md-3">Tanggal Pelaksanaan*</label>
                            <div class="col-md-7">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="form-control" name="sejak" id="sejak" required>
                                    <span class="input-group-addon">s/d</span>
                                    <input type="text" class="form-control" name="hingga" id="hingga" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="padding: 20px 0px;">

                        <div class="col-md-7 col-md-offset-3">
                            {{csrf_field()}}
                            <button type="button" class="btn" id="newST" disabled="disabled" style="visibility: hidden;"><i class="fa fa-refresh"></i> Buat Surat Tugas</button>                        
                            <button type="submit" class="btn btn-primary pull-right" id="saveKegiatan"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<div id="stFormContainer">
    <div class="col-lg-12">
        <section class="box">
            <div class="content-body" id="stBody">
                <div class="row">
                    <h3 class="page-header">Tambah Surat tugas untuk kegiatan ini</h3>
                    <form action="" class="form-horizontal" id="stForm">
                        <div class="col-md-12">                       
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">No Surat</label>                          
                                <div class="col-md-7">
                                    <input type="text" value="" class="form-control" name="no_surat" id="st_nomor_surat" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Tgl Surat</label>                            
                                <div class="col-md-7">
                                    <div class="input-group">
                                        <input type="text" value="" autocomplete="off" class="form-control" name="tgl_surat" id="st_tgl_surat" required>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Tempat Diterbitkan Surat</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="tempat_surat" value="Jakarta">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Penandatangan Surat</label>
                                <div class="col-md-7">
                                    <select class="form-control nip_inspektur" name="inspektur" id="st_inspektur" required>
                                        @forelse($pegawai as $k => $v)
                                        <option value="{{$v->pegawai_id}}">{{$v->nama . '(' . $v->nip . ')'}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Pegawai Peserta Perjalanan Dinas</label>
                                <div class="col-md-7">
                                    <select class="form-control nip_pegawai" multiple="multiple" name="pegawai[]" id="st_pegawai" required>
                                        @forelse($pegawai as $k => $v)
                                        <option value="{{$v->pegawai_id}}">{{$v->nama . ' (' . $v->nip . ')'}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <span class="help-block">Ketik nama atau NIP. Bila pegawai tidak ditemukan, <a href="{{url('pegawai/tambah')}}">Klik disini untuk menambahkan data pegawai baru</a></span>
                                </div>
                            </div>
                            <hr>
                            <h3>Pembebanan Anggaran</h3>

                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Kode Anak Satker</label>
                                <div class="col-md-7">
                                    <select class="form-control" name="st_kode_anak_satker" id="st_kode_anak_satker" required>
                                        <option>--Pilih Kode Anak Satker--</option>

                                        @forelse($anakSatker as $k => $v)
                                            <option value="{{$v->id}}">{{$v->kode}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Kode Kegiatan</label>
                                <div class="col-md-7">
                                    <select class="form-control" name="st_kode_kegiatan" id="st_kode_kegiatan" required disabled>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Kode Output</label>
                                <div class="col-md-7">
                                    <select class="form-control" name="st_kode_output" id="st_kode_output" required disabled>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Kode Akun</label>
                                <div class="col-md-7">
                                    <select class="form-control" name="st_kode_akun" id="st_kode_akun" required disabled>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">ID Pagu</label>
                                <div class="col-md-7">
                                    <select class="form-control" name="st_pagu" id="st_pagu" required disabled>

                                    </select>
                                    <br>
                                    <div class="well">
                                        <dl class="dl-horizontal">
                                            <dt>Uraian Akun</dt>
                                                <dd id="dl_uraian_akun"></dd>
                                            <dt>PPK</dt>
                                                <dd id="dl_ppk"></dd>
                                            <dt>Bendahara</dt>
                                                <dd id="dl_bendahara"></dd>
                                            <dt>Pagu</dt>
                                                <dd id="dl_pagu"></dd>
                                            <dt>Terealisasi</dt>
                                                <dd id="dl_terealisasi"></dd>
                                            <dt>Sisa</dt>
                                                <dd id="dl_sisa"></dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12" style="padding: 20px 0px;">
                            <div class="col-md-7 col-md-offset-3">
                                <input type="hidden" name="hidden_id_kegiatan" id="hidden_id_kegiatan" value="">
                                <input type="hidden" name="hidden_nama_kegiatan" id="hidden_nama_kegiatan" value="">
                                <input type="hidden" name="hidden_sejak" id="hidden_sejak" value="">
                                <input type="hidden" name="hidden_hingga" id="hidden_hingga" value="">
                                <input type="hidden" name="hidden_tujuan" id="hidden_tujuan" value="">
                                {{csrf_field()}}
                                {{-- <button type="reset" class="btn"><i class="fa fa-refresh"></i> Reset</button>                         --}}
                                <button type="submit" class="btn btn-primary" id="simpanSt"><i class="fa fa-save"></i> Simpan Surat Tugas</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="col-md-12" id="stContainer">
    <div class="box">
        <div class="content-body">
            <table class="table table-condensed table-hover table-striped">
                <thead>
                    <tr>
                        <th>No. Surat</th>
                        <th>Peserta</th>
                    </tr>
                </thead>
                <tbody id="suratTugasRow">
                    <tr  id="psST">
                        <td colspan="2">Belum ada surat tugas</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript" src="{{url('assets')}}/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="{{url('assets')}}/js/bootstrap-datepicker.id.min.js"></script>
<script type="text/javascript" src="{{url('assets')}}/js/select2.min.js"></script>
<script type="text/javascript" src="{{url('assets')}}/js/bootstrap-validator.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        $("#st_pegawai, #inspektur, #satuan_kerja, #lokasi_kegiatan, #st_inspektur").select2();
        $(":input").inputmask();

        $('#stFormContainer').hide();

        $('#kegiatanForm').validator().on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!
                e.isDefaultPrevented();
                var form = $('#kegiatanForm');
                $.ajax({
                    url : '{{url('kegiatan/tambahajax')}}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: form.serialize(),
                    beforeSend: function(){
                        $('#saveKegiatan').attr('disabled', true).html('Mengirim <i class="fa fa-spinner fa-spin"></i>');
                        $('#kegiatan-body').attr('style', 'background:#eee');
                        $('#nama_kegiatan, #nama_penyelenggara, #lokasi_kegiatan, #sejak, #hingga').attr('disabled', true).attr('readonly', true);

                    },
                    success: function(response){
                        if (response.status) {
                            $('#saveKegiatan').html('Tersimpan <i class="fa fa-check"></i>');
                            $('#kegiatan-body').attr('style', 'background:#fff');
                            $('#newST').attr('disabled', false);
                            $('#stFormContainer').show();
                            $('#hidden_id_kegiatan').val(response.data.kegiatan_id);
                            $('#hidden_nama_kegiatan').val(response.data.nama_kegiatan);
                            $('#hidden_sejak').val(response.data.tanggal_awal);
                            $('#hidden_hingga').val(response.data.tanggal_akhir);
                            $('#hidden_tujuan').val(response.data.lokasi_kegiatan);
                            notie.alert('success', 'Berhasil menyimpan kegiatan', 2);
                            $('#st_nomor_surat').focus();
                        }else{
                            notie.alert('error', 'Terjadi kesalahan saat mengirim data', 1);
                            window.location.reload();
                        }
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            }

            return false;
        });


        var d = new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var year = d.getFullYear();
        $('.input-daterange, #st_tgl_surat').datepicker({
            format : 'dd MM yyyy',
            clearBtn: true,
            language: 'id',
            autoclose: true,
            todayHighlight: true
        });

        $('#tahun_anggaran').datepicker({
            format : 'yyyy',
            viewMode: "years", 
            minViewMode: "years",
            clearBtn: true,
            language: 'id',
            autoclose: true,
            todayHighlight: true
        });


        $('#stForm').validator().on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!
                e.isDefaultPrevented();
                var form = $('#stForm');
                $.ajax({
                    url : '{{url('surat-tugas/tambahajax')}}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: form.serialize(),
                    beforeSend: function(){
                        $('#simpanSt').attr('disabled', true).html('Mengirim <i class="fa fa-spinner fa-spin"></i>');
                        $('#stBody').attr('style', 'background:#eee');
                        $('#st_pegawai, #st_inspektur, #st_nomor_surat, #st_tgl_surat').attr('disabled', true).attr('readonly', true);

                    },
                    success: function(response){
                        if (response.status) {
                            $('#simpanSt').attr('disabled', false).html('Mengirim <i class="fa fa-spinner fa-spin"></i>').delay(800).html('<i class="fa fa-save"></i> Simpan Surat Tugas');
                            $('#stBody').attr('style', 'background:#fff');
                            $('#st_pegawai, #st_inspektur, #st_nomor_surat, #st_tgl_surat').attr('disabled', false).attr('readonly', false).val('');
                            getSt(response.data);
                        }
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            }
            return false;
        });
    });

    function getSt(id){
        $.ajax({
            url: '{{url('surat-tugas')}}/' + id,
            type: 'GET',
            dataType: 'JSON',
            beforeSend: function(){

            },
            success: function(res){
                if(res.status){

                    if ($('#psST').length > 0) {
                        $('#psST').remove();
                    }

                    $('#suratTugasRow').append('<tr id="r'+res.data.st_id+'"><td><strong>' + res.data.no_st + '</strong><br>Tanggal: '+res.data.tanggal_surat+'<br>Dikeluarkan di: ' + res.data.tempat_dikeluarkan_surat + '<br>Penandatangan: '+res.data.nama_inspektur+'</td><td id="kolom_peserta_' + res.data.st_id + '"></td></tr>');
                    
                    if($.isArray(res.data.peserta)){
                        $.each( res.data.peserta, function( k, v ) {
                            $('#kolom_peserta_' + res.data.st_id).append('- '+ v.nama +' ('+v.nip+')<br>');
                        });
                    }

                    $("#st_pegawai, #st_inspektur").select2('val', 'All');

                    notie.alert('success', 'Berhasil menyimpan surat tugas', 1);
                    $('#r' + res.data.st_id).focus().addClass('animated bounce');
                }else{
                    notie.alert('error', 'Ups, ada yang error', 1);
                    // window.location.reload();
                }

            },
            error: function(res){
                notie.alert('error', 'Ups, ada yang error');
                $('.modal').hide();
                console.log(res);
            }
        });
    }

    $(document).ready(function () {
        //Initialize tooltips
        $('.nav-tabs > li a[title]').tooltip();
        
        //Wizard
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

            var $target = $(e.target);

            if ($target.parent().hasClass('disabled')) {
                return false;
            }
        });

        $(".next-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);

        });
        $(".prev-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            prevTab($active);

        });
    });

    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }

    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }


    function nest(distinct = '', tahun  = '{{session('tahun')}}', anak_satker_id = '', kegiatan = '', output = '', akun = '') {

        return $.ajax({
            url: '{{url('pagu/nested?distinct=')}}' + distinct + '&tahun=' + tahun + '&anak_satker_id=' + anak_satker_id + '&kegiatan=' + kegiatan + '&output=' + output + '&akun=' + akun,
            type: 'GET',
            dataTipe: 'JSON',
            beforeSend: function(){

            },
            success: function(res){
                console.log(res);
            },
            error: function(res){    
                console.log(res);
            }
        });
    }


    $(document).on('change', '#st_kode_anak_satker', function(){
         $('#st_kode_kegiatan, #st_kode_output, #st_kode_akun, #st_pagu').html('').prop('disabled', true);
         $("[id^=dl_]").html('');

        var anak_satker_id = $(this).val();
        var as = nest('kegiatan',{{session('tahun')}},anak_satker_id);
        as.success(function(data){
            
            if ($.isArray(data.data) && data.data.length > 0) {
                
                $('#st_kode_kegiatan').html('<option>--Pilih Kode Kegiatan--</option>');

                $.each(data.data, function(k, v) {
                    $('#st_kode_kegiatan').append('<option value="' + v.kegiatan + '">' + v.kegiatan + '</option>');
                });
                
                $('#st_kode_kegiatan').prop('disabled', false);
            
            }else{
                notie.alert('warning', 'Belum ada kegiatan pada kode anak satker di atas', 2);
            }
        })
        
    });

    $(document).on('change', '#st_kode_kegiatan', function(){
         $('#st_kode_output, #st_kode_akun, #st_pagu').html('').prop('disabled', true);
         $("[id^=dl_]").html('');

        var kegiatan = $(this).val();
        var anak_satker_id = $('#st_kode_anak_satker').val();
        var keg = nest('output',{{session('tahun')}},anak_satker_id, kegiatan);
        
        keg.success(function(data){
            
            if ($.isArray(data.data) && data.data.length > 0) {
                
                $('#st_kode_output').html('<option>--Pilih Kode Output--</option>');

                $.each(data.data, function(k, v) {
                    $('#st_kode_output').append('<option value="' + v.output + '">' + v.output + '</option>');
                });
                
                $('#st_kode_output').prop('disabled', false);
            
            }else{
                notie.alert('warning', 'Belum ada Output', 2);
            }
        })
        
    });

    $(document).on('change', '#st_kode_output', function(){
         $('#st_kode_akun, #st_pagu').html('').prop('disabled', true);
         $("[id^=dl_]").html('');

        var output = $(this).val();
        var anak_satker_id = $('#st_kode_anak_satker').val();
        var kegiatan = $('#st_kode_kegiatan').val();
        var out = nest('akun',{{session('tahun')}},anak_satker_id, kegiatan, output);
        
        out.success(function(data){
            
            if ($.isArray(data.data) && data.data.length > 0) {
                
                $('#st_kode_akun').html('<option>--Pilih Kode Akun--</option>');

                $.each(data.data, function(k, v) {
                    $('#st_kode_akun').append('<option value="' + v.akun + '">' + v.akun + '</option>');
                });
                
                $('#st_kode_akun').prop('disabled', false);
            
            }else{
                notie.alert('warning', 'Belum ada Akun', 2);
            }
        })
        
    });

    $(document).on('change', '#st_kode_akun', function(){
         $('#st_pagu').html('').prop('disabled', true);
         $("[id^=dl_]").html('');

        var akun = $(this).val();
        var anak_satker_id = $('#st_kode_anak_satker').val();
        var kegiatan = $('#st_kode_kegiatan').val();
        var output = $('#st_kode_output').val();
        var ak = nest('id',{{session('tahun')}}, anak_satker_id, kegiatan, output, akun);
        
        ak.success(function(data){
            
            if ($.isArray(data.data) && data.data.length > 0) {
                
                $('#st_pagu').html('<option>--Pilih Pagu--</option>');

                $.each(data.data, function(k, v) {
                    $('#st_pagu').append('<option value="' + v.id + '">' + v.id + '</option>');
                });
                
                $('#st_pagu').prop('disabled', false);
            
            }else{
                notie.alert('warning', 'Belum ada Pagu', 2);
            }

            // if ($.isArray(data.data) && data.data.length > 0) {
            //     $('#dl_bendahara').html(data.data[0].nm_bendahara + ' (' + data.data[0].nip_bendahara + ')');
            //     $('#dl_ppk').html(data.data[0].nm_ppk + ' (' + data.data[0].nip_ppk + ')');
            //     $('#dl_uraian_akun').html(data.data[0].uraian_akun);
            //     $('#dl_pagu').html(data.data[0].jumlah_pagu);
            //     $('#dl_terealisasi').html(data.data[0].terealisasi__pagu);
            //     $('#dl_sisa').html(data.data[0].sisa_pagu);

            
            // }else{
            //     notie.alert('danger', 'Pagu Tidak ditemukan', 2);
            // }
        });
    });

     $(document).on('change', '#st_pagu', function(){
         $("[id^=dl_]").html('');

        var pagu = $(this).val();
        var anak_satker_id = $('#st_kode_anak_satker').val();
        var kegiatan = $('#st_kode_kegiatan').val();
        var output = $('#st_kode_output').val();
        var akun = $('#st_kode_akun').val();
        var pag = nest('id',{{session('tahun')}},anak_satker_id, kegiatan, output, akun, pagu);
        
        pag.success(function(data){
            if ($.isArray(data.data) && data.data.length > 0) {
                $('#dl_bendahara').html(data.data[0].nm_bendahara + ' (' + data.data[0].nip_bendahara + ')');
                $('#dl_ppk').html(data.data[0].nm_ppk + ' (' + data.data[0].nip_ppk + ')');
                $('#dl_uraian_akun').html(data.data[0].uraian_akun);
                $('#dl_pagu').html(data.data[0].jumlah_pagu);
                $('#dl_terealisasi').html(data.data[0].terealisasi__pagu);
                $('#dl_sisa').html(data.data[0].sisa_pagu);

            
            }else{
                notie.alert('danger', 'Pagu Tidak ditemukan', 2);
            }
        });
    });
</script>
@endsection