@extends('layouts.master')

@section('css')
<link href="{{url('assets')}}/css/button-datatables.css" rel="stylesheet" type="text/css"/>
<link href="{{url('assets')}}/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('head_title', 'Tambah Pegawai')


@section('title')
Tambah Data Pegawai
@endsection

@section('breadcrumb')
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
    </li>
    <li>
        <a href="{{url('pegawai')}}">Data Pegawai</a>
    </li>
    <li class="active">
        Tambah Data Pegawai
    </li>
@endsection

@section('content')
<div class="col-lg-8">
    <section class="box">
        <div class="content-body">
            <div class="row">
                <form action="" method="post" id="formPegawai">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Unit</label>
                            <div class="controls">
                                <select name="unit_kerja" id="unit_kerja" class="form-control" required>
                                    @forelse($satker as $k => $v)
                                        <option value="{{$v->unit_kerja}}" @if($v->satker_id == $pegawai->satker_id) selected @endif>{{$v->unit_kerja}}</option>
                                    @empty
                                    @endforelse
                                    <option value="Unit Kerja Lain" @if($v->unit_kerja == $pegawai->unit_kerja) selected @endif>Unit Kerja Lain</option>
                                </select>
                            </div>
                        </div>                       
                        
                        <div class="form-group">
                            <label class="form-label" >Nama Pegawai</label>
                            <div class="controls">
                                <input type="text" value="{{$pegawai->nama}}" class="form-control" name="nama" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" >Status Pegawai</label>
                            <div class="controls">
                                <label class="radio-inline"><input type="radio" name="pns" value="NON PNS" @if($pegawai->pns == 'NON PNS') checked @endif required> NON-PNS</label>
                                <label class="radio-inline"><input type="radio" name="pns" value="PNS" @if($pegawai->pns  == 'PNS') checked @endif required> PNS</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" >NIP</label>
                            <span class="desc"></span>
                            <div class="controls">
                                <input type="text" value="{{$pegawai->nip}}" class="form-control" name="nip" id="nip" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" >Golongan</label>
                            <div class="controls">
                                <label class="radio-inline"><input type="radio" name="golongan" value="I" @if($pegawai->golongan == 'I') checked @endif> I</label>
                                <label class="radio-inline"><input type="radio" name="golongan" value="II" @if($pegawai->golongan == 'II') checked @endif> II</label>
                                <label class="radio-inline"><input type="radio" name="golongan" value="III" @if($pegawai->golongan == 'III') checked @endif> III</label>
                                <label class="radio-inline"><input type="radio" name="golongan" value="IV" @if($pegawai->golongan == 'IV') checked @endif> IV</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Pangkat</label>
                            <div class="controls">
                                <div class="controls" id="pangkatController">
                                    <label class="radio-inline"><input type="radio" name="pangkat" value="A" @if($pegawai->pangkat == 'A') checked @endif> A</label>
                                    <label class="radio-inline"><input type="radio" name="pangkat" value="B" @if($pegawai->pangkat == 'B') checked @endif> B</label>
                                    <label class="radio-inline"><input type="radio" name="pangkat" value="C" @if($pegawai->pangkat == 'C') checked @endif> C</label>
                                    <label class="radio-inline"><input type="radio" name="pangkat" value="D" @if($pegawai->pangkat == 'D') checked @endif> D</label>
                                    <label class="radio-inline"><input type="radio" name="pangkat" value="E" @if($pegawai->pangkat == 'E') checked @endif> E</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Eselon</label>
                            <div class="controls" id="eselonController">
                                {{-- <input type="text" name="eselon" class="form-control" value="@if($pegawai->eselon == '1') Eselon 1 @elseif($pegawai->eselon == '2') Eselon 2 @else Non Eselon @endif" id="eselon" readonly> --}}
                               <label class="radio-inline"><input type="radio" name="eselon" value="0" required> Non Eselon</label>
                               <label class="radio-inline"><input type="radio" name="eselon" value="1" required> Eselon I</label>
                               <label class="radio-inline"><input type="radio" name="eselon" value="2" required> Eselon II</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Tingkat Perjalanan Dinas</label>
                            <div class="controls" id="tingkatController">
                                <label class="radio-inline"><input type="radio" name="tingkat" value="A" required @if($pegawai->tingkat_perjadin == 'A') checked @endif> A</label>
                                <label class="radio-inline"><input type="radio" name="tingkat" value="B" required @if($pegawai->tingkat_perjadin == 'B') checked @endif> B</label>
                                <label class="radio-inline"><input type="radio" name="tingkat" value="C" required @if($pegawai->tingkat_perjadin == 'C') checked @endif> C</label>
                                {{-- <input type="text" name="tingkat" class="form-control" value="" id="tingkat" readonly> --}}
                            </div>
                        </div>
       
                        <div class="form-group">
                            <label class="form-label">Jabatan</label>
                            <div class="controls">
                                <input type="text" value="{{$pegawai->jabatan}}" class="form-control" name="nama_jabatan" id="nama_jabatan">
                            </div>
                        </div>

                        
                    </div>
                    <div class="col-md-12 padding-bottom-30">
                        <div class="text-left">
                            {{csrf_field()}}
                            <button type="reset" class="btn"><i class="fa fa-refresh"></i> Reset</button>                        
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<div class="col-lg-4">
    <section class="box">
        <div class="content-body">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="page-header"><i class="fa fa-question-circle-o"></i></h6>
                    <div class="alert alert-info">
                       {{--  <ul>
                            <li>asdhaskdj</li>
                            <li>asdhaskdj</li>
                            <li>asdhaskdj</li>
                            <li>asdhaskdj</li>
                        </ul> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{url('assets')}}/js/bootstrap-validator.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#formPegawai').validator();
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

            intern();
        });
    </script>
    <script type="text/javascript">

        function ekstern() {


        }

        function intern() {
            //Eselon
            // changeEselon('predefined');

            //PNS
            $('input[type=radio][name=pns]').change(function() {
                if (this.value == 'PNS') {
                    isPns(true);
                    //loadPangkatGol();
                }
                else if (this.value == 'NON PNS') {
                    pns = false;
                    isPns(false);
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

                // changeEselon('predefined');

                if ($(this).attr('data-eselon') == 1) {
                    
                    $('#eselon').val('Eselon I');
                }else if($(this).attr('data-eselon') == 2) {
                    $('#eselon').val('Eselon II');
                
                }else {
                    $('#eselon').val('Non Eselon');
                }

                $('#tingkat').val($(this).attr('data-tingkat'));
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
            }else{
                var eselonHtml = '<label class="radio-inline"><input type="radio" name="eselon" value="0" required> Non Eselon</label> '
                               + '<label class="radio-inline"><input type="radio" name="eselon" value="1" required> Eselon I</label> '
                               + '<label class="radio-inline"><input type="radio" name="eselon" value="2" required> Eselon II</label> ';
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
            
                var tingkatController = '<input type="text" name="tingkat" class="form-control" value="" id="tingkat" readonly>';
                
                $('#tingkatController').html(tingkatController);
                $('#tingkat').prop('disabled', false).prop('readonly', true).prop('required', false);
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
