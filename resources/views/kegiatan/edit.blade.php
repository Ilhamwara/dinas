@extends('layouts.master')

@section('css')
<link href="{{url('assets')}}/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
<link href="{{url('assets')}}/css/select2.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('head_title', 'Edit Kegiatan')


@section('title')
{{$kegiatan->nama_kegiatan}}
@endsection

@section('breadcrumb')
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
    </li>
    <li>
        <a href="{{url('kegiatan')}}">Data Kegiatan</a>
    </li>
    <li class="active">
        {{$kegiatan->nama_kegiatan}}
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
                                <input type="text" value="{{$kegiatan->nama_kegiatan}}" class="form-control" name="nama_kegiatan" id="nama_kegiatan" data-validation="required" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Nama Penyelenggara</label>
                            <div class="col-md-7">
                                <input type="text" value="{{$kegiatan->nama_penyelenggara}}" class="form-control" name="nama_penyelenggara" id="nama_penyelenggara">
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label class="control-label col-md-3">Tahun Anggaran</label>                            
                            <div class="col-md-7">
                                <input type="text" value="" max="4" class="form-control" name="tahun_anggaran" id="tahun_anggaran" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3" >Akun Kegiatan</label>
                            <div class="col-md-7">
                                <input type="text" value="" class="form-control" name="akun_kegiatan" required>
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label class="control-label col-md-3" >Lokasi Kegiatan*</label>
                            <div class="col-md-7">
                                {{-- <input type="text" value="" class="form-control" name="lokasi_kegiatan" required> --}}
                                <select name="lokasi_kegiatan" class="form-control" id="lokasi_kegiatan" required="required">
                                    @forelse($tujuan as $k => $v)
                                        <option value="{{$v->id}}" @if($kegiatan->lokasi_kegiatan == $v->tujuan) selected @endif>{{$v->tujuan}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="masabakti" class="control-label col-md-3">Tanggal Pelaksanaan*</label>
                            <div class="col-md-7">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="form-control" name="sejak" id="sejak" value="{{\App\Library\Datify::readify($kegiatan->tanggal_awal)}}" required>
                                    <span class="input-group-addon">s/d</span>
                                    <input type="text" class="form-control" name="hingga" id="hingga" value="{{\App\Library\Datify::readify($kegiatan->tanggal_akhir)}}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="padding: 20px 0px;">

                        <div class="col-md-7 col-md-offset-3">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$kegiatan->kegiatan_id}}">
                            <button type="button" class="btn" id="newST" disabled="disabled" style="visibility: hidden;"><i class="fa fa-refresh"></i> Buat Surat Tugas</button>                        
                            <button type="submit" class="btn btn-primary pull-right" id="saveKegiatan"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
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
                    @forelse($kegiatan->st as $k => $v)
                        <tr>
                            <td><strong>{{$v->no_st}}</strong><br>
                                Tanggal: {{$v->tanggal_surat}}<br>
                                Dikeluarkan di: {{$v->tempat_dikeluarkan_surat}}<br>
                                Penandatangan: {{$v->nama_inspektur}}
                            </td>
                            <td id="kolom_peserta_{{$v->st_id}}">

                                @forelse($v->detail as $key => $value)
                                    - {{$value->pegawai->nama}}  ({{$value->pegawai->nip}})<br>
                                @empty
                                @endforelse
                            </td>
                        </tr>
                    @empty
                        <tr  id="psST">
                            <td colspan="2">Belum ada surat tugas</td>
                        </tr>
                    @endforelse
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
                    url : '{{url('kegiatan/updateajax')}}',
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
                            notie.alert('success', 'Berhasil menyimpan Kegiatan', 1);
                            window.location.replace('{{url('kegiatan')}}');
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
        })


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
    });
</script>
@endsection
