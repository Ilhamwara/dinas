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

<div class="modal fade bs-example-modal-lg" id="warning" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="jumbotron">
                    <h3 style="text-align: center;"><i class="fa fa-2x fa-info-circle"></i>
                    <br>
                    <small>Penyetaraan tingkat perjalanan dinas bagi pegawai Non-PNS
                    berdasarkan tingat pendidikan, dan kewajaran penugasan.</small>
                    </h3>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

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
                                <input type="text" value="" class="form-control" name="nama" required>
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
            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i>
                Penyetaraan tingkat perjalanan dinas bagi pegawai Non-PNS
                berdasarkan tingat pendidikan, dan kewajaran penugasan.
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{url('assets')}}/js/bootstrap-validator.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#warning').modal('show');

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
        });
    </script>
    <script type="text/javascript">

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
