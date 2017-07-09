@extends('layouts.master')

@section('css')
<link href="{{url('assets')}}/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
<link href="{{url('assets')}}/css/select2.min.css" rel="stylesheet" type="text/css"/>

@endsection

@section('head_title', 'Tambah Perjalanan Dinas')


@section('title')
Tambah Data Perjalanan Dinas
@endsection

@section('breadcrumb')

<div class="modal fade bs-example-modal-sm" tabindex="-1" id="modalPegawai" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post" id="formPegawai">
                            <div class="form-group">
                                <label class="form-label">Unit</label>
                                <div class="controls">
                                    <select name="unit_kerja" id="unit_kerja" class="form-control" required>
                                        @forelse($satker as $k => $v)
                                            <option value="{{$v->unit_kerja}}">{{$v->unit_kerja}}</option>
                                        @empty
                                        @endforelse
                                        <option value="Unit Kerja Lain">Unit Kerja Lain</option>
                                    </select>
                                </div>
                            </div>                       
                            
                            <div class="form-group">
                                <label class="form-label" >Nama Pegawai</label>
                                <div class="controls">
                                    <input type="text" value="" class="form-control" name="nama" id="namPeg" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" >Status Pegawai</label>
                                <div class="controls">
                                    <label class="radio-inline"><input type="radio" name="pns" value="NON PNS" checked required> NON-PNS</label>
                                    <label class="radio-inline"><input type="radio" name="pns" value="PNS" required> PNS</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" >NIP</label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input type="text" value="" class="form-control" name="nip" id="nip" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" >Golongan</label>
                                <div class="controls">
                                    <label class="radio-inline"><input type="radio" name="golongan" value="I" disabled> I</label>
                                    <label class="radio-inline"><input type="radio" name="golongan" value="II" disabled> II</label>
                                    <label class="radio-inline"><input type="radio" name="golongan" value="III" disabled> III</label>
                                    <label class="radio-inline"><input type="radio" name="golongan" value="IV" disabled> IV</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Pangkat</label>
                                <div class="controls">
                                    <div class="controls" id="pangkatController">
                                        <label class="radio-inline"><input type="radio" name="pangkat" class="pangkat" value="A" disabled> A</label>
                                        <label class="radio-inline"><input type="radio" name="pangkat" class="pangkat" value="B" disabled> B</label>
                                        <label class="radio-inline"><input type="radio" name="pangkat" class="pangkat" value="C" disabled> C</label>
                                        <label class="radio-inline"><input type="radio" name="pangkat" class="pangkat" value="D" disabled> D</label>
                                        <label class="radio-inline"><input type="radio" name="pangkat" class="pangkat" value="E" disabled> E</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Eselon</label>
                                <div class="controls" id="eselonController">
                                    <label class="radio-inline"><input type="radio" name="eselon" class="eselon" value="0" disabled> Non Eselon</label>
                                    <label class="radio-inline"><input type="radio" name="eselon" class="eselon" value="1" disabled> Eselon I</label>
                                    <label class="radio-inline"><input type="radio" name="eselon" class="eselon" value="2" disabled> Eselon II</label>
                                    <label class="radio-inline"><input type="radio" name="eselon" class="eselon" value="3" disabled> Eselon III</label>
                                    <label class="radio-inline"><input type="radio" name="eselon" class="eselon" value="4" disabled> Eselon IV</label>
                                    {{-- <input type="text" name="eselon" class="form-control" value="Non Eselon" id="eselon" readonly> --}}
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Tingkat Perjalanan Dinas</label>
                                <div class="controls" id="tingkatController">
                                    <label class="radio-inline"><input type="radio" name="tingkat" value="A" required> A</label>
                                    <label class="radio-inline"><input type="radio" name="tingkat" value="B" required> B</label>
                                    <label class="radio-inline"><input type="radio" name="tingkat" value="C" required> C</label>
                                    {{-- <input type="text" name="tingkat" class="form-control" value="" id="tingkat" readonly> --}}
                                </div>
                            </div>
           
                            <div class="form-group">
                                <label class="form-label">Jabatan</label>
                                <div class="controls">
                                    <input type="text" value="" class="form-control" name="nama_jabatan" id="nama_jabatan">
                                </div>
                            </div>
                            <div class="text-left">
                                {{csrf_field()}}
                                <button type="reset" class="btn"><i class="fa fa-refresh"></i> Reset</button>                        
                                <button type="submit" class="btn btn-success pull-right" id="simPeg"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </form>  
                    </div>
                </div>     
            </div>
        </div>
    </div>
</div>

<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('kegiatan')}}">Data Perjalanan Dinas</a>
</li>
<li class="active">
    Tambah Data Perjalanan Dinas
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
                            <label class="control-label col-md-3">Nama Perjalanan Dinas*</label>                            
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
                            <label class="control-label col-md-3" >Lokasi Perjalanan Dinas*</label>
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
                    <h3 class="page-header">Tambah Surat tugas untuk perjalanan dinas ini</h3>
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
                                    <span class="help-block">Ketik nama atau NIP. Bila pegawai tidak ditemukan, <a href="javascript:void(0)" id="tambahPegawai">Klik disini untuk menambahkan data pegawai baru</a></span>
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
        $(document).on('click', '#tambahPegawai', function(){

            $('#unit_kerja, #namPeg, #nip').prop('readonly', false).val('');
            document.getElementById("formPegawai").reset();
            $('#modalPegawai').modal('show');
        });

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
<script type="text/javascript">
    $('#formPegawai').validator().on('submit', function(e) {
        if (e.isDefaultPrevented()) {
            alert('belum valid');
        } else {
            e.preventDefault();
            var dt = $('#formPegawai').serialize();
            $.ajax({
                url: '{{url('pegawai/simpanAjax')}}',
                type: 'POST',
                data: dt,
                dataType: 'JSON',
                beforeSend: function() {
                    $('#unit_kerja, #namPeg, #nip').prop('readonly', true);
                    $('#simPeg').prop('disabled', true).html('<i class="fa fa-spin fa-spinner"></i> Mengirim');
                },
                success: function(resp) {
                    if (resp.status) {
                        $('#st_pegawai').append('<option value="' + resp.data.pegawai_id + '">' + resp.data.nama + '</option>');
                        $("#st_pegawai, #inspektur, #satuan_kerja, #lokasi_kegiatan, #st_inspektur").select2();
                        $('#modalPegawai').modal('hide');
                        notie.alert('success', '✔ Berhasil menyimpan pegawai baru', 2);
                        $('#simPeg').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    }else{
                        notie.alert('error', 'Ups terjadi kesalahan saat menyimpan', 2);
                        $('#simPeg').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    }
                },
                error: function(resp){
                    notie.alert('error', 'Ups terjadi kesalahan saat menyimpan', 2);
                    $('#simPeg').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                }
            });
        }
    });
    var pns = false;
    var unitKerja = $('#unit_kerja').val();
    $(":input").inputmask();

    $(document).on('change', '#unit_kerja', function(){
        unitKerja = $(this).val();
        if (unitKerja == 'Unit Kerja Lain') {
            $(':input','#formPegawai')
                .removeAttr('checked');

            // changePangkat('eksternal');
            // changeEselon('manual');
            changeTingkat('eksternal');
    
            $('#tingkat').prop('disabled', false).prop('required', true);
            $('#nama_jabatan').prop('disabled', false).prop('required', false);
            //ekstern();

            $('<div class="form-group" id="nama_unit_kerja">'+
                    '<label class="form-label">Nama Unit Kerja</label>'+
                    '<div class="controls">'+
                        '<input type="text" value="" class="form-control" name="nama_unit_kerja" required>'+
                    '</div>'+
                '</div>').insertAfter($(this)).addClass('animated flash');
        }else{
            if ($('#nama_unit_kerja').length > 0) {
                $('#nama_unit_kerja').addClass('animated fadeOutUp').remove();
            }

            intern();
        
        }
    });


    //Pangkat
    $(document).on( 'change', '.pangkat' , function() {
        $('.eselon').prop('disabled', false);

    });

    //Eselon
    $(document).on( 'change', '.eselon' , function() {
        // changeEselon('predefined');
        changeTingkat();
    });

    intern();
    function ekstern() {
         //PNS
        $('input[type=radio][name=pns]').change(function() {
            if (this.value == 'PNS') {
                isPns(true);
                //loadPangkatGol();
                changeEselon();

            }
            else if (this.value == 'NON PNS') {
                pns = false;
                isPns(false);
                changeTingkat('eksternal');
                changeEselon('disabled');

            }
        });
        changeTingkat('eksternal');
    }

    function intern() {
        //Eselon
        // changeEselon('predefined');

        //PNS
        $('input[type=radio][name=pns]').change(function() {
            if (this.value == 'PNS') {
                isPns(true);
                //loadPangkatGol();
                changeEselon();
            }
            else if (this.value == 'NON PNS') {
                pns = false;
                isPns(false);
                changeTingkat('eksternal');
                changeEselon('disabled');
            }
        });

        //Golongan
        $('input[type=radio][name=golongan]').change(function() {

            pns = true;
            
            if ($('#unit_kerja').val() != 'Unit Kerja Lain') {
                // changePangkat('internal', $(this).val());
                $('input[type=radio][name=pangkat]').removeAttr('disabled');
            }else{
                // changePangkat('eksternal');
                $('input[type=radio][name=pangkat]').removeAttr('disabled');
            }

        });

        //Pangkat
        $(document).on( 'change', '.pangkat' , function() {

            $('.eselon').prop('disabled', false);
            // // changeEselon('predefined');

            // if ($(this).attr('data-eselon') == 1) {
                
            //     $('#eselon').val('Eselon I');
            // }else if($(this).attr('data-eselon') == 2) {
            //     $('#eselon').val('Eselon II');
            
            // }else {
            //     $('#eselon').val('Non Eselon');
            // }

            // $('#tingkat').val($(this).attr('data-tingkat'));
        });

    }


    function isPns(argument) {

        if (argument) {
            pns = true;
            $('input[type=radio][name=golongan]').removeAttr('disabled').removeAttr('checked').attr('required', true);
            $('#nip').prop('required', true).prop('disabled', false);
            // changePangkat('eksternal');
        }else{
            $('input[type=radio][name=golongan], input[type=radio][name=pangkat]').attr('disabled', true).removeAttr('checked').removeAttr('required');
            $('#nip').prop('required', false).prop('disabled', true);
            // changePangkat('eksternal');
        }
    }


    function changePangkat(to, param = null) {

        if (to == 'eksternal') {
        
            var pangkatCOntroller = '<label class="radio-inline"><input type="radio" name="pangkat" value="A" disabled> A</label> ' 
                                    + '<label class="radio-inline"><input type="radio" name="pangkat" value="B" disabled> B</label> '
                                    + '<label class="radio-inline"><input type="radio" name="pangkat" value="C" disabled> C</label> '
                                    + '<label class="radio-inline"><input type="radio" name="pangkat" value="D" disabled> D</label> '
                                    + '<label class="radio-inline"><input type="radio" name="pangkat" value="E" disabled> E</label>';
        
            $('#pangkatController').html(pangkatCOntroller);
        
            // $('input[type=radio][name=pangkat]').removeAttr('disabled');
        
        } else {
        
            var a = loadPangkatGol(param);
        
            a.success(function(data){
        
                $('#pangkatController').html('');                    
                
                if ($.isArray(data.data)) {
                
                    $.each(data.data, function(k,v){
                
                        console.log(v);
                
                        var pender = '<label class="radio-inline"><input type="radio" class="pangkat" name="pangkat" data-id="'+v.id+'" data-golongan="'+v.golongan+'" data-pangkat="'+v.pangkat+'" data-nama_pangkat="'+v.nama_pangkat+'" data-eselon="'+v.eselon+'" data-tingkat="'+v.tingkat+'" value="'+v.pangkat+'" required> ' + '(' + v.pangkat + ') ' + v.nama_pangkat + ' Eselon-' + v.eselon +'</label><br>';
                        $('#pangkatController').append(pender);
                    });
                }
            });
        }
    }


    function changeEselon(to) {

        if (to == 'predefined') {
            var eselonHtml = '<input type="text" name="eselon" class="form-control" value="Non Eselon" id="eselon" readonly>';
            $('#eselonController').html(eselonHtml);
        }else if(to == 'disabled') {
            var eselonHtml = '<label class="radio-inline"><input type="radio" name="eselon" value="0" class="eselon" disabled> Non Eselon</label> '
                           + '<label class="radio-inline"><input type="radio" name="eselon" value="1" class="eselon" disabled> Eselon I</label> '
                           + '<label class="radio-inline"><input type="radio" name="eselon" value="2" class="eselon" disabled> Eselon II</label> '
                           + '<label class="radio-inline"><input type="radio" name="eselon" value="3" class="eselon" disabled> Eselon III</label> '
                           + '<label class="radio-inline"><input type="radio" name="eselon" value="4" class="eselon" disabled> Eselon IV</label> ';
            $('#eselonController').html(eselonHtml);

        }else{
            var eselonHtml = '<label class="radio-inline"><input type="radio" name="eselon" value="0" class="eselon" required> Non Eselon</label> '
                           + '<label class="radio-inline"><input type="radio" name="eselon" value="1" class="eselon" required> Eselon I</label> '
                           + '<label class="radio-inline"><input type="radio" name="eselon" value="2" class="eselon" required> Eselon II</label> '
                           + '<label class="radio-inline"><input type="radio" name="eselon" value="3" class="eselon" required> Eselon III</label> '
                           + '<label class="radio-inline"><input type="radio" name="eselon" value="4" class="eselon" required> Eselon IV</label> ';
            $('#eselonController').html(eselonHtml);
        }
    }

    function changeTingkat(argument) {

        if (argument == 'eksternal') {
            var tingkatController = '<label class="radio-inline"><input type="radio" name="tingkat" value="A" required> A</label> '
                                  + '<label class="radio-inline"><input type="radio" name="tingkat" value="B" required> B</label> '
                                  + '<label class="radio-inline"><input type="radio" name="tingkat" value="C" required> C</label> ';
            
            $('#tingkatController').html(tingkatController);

            $('#tingkat').prop('disabled', false).prop('readonly', false).prop('required', true);
        
        }else{
            var s = loadPangkatGol($('input:radio[name=golongan]:checked').val(), $('input:radio[name=pangkat]:checked').val(), $('input:radio[name=eselon]:checked').val());
            s.success(function(data){
        
                $('#tingkatController').html('');                    
                
                if ($.isArray(data.data)) {
                    
                    var checked = '';
                    
                    if (data.data.length < 1) {
                        notie.alert('warning', 'Tidak ada PNS dengan golongan/pangkat: ' + $('input:radio[name=golongan]:checked').val() + '/' + $('input:radio[name=pangkat]:checked').val() + ' yang ber-eselon: ' + $('input:radio[name=eselon]:checked').val(), 3);
                    
                    } else {
                        checked = 'checked';

                        var pender = '';
                        $.each(data.data, function(k,v){
                            pender += '<label class="radio-inline"><input type="radio" name="tingkat" value="'+v.tingkat+'" '+checked+' required> '+v.tingkat+'</label>';
                        });

                        $('#tingkatController').html(pender);
                    }

                }
            });
        }
    }

    function loadPangkatGol(golongan = '', pangkat = '', eselon = '', tingkat = '') {

        return $.ajax({
            url: '{{url('pangkatgol/search?golongan=')}}' + golongan + '&pangkat=' + pangkat + '&eselon=' + eselon + '&tingkat=' + tingkat,
            type: 'GET',
            dataTipe: 'JSON',
            beforeSend: function(){

            },
            success: function(res){
                // console.log(res);
            },
            error: function(res){    
                // console.log(res);
            }
        });
    }

</script>
@endsection
