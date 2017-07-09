@extends('layouts.master')

@section('css')
<link href="{{url('assets')}}/css/button-datatables.css" rel="stylesheet" type="text/css"/>
<link href="{{url('assets')}}/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
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

@section('head_title', 'Tambah Pegawai')


@section('title')
Tambah Surat Perjadin
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('surat-perjalanan-dinas')}}">Data Surat Perjadin</a>
</li>
<li class="active">
    Tambah Surat Perjadin
</li>
@endsection

@section('content')
<div class="col-lg-12">
    <section class="box">
        <div class="content-body">
            <div class="row">
                <form action="" method="post" class="form-horizontal">
                    <div class="col-md-12">                       
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">No Surat</label>                            
                            <div class="col-md-7">
                                <input type="text" value="" class="form-control" name="no_surat" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Pegawai</label>
                            <div class="col-md-7">
                                <select class="form-control nip_pegawai" multiple="multiple" name="nip_pegawai" required>
                                    <option>Ilham ( 123142341 )</option>
                                    <option>asaush ( 443213121 )</option>
                                    <option>66736471</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="masabakti" class="col-md-2 col-form-label">Masa Tugas</label>
                            <div class="col-md-7">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="form-control" name="sejak" required>
                                    <span class="input-group-addon">s/d</span>
                                    <input type="text" class="form-control" name="hingga" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2" >Transport</label>
                            <div class="col-md-7">
                                <input type="text" value="" class="form-control" name="transport" required>
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">NIP Inspektur</label>
                            <div class="col-md-7">
                                <select class="form-control nip_inspektur" name="nip_inspektur" required>
                                    <option>-- NIP Inspektur --</option>
                                    <option>23142341</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Nama Inspektur</label>
                            <div class="col-md-7">
                                <input type="text" value="Ilham Wara Nugroho" class="form-control" name="nama_inspektur" disabled>
                            </div>
                        </div>
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
    $(".nip_pegawai").select2();
    $(".nip_inspektur").select2();
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(":input").inputmask();
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var person = $('#person').val();
        var d = new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var year = d.getFullYear();
        $('.input-daterange').datepicker({
            format : 'dd MM yyyy',
            clearBtn: true,
            language: 'id',
            autoclose: true,
            todayHighlight: true
        });

    });
</script>
@endsection
