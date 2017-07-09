@extends('layouts.master')

@section('css')
<style>
/*    .nomor{
        text-align:center;
    }
    .container{
        width: 1029px;
        height: 1197px;
    }
    ul > li{
        list-style: none;
        margin: 5px 0px;
    }
    ol > li{
     margin: 10px 0px;   
 }
 .padding-left-0{
    padding-left: 0px !important;
}*/
</style>
@endsection

@section('title')
Rincian Biaya Perjalanan Dinas
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    Rincian Biaya Perjalanan Dinas
</li>
@endsection


@section('content')
<div class="col-lg-12">
    <section class="box">
        <div class="content-body">
            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Lampiran SPD No</label>
                <div class="col-xs-5">
                    <input type="text" name="" class="form-control input-sm" value="{{$response['data']['nomor_spd']}}" required readonly>
                </div>
            </div>
            <div class="form-group row">
              <label class="col-xs-2 col-form-label">Tanggal</label>
              <div class="col-xs-5">
                <input type="text" name="" class="form-control input-sm" value="{{\App\Library\Datify::readify(substr($response['data']['tanggal_surat'], 0, 10))}}" required readonly>
            </div>
        </div>
    </div>
</section>
</div>
<div class="col-lg-12">
    <section class="box">
        <header class="panel_header">
            <h2 class="title pull-left"><b>Form Rincian Biaya</b></h2>
        </header>
        <div class="content-body">    
           <div class="row">
               <div class="col-xs-12">
                <form id="commentForm" action="{{url('rincian-biaya/store')}}" method="POST" target="_blank">
                    <div id="pills" class='wizardpills' >
                        <ul class="form-wizard">
                            <li><a href="#tab_lumpsum" data-toggle="tab"><span>Lumpsum</span></a></li>
                            <li><a href="#tab_transport" data-toggle="tab"><span>Transport</span></a></li>
                            <li><a href="#tab_penginapan" data-toggle="tab"><span>Penginapan</span></a></li>
                            <li><a href="#tab_keterangan" data-toggle="tab"><span>Keterangan</span></a></li>
                            <li><a href="#tab_spd" data-toggle="tab"><span>Total</span></a></li>
                        </ul>
                        <div id="bar" class="progress active">
                            <div class="progress-bar progress-bar-primary " role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                        </div>

                        <div class="tab-content">

                            <!-- ////////////////////////////////////////// UANG LUMPSUM ////////////////////////////////-->
                            <div class="tab-pane" id="tab_lumpsum">
                                <br>
                                <h3><b>Lumpsum</b></h3>
                                <br>
                                <div class="form-group row">
                                    <label class="col-xs-2 col-form-label">Jenis</label>
                                    <div class="col-md-3">
                                        <select  id="jenis_lumpsum[]" class="form-control jenis_lumpsum" name="jenis_lumpsum[]">
                                            <option data_ref_lumpsum="0">-- Pilih Jenis --</option>
                                            @forelse($response['data']['referensi']['uang_harian'] as $k => $v)
                                            <option value="{{$v->id}}" data_ref_lumpsum="{{$v->harga}}">{{$v->nama_referensi}}</option>
                                            @empty
                                            @endforelse
                                        </select>      
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="qty_lumpsum[]" class="form-control input-sm qty_lumpsum active qty_lumpsum_0" min="0" value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="subtotal_lumpsum[]" class="form-control input-sm qty_lumpsum active sub_lumpsum_0" min="0" value="0" readonly>
                                    </div>
                                    <a class="btn btn-default btn-sm" id="tmbl" onClick="TambahLumpsum(1)">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </a>
                                </div>
                                <div class="form-group row" id="jumlah_lupsum">
                                    <label class="col-xs-2 col-form-label">Jumlah</label>
                                    <div class="col-md-9">
                                        <input type="number" min="0" step="1" name="lumpsum_tot" id="lumpsum_tot" class="form-control input-sm" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xs-2 col-form-label">Keterangan</label>
                                    <div class="col-md-9">
                                     <textarea name="keterangan_lumpsum" class="form-control input-sm" rows="5"></textarea>
                                 </div>
                             </div>
                         </div>

                         <!-- ////////////////////////////////  BIAYA TRANSPORT  //////////////////////////////////////// -->
                         <div class="tab-pane" id="tab_transport">
                            <br>
                            <h3><b>Transport</b></h3>
                            <br>
                            <div class="form-group row">
                                <label class="col-xs-2 col-form-label">Jenis</label>
                                <div class="col-md-3">
                                    <select class="form-control jenis_transport" id="jenis_transport[]" name="jenis_transport[]">
                                        <option data_ref_transport="0">-- Pilih Jenis --</option>
                                        @forelse($response['data']['referensi']['transport'] as $k => $v)
                                        <option value="{{$v->id}}" data_ref_transport="{{$v->harga}}">{{$v->nama_referensi}}</option>
                                        @empty
                                        @endforelse
                                    </select>      
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="qty_transport[]" class="form-control input-sm qty_transport active qty_transport_0" min="0" value="0">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="subtotal_transport[]" class="form-control input-sm qty_transport active sub_transport_0" min="0" value="0" readonly>
                                </div>
                                <a class="btn btn-default btn-sm" id="tmbl_transport" onClick="TambahTransport(1)">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </a>
                            </div>
                            <div class="form-group row" id="jumlah_transport">
                                <label class="col-xs-2 col-form-label">Jumlah</label>
                                <div class="col-md-9">
                                    <input type="number" min="0" step="1" name="transport_tot" id="transport_tot" class="form-control input-sm" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-2 col-form-label">Keterangan</label>
                                <div class="col-md-9">
                                 <textarea name="keterangan_transport" class="form-control input-sm" rows="5"></textarea>
                             </div>
                         </div>
                     </div>

                     <!-- ////////////////////////////////  BIAYA PENGINAPAN  //////////////////////////////////////// -->
                     <div class="tab-pane" id="tab_penginapan">
                        <br>
                        <h3><b>Penginapan</b></h3>
                        <br>
                        <div class="form-group row">
                            <label class="col-xs-2 col-form-label">Jenis</label>
                            <div class="col-md-3">
                                <select class="form-control jenis_penginapan" id="jenis_penginapan[]" name="jenis_penginapan[]">
                                    <option data_ref_penginapan="0">-- Pilih Jenis --</option>
                                    @forelse($response['data']['referensi']['uang_penginapan'] as $k => $v)
                                    <option value="{{$v->id}}" data_ref_penginapan="{{$v->harga}}">{{$v->nama_referensi}}</option>
                                    @empty
                                    @endforelse
                                </select>      
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="qty_penginapan[]" class="form-control input-sm qty_penginapan active qty_penginapan_0" min="0" value="0">
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="subtotal_penginapan[]" class="form-control input-sm qty_penginapan active sub_penginapan_0" min="0" value="0" readonly>
                            </div>
                            <a class="btn btn-default btn-sm" id="tmbl_penginapan" onClick="TambahPenginapan(1)">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </div>
                        <div class="form-group row" id="riil">
                            <label class="col-xs-2 col-form-label">Riil Penginapan</label>
                            <div class="col-md-9">
                                <input type="number" min="0" step="1" name="penginapan_riil" id="penginapan_riil" class="form-control input-sm" required>
                            </div>
                        </div>
                        <div class="form-group row" id="jumlah_penginapan">
                            <label class="col-xs-2 col-form-label">Jumlah</label>
                            <div class="col-md-9">
                                <input type="text" name="penginapan_tot" id="penginapan_tot" class="form-control input-sm" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-2 col-form-label">Keterangan</label>
                            <div class="col-md-9">
                             <textarea name="keterangan_penginapan" class="form-control input-sm" rows="5"></textarea>
                         </div>
                     </div>
                 </div>

                 <!-- ////////////////////////////////  BIAYA KETERANGAN  //////////////////////////////////////// -->
                 <div class="tab-pane" id="tab_keterangan">
                    <br>
                    <h3><b>Keterangan</b></h3>
                    <br>
                    <div class="form-group row">
                        <label class="col-xs-2 col-form-label">Tanggal</label>
                        <div class="col-md-6">
                            <input type="date" class="form-control input-sm"> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-2 col-form-label">Telah Dibayar</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control input-sm" readonly> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-2 col-form-label">Telah Diterima</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control input-sm" readonly> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-2 col-form-label">Bendahara</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control input-sm" readonly> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-2 col-form-label">Pelaksana</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control input-sm" readonly> 
                        </div>
                    </div>
                </div>

                <!-- ////////////////////////////////  BIAYA SPD  //////////////////////////////////////// -->
                <div class="tab-pane" id="tab_spd">
                    <br>
                    <h3><b>Perhitungan SPD Rampung</b></h3>
                    <br>
                    <div class="form-group row">
                        <label class="col-xs-2 col-form-label">Total</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control input-sm" readonly> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-2 col-form-label">Telah Dibayar</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control input-sm" readonly> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-2 col-form-label">Sisa kurang/lebih</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control input-sm" readonly> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-2 col-form-label">Pembuat Anggaran</label>
                        <div class="col-md-6">
                            <input type="text" name="" class="form-control input-sm" value="{{$response['data']['pagu']['nama_ppk']}}" readonly>
                            <input type="text" name="" class="form-control input-sm" value="{{$response['data']['pagu']['nip_ppk']}}" readonly style="margin-top: 5px;">
                        </div>
                    </div>
                    <div class="form-group row pull-right">
                        <div class="col-md-4">
                            {{csrf_field()}}
                            <input type="hidden" name="spd_id" class="form-control input-sm" value="{{$response['data']['hashid']}}" required readonly>
                            <input type="hidden" name="surat_tugas_id" class="form-control input-sm" value="{{$response['data']['surat_tugas']['hashid']}}" required readonly>
                            <input type="hidden" name="pegawai_id" class="form-control input-sm" value="{{$response['data']['pegawai']['hashid']}}" required readonly>

                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <ul class="pager wizard">
                    <li class="next last" style="display:none;"><a href="javascript:;">Last</a></li>
                    <li class="next"><a href="javascript:;">Next</a></li>
                </ul>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</section>
</div>
@endsection 
@section('js')
<script src="{{url('assets')}}/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{url('assets')}}/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<script src="{{url('assets')}}/js/form-validation.js" type="text/javascript"></script> 

<script type="text/javascript">

//BUAT JS ADD BUTTON LUMPSUM
function TambahLumpsum(ke){
    var strVar="";
    strVar += " <div class=\"form-group row\">";
    strVar += " <label class=\"col-xs-2 col-form-label\">Jenis<\/label>";
    strVar += " <div class=\"col-md-3\">";
    strVar += " <select class=\"form-control jenis_lumpsum\" id=\"jenis_lumpsum[]\"  name=\"jenis_lumpsum[]\">";
    strVar += " <option data_ref_lumpsum=\"0\">-- Pilih Jenis --</option>";

    @forelse($response['data']['referensi']['uang_harian'] as $k => $v)
    strVar += "<option value=\"{{$v->id}}\" data_ref_lumpsum=\"{{$v->harga}}\">{{$v->nama_referensi}}<\/option>";
    @empty
    @endforelse

    strVar += " <\/select>";
    strVar += " <\/div>";
    strVar += " <div class=\"col-md-3\">";
    strVar += " <input type=\"number\" name=\"qty_lumpsum[]\" class=\"form-control input-sm qty_lumpsum active qty_lumpsum_0\" min=\"0\" value=\"0\">";
    strVar += " <\/div>";
    strVar += " <div class=\"col-md-3\">";
    strVar += " <input type=\"number\" name=\"subtotal_lumpsum[]\" class=\"form-control input-sm qty_lumpsum active sub_lumpsum_0\" min=\"0\" value=\"0\" readonly>";
    strVar += " <\/div>";
    strVar += " <button class=\"btn btn-danger btn-sm remove_field\" data-toogle=\"toogle\" title=\"Hapus\"><i class=\"fa fa-trash-o\"><\/i><\/button>";
    strVar += " <\/div>";
    strVar += " <\/div>";

    $('.qty_lumpsum.active').removeClass('active');
    $(strVar).insertBefore('#jumlah_lupsum');
    $(".remove_field").click(function(){
        $(this).closest("div").remove();
        lumpsum_total();
    });

    $('#tmbl').attr('onclick', 'TambahLumpsum(' + (ke + 1) + ')' );
}
var ref_lumpsum = 0;

$(document).on('change', '.jenis_lumpsum', function(){
    ref_lumpsum = $('this option:selected').attr('data_ref_lumpsum');
    console.log(ref_lumpsum);
});
function lumpsum_total() {
    var tot = 0;
    $("input[name='subtotal_lumpsum[]").each(function(k, v){
        tot += parseFloat($(v).val());
    });
    $('#lumpsum_tot').val(tot);
}
$(document).on('change', '.qty_lumpsum', function(){
    var qty = $(this).val();
    var subtotal = $(this).closest("div.form-group").find("input[name='subtotal_lumpsum[]']").val();
    var ref = $(this).closest("div.form-group").find(".jenis_lumpsum option:selected").attr('data_ref_lumpsum');
    console.log(ref);
    if (ref > 0) {
        $(this).closest("div.form-group").find("input[name='subtotal_lumpsum[]']").val(qty * ref);
    }else{
        notie.alert('warning', 'Pilih jenis Lumpsum', '2');
//        $('#jenis_lumpsum').focus();
}
lumpsum_total();
});
</script>

<script type="text/javascript">

//BUAT JS ADD BUTTON TRANSPORT
function TambahTransport(ke){
    var strVar="";
    strVar += " <div class=\"form-group row\">";
    strVar += " <label class=\"col-xs-2 col-form-label\">Jenis<\/label>";
    strVar += " <div class=\"col-md-3\">";
    strVar += " <select class=\"form-control jenis_transport\" id=\"jenis_transport[]\" name=\"jenis_transport[]\">";
    strVar += " <option data_ref_transport=\"0\">-- Pilih Jenis --</option>";

    @forelse($response['data']['referensi']['transport'] as $k => $v)
    strVar += "<option value=\"{{$v->id}}\" data_ref_transport=\"{{$v->harga}}\">{{$v->nama_referensi}}<\/option>";
    @empty
    @endforelse

    strVar += " <\/select>";
    strVar += " <\/div>";
    strVar += " <div class=\"col-md-3\">";
    strVar += " <input type=\"number\" name=\"qty_transport[]\" class=\"form-control input-sm qty_transport active qty_transport_0\" min=\"0\" value=\"0\">";
    strVar += " <\/div>";
    strVar += " <div class=\"col-md-3\">";
    strVar += " <input type=\"number\" name=\"subtotal_transport[]\" class=\"form-control input-sm qty_transport active sub_transport_0\" min=\"0\" value=\"0\" readonly>";
    strVar += " <\/div>";
    strVar += " <button class=\"btn btn-danger btn-sm remove_field\" data-toogle=\"toogle\" title=\"Hapus\"><i class=\"fa fa-trash-o\"><\/i><\/button>";
    strVar += " <\/div>";
    strVar += " <\/div>";

    $('.qty_transport.active').removeClass('active');
    $(strVar).insertBefore('#jumlah_transport');
    $(".remove_field").click(function(){
        $(this).closest("div").remove();
        transport_total();
    });

    $('#tmbl_transport').attr('onclick', 'TambahTransport(' + (ke + 1) + ')' );
}
var ref_transport = 0;

$(document).on('change', '.jenis_transport', function(){
    ref_transport = $('this option:selected').attr('data_ref_transport');
    console.log(ref_transport);
});
function transport_total() {
    var tot = 0;
    $("input[name='subtotal_transport[]").each(function(k, v){
        tot += parseFloat($(v).val());
    });
    $('#transport_tot').val(tot);
}
$(document).on('change', '.qty_transport', function(){
    var qty = $(this).val();
    var subtotal = $(this).closest("div.form-group").find("input[name='subtotal_transport[]']").val();
    var ref = $(this).closest("div.form-group").find(".jenis_transport option:selected").attr('data_ref_transport');
    if (ref > 0) {
        $(this).closest("div.form-group").find("input[name='subtotal_transport[]']").val(qty * ref);
    }else{
        notie.alert('warning', 'Pilih jenis transport', '2');
        // $('#jenis_transport').focus();
    }
    transport_total();
});
</script>

<script type="text/javascript">

//BUAT JS ADD BUTTON PENGINAPAN
function TambahPenginapan(ke){
    var strVar="";
    strVar += " <div class=\"form-group row\">";
    strVar += " <label class=\"col-xs-2 col-form-label\">Jenis<\/label>";
    strVar += " <div class=\"col-md-3\">";
    strVar += " <select class=\"form-control jenis_penginapan\" id=\"jenis_penginapan[]\" name=\"jenis_penginapan[]\">";
    strVar += " <option data_ref_penginapan=\"0\">-- Pilih Jenis --</option>";

    @forelse($response['data']['referensi']['uang_penginapan'] as $k => $v)
    strVar += "<option value=\"{{$v->id}}\" data_ref_penginapan=\"{{$v->harga}}\">{{$v->nama_referensi}}<\/option>";
    @empty
    @endforelse

    strVar += " <\/select>";
    strVar += " <\/div>";
    strVar += " <div class=\"col-md-3\">";
    strVar += " <input type=\"number\" name=\"qty_penginapan[]\" class=\"form-control input-sm qty_penginapan active qty_penginapan_0\" min=\"0\" value=\"0\">";
    strVar += " <\/div>";
    strVar += " <div class=\"col-md-3\">";
    strVar += " <input type=\"number\" name=\"subtotal_penginapan[]\" class=\"form-control input-sm qty_penginapan active sub_penginapan_0\" min=\"0\" value=\"0\" readonly>";
    strVar += " <\/div>";
    strVar += " <button class=\"btn btn-danger btn-sm remove_field\" data-toogle=\"toogle\" title=\"Hapus\"><i class=\"fa fa-trash-o\"><\/i><\/button>";
    strVar += " <\/div>";
    strVar += " <\/div>";

    $('.qty_penginapan.active').removeClass('active');
    $(strVar).insertBefore('#riil');
    $(".remove_field").click(function(){
        $(this).closest("div").remove();
        penginapan_total();
    });

    $('#tmbl_penginapan').attr('onclick', 'TambahPenginapan(' + (ke + 1) + ')' );
}
var ref_penginapan = 0;

$(document).on('change', '.jenis_penginapan', function(){
    ref_penginapan = $('this option:selected').attr('data_ref_penginapan');
    console.log(ref_penginapan);
});
function penginapan_total() {
    var tot = 0;
    $("input[name='subtotal_penginapan[]").each(function(k, v){
        tot += parseFloat($(v).val());
    });
    $('#penginapan_tot').val(tot);
}
$(document).on('change', '.qty_penginapan', function(){
    var qty = $(this).val();
    var subtotal = $(this).closest("div.form-group").find("input[name='subtotal_penginapan[]']").val();
    var ref = $(this).closest("div.form-group").find(".jenis_penginapan option:selected").attr('data_ref_penginapan');
    if (ref > 0) {
        $(this).closest("div.form-group").find("input[name='subtotal_penginapan[]']").val(qty * ref);
    }else{
        notie.alert('warning', 'Pilih jenis penginapan', '2');
        // $('#jenis_penginapan').focus();
    }
    penginapan_total();
});
</script>

<script type="text/javascript">
    function simpanlumpsum(){
        var lumpsum_form = $('#tmbl').serialize();
        $.ajax({
            url         : '{{url('rincian-biaya/store')}}',
            type        : 'POST',
            data        : lumpsum_form,
            dataType    : 'JSON',
            beforeSend  : function(){

            },
            success     : function(response){
                console.log(response);
            },
            error       : function(response){
                console.log(response);
            }
        });
    }
</script>
<script type="text/javascript">
    // $(document).on('click', '.next' , function(){

    // })
</script>
@endsection