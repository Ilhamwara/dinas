{{-- {{dd($kegiatan)}} --}}
@extends('layouts.master')

@section('css')
<link href="{{url('assets')}}/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
<link href="{{url('assets')}}/css/select2.min.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
    .select2-dropdown{
        border: 1px solid #e1e1e1;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple{
        border: 1px solid #e1e1e1;
    }
    .select2-container--default .select2-selection--multiple{
     border-radius: 0px;   
     border: 1px solid #e1e1e1;
 }
 .select2-container--default .select2-selection--single{
   border-radius: 0px;   
   border: 1px solid #e1e1e1;
   height: 35px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
    line-height: 30px;
}
.select2-container--default .select2-selection--single .select2-selection__arrow{
    top: 4px;
    right: 4px;
}


</style>
@endsection

@section('head_title', 'Surat Tugas')


@section('title')
Tambah Surat Tugas
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('surat-tugas')}}">Data Surat Tugas</a>
</li>
<li class="active">
    Tambah Surat Tugas
</li>
@endsection

@section('content')

{{-- ERROR MESSAGE --}}
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Sepertinya data yang anda kirim belum valid.</strong><br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="col-lg-12">
    <section class="box">
        <div class="content-body">
            <div class="row">
                <form action="" method="post" class="form-horizontal">
                    <div class="col-md-12">                       
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">No Surat</label>                            
                            <div class="col-md-7">
                                <input type="text" value="" class="form-control" name="no_surat" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2" >Kegiatan</label>
                            <div class="col-md-7">
                                <select class="form-control" name="kegiatan" id="kegiatan" required @if(count($kegiatan) == 1) disabled @endif>
                                    @if(count($kegiatan) > 1)
                                        @forelse($kegiatan as $k => $v)
                                            <option value="{{$v->kegiatan_id}}">{{$v->nama_kegiatan}}</option>
                                        @empty
                                        @endforelse
                                    @else
                                        <option value="{{$kegiatan->kegiatan_id}}">{{$kegiatan->nama_kegiatan}}</option>
                                    @endif
                                </select>
                                @if(count($kegiatan) == 1) 
                                    <input type="hidden" name="kegiatan" value="{{$kegiatan->kegiatan_id}}">
                                @endif

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="masabakti" class="col-md-2 col-form-label">Masa Tugas</label>
                            <div class="col-md-7">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="form-control" name="sejak" required value="@if(count($kegiatan) == 1) {{\App\Library\Datify::readify($kegiatan->tanggal_awal)}} @endif" @if(count($kegiatan) == 1) disabled @endif>
                                    <span class="input-group-addon">s/d</span>
                                    <input type="text" class="form-control" name="hingga" required value="@if(count($kegiatan) == 1) {{\App\Library\Datify::readify($kegiatan->tanggal_akhir)}} @endif" @if(count($kegiatan) == 1) disabled @endif>
                                    {{-- SET VALUE --}}
                                    @if(count($kegiatan) == 1) 
                                        <input type="hidden" name="sejak" readonly="true" value="{{\App\Library\Datify::readify($kegiatan->tanggal_awal)}}">
                                        <input type="hidden" name="hingga" readonly="true" value="{{\App\Library\Datify::readify($kegiatan->tanggal_akhir)}}">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Tujuan</label>
                            <div class="col-md-7">
                                <select class="form-control" name="tujuan" id="tujuan" required @if(count($kegiatan) == 1) disabled @endif>
                                    @if(count($kegiatan) > 1)
                                        @forelse($tujuan as $k => $v)
                                            <option value="{{$v->id}}">{{$v->tujuan}}</option>
                                        @empty
                                        @endforelse
                                    @else
                                        <option value="{{$kegiatan->lokasi_kegiatan}}">{{$kegiatan->lokasi_kegiatan}}</option>
                                    @endif
                                </select>
                                @if(count($kegiatan) == 1) 
                                    <input type="hidden" name="tujuan" value="{{$kegiatan->lokasi_kegiatan}}">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Tgl Surat</label>                            
                            <div class="col-md-7">
                                <div class="input-group">
                                    <input type="text" value="" autocomplete="off" class="form-control" name="tgl_surat" id="tgl_surat" required>
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
                            <label class="col-form-label col-md-2">Penanggungjawab</label>
                            <div class="col-md-7">
                                <select class="form-control nip_inspektur" name="inspektur" id="inspektur" required>
                                    @forelse($pegawai as $k => $v)
                                        <option value="{{$v->pegawai_id}}">{{$v->nama . '(' . $v->nip . ')'}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
<hr>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Pegawai Peserta Perjalanan Dinas</label>
                            <div class="col-md-7">
                                <select class="form-control nip_pegawai" multiple="multiple" name="pegawai[]" id="pegawai" required>
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
                        {{-- <div class="form-group row">
                            <label class="col-form-label col-md-2">Tahun</label>
                            <div class="col-md-7">
                                <select class="form-control" name="st_tahun" id="st_tahun" required>
                                    @for($i = (date('Y') -2); $i <= (date('Y') +2); $i++)
                                    <option value="{{$i}}" @if($i == date('Y')) selected @endif>{{$i}}</option>

                                    @endfor
                                </select>
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Kode Anak Satker</label>
                            <div class="col-md-7">
                                <select class="form-control" name="st_kode_anak_satker" id="st_kode_anak_satker" required>
                                    <option>--Pilih Kode Anak Satker--</option>

                                    @forelse($anakSatker as $k => $v)
                                        <option value="{{$v->id}}">{{$v->kode}}</option>
                                    @empty
                                        <option> !! Belum ada anak satker pada tahun ini !! </option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
{{--                             <div class="form-group row">
                            <label class="col-form-label col-md-2">Kode Program</label>
                            <div class="col-md-7">
                                <select class="form-control" name="st_program" id="st_program" required disabled>

                                </select>
                            </div>
                        </div> --}}
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

                        {{-- <div class="form-group row">
                            <label class="col-form-label col-md-2">Akun</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="st_akun_terbeban" id="st_akun_terbeban">
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-md-12" style="padding: 20px 0px;">
                        <div class="text-center">
                            {{csrf_field()}}
                            <button type="reset" class="btn"><i class="fa fa-refresh"></i> Reset</button>                        
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{url('assets')}}/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="{{url('assets')}}/js/bootstrap-datepicker.id.min.js"></script>
<script type="text/javascript" src="{{url('assets')}}/js/select2.min.js"></script>
<script type="text/javascript">
    $("#pegawai, #inspektur, #tujuan, #kegiatan").select2();
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(":input").inputmask();
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var d = new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var year = d.getFullYear();
        $('.input-daterange, #tgl_surat').datepicker({
            format : 'dd MM yyyy',
            clearBtn: true,
            language: 'id',
            autoclose: true,
            todayHighlight: true
        });

    });




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
