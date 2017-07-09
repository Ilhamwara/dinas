@extends('layouts.master')

@section('css')
<style>
    .nomor{
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
}
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
<form method="post" action="{{url('rincian-biaya/store')}}" target="_blank">
    <div class="col-lg-12">
        <section class="box">
            <div class="content-body">
                <div class="form-group row">
                    <label class="col-xs-2 col-form-label">Lampiran SPD No</label>
                    <div class="col-xs-5">
                        <input type="text" name="" class="form-control input-sm" value="{{$response['data']['nomor_spd']}}" required disabled>
                    </div>
                </div>
                <div class="form-group row">
                  <label class="col-xs-2 col-form-label">Tanggal</label>
                  <div class="col-xs-5">
                    <input type="text" name="" class="form-control input-sm" value="{{\App\Library\Datify::readify(substr($response['data']['tanggal_surat'], 0, 10))}}" required disabled>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- UANG LUMPSUM -->
<div class="col-lg-12">
    <section class="box">
        <div class="content-body">
            <h3><b>Uang Lumpsum</b></h3>
            <br>
            <div class="form-group row">
               <label class="col-xs-2 col-form-label">Jenis</label>
               <div class="col-md-4">
                <select class="form-control" id="jenis_lumpsum" name="jenis_lumpsum">
                    <option data_ref_lumpsum="0">-- Uang Lumpsum --</option>
                    @forelse($response['data']['referensi']['uang_harian'] as $k => $v)
                    <option value="{{$v->id}}" data_ref_lumpsum="{{$v->harga}}">{{$v->nama_referensi}}</option>
                    @empty
                    @endforelse
                </select>      
            </div>
            <div class="col-md-4">
                <a class="btn btn-default btn-sm" id="tmbl" onClick="TambahLumpsum(1)">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Quantity</label>
            <div class="col-md-4">
                <input type="number" name="qty_lumpsum[]" class="form-control input-sm qty_lumpsum active qty_lumpsum_0" min="0" value="0">
            </div>
            <label class="col-xs-1 col-form-label">Harga</label>
            <div class="col-md-4">
                <input type="number" name="subtotal_lumpsum[]" class="form-control input-sm qty_lumpsum active sub_lumpsum_0" min="0" value="0" disabled>
            </div>
        </div>
        <div class="form-group row" id="jumlah_lupsum">
            <label class="col-xs-2 col-form-label">Jumlah</label>
            <div class="col-md-4">
                <input type="number" min="0" step="1" name="lumpsum_tot" id="lumpsum_tot" class="form-control input-sm" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Keterangan</label>
            <div class="col-md-4">
             <textarea name="keterangan" class="form-control input-sm" rows="5"></textarea>
         </div>
     </div>
 </div>
</section>
</div>

<!-- BIAYA TRANSPORT -->

<div class="col-lg-12">
    <section class="box">
        <div class="content-body">
            <h3><b>Biaya Transport</b></h3>
            <br>
            <div class="form-group row">
               <label class="col-xs-2 col-form-label">Jenis</label>
               <div class="col-md-4">
                <select class="form-control" id="jenis_transport" name="jenis_transport">
                    <option data_ref_transport="0">-- Jenis Transport --</option>
                    @forelse($response['data']['referensi']['transport'] as $k => $v)
                    <option value="{{$v->id}}" data_ref_transport="{{$v->harga}}">{{$v->nama_referensi}}</option>
                    @empty
                    @endforelse
                </select>      
            </div>
            <div class="col-md-4">
                <a class="btn btn-default btn-sm" id="tmbh_transport" onClick="TambahTransport(1)">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Quantity</label>
            <div class="col-md-4">
                <input type="number" name="qty_transport[]" class="form-control input-sm qty_transport active qty_transport_0" min="0" value="0">
            </div>
            <label class="col-xs-1 col-form-label">Harga</label>
            <div class="col-md-4">
                <input type="number" name="subtotal_transport[]" class="form-control input-sm qty_transport active sub_transport_0" min="0" value="0" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Representasi</label>
            <div class="col-md-4">
                <input type="number" class="form-control" min="0" value="0" required>
            </div>
            
            <label class="col-xs-1 col-form-label" style="visibility: hidden;">Harga</label>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Harga" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Jumlah</label>
            <div class="col-md-4">
                <input type="text" name="transport_tot" id="transport_tot" class="form-control input-sm" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-2 col-form-label">Keterangan</label>
            <div class="col-md-4">
             <textarea name="keterangan" class="form-control input-sm" rows="5"></textarea>
         </div>
     </div>
 </div>
</section>
</div>

<!-- BIAYA PENGINAPAN -->

<div class="col-lg-12">
    <section class="box">
        <div class="content-body">
            <h3><b>Biaya Penginapan</b></h3>
            <br>
            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Hotel</label>
                <div class="col-md-4">
                    <select class="form-control" id="jenis_penginapan" name="jenis_penginapan">
                        <option data_ref_penginapan="0">-- Uang Penginapan --</option>
                        @forelse($response['data']['referensi']['uang_penginapan'] as $k => $v)
                        <option value="{{$v->id}}" data_ref_penginapan="{{$v->harga}}">{{$v->nama_referensi}}</option>
                        @empty
                        @endforelse
                    </select>      
                </div>
                <a class="btn btn-default btn-sm" id="btn_penginapan" onClick="TambahPenginapan(1)">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
            </div>
            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Quantity</label>
                <div class="col-md-4">
                    <input type="number" name="qty_penginapan[]" class="form-control input-sm qty_penginapan active qty_penginapan_0" min="0" value="0">
                </div>
                <label class="col-xs-1 col-form-label">Harga</label>
                <div class="col-md-4">
                    <input type="number" name="subtotal_penginapan[]" class="form-control input-sm qty_penginapan active sub_penginapan_0" min="0" value="0" disabled>
                </div>
            </div>
            <div class="form-group row" id="jumlah_penginapan">
                <label class="col-xs-2 col-form-label">Jumlah</label>
                <div class="col-md-4">
                    <input type="number" min="0" step="1" name="penginapan_tot" id="penginapan_tot" class="form-control input-sm" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Riil Penginapan</label>
                <div class="col-md-4">
                    <input type="text" name="" class="form-control input-sm" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Keterangan</label>
                <div class="col-md-4">
                 <textarea name="keterangan" class="form-control input-sm" rows="5"></textarea>
             </div>
         </div>
     </div>
 </section>
</div>

<!-- KETERANGAN -->
<div class="col-lg-12">
    <section class="box">
        <div class="content-body">
            <h3><b>Keterangan</b></h3>
            <br>
            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Tanggal</label>
                <div class="col-md-6">
                    <input type="date" class="form-control input-sm" disabled> 
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Telah Dibayar</label>
                <div class="col-md-6">
                    <input type="text" class="form-control input-sm" disabled> 
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Telah Diterima</label>
                <div class="col-md-6">
                    <input type="text" class="form-control input-sm" disabled> 
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Bendahara</label>
                <div class="col-md-6">
                    <input type="text" class="form-control input-sm" disabled> 
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Pelaksana</label>
                <div class="col-md-6">
                    <input type="text" class="form-control input-sm" disabled> 
                </div>
            </div>
        </div>
    </section>
</div>

<!-- TOTAL -->
<div class="col-lg-12">
    <section class="box">
        <div class="content-body" style="overflow: hidden;">
            <h3><b>Perhitungan SPD Rampung</b></h3>
            <br>
            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Total</label>
                <div class="col-md-6">
                    <input type="text" class="form-control input-sm" disabled> 
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Telah Dibayar</label>
                <div class="col-md-6">
                    <input type="text" class="form-control input-sm" disabled> 
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xs-2 col-form-label">Sisa kurang/lebih</label>
                <div class="col-md-6">
                    <input type="text" class="form-control input-sm" disabled> 
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
                    <button class="btn btn-primary">Simpan</button>
                    
                </div>
            </div>
        </div>
    </section>
</div>
</form>
{{-- {{dd($response['data']['referensi']['uang_harian'])}} --}}
@endsection 

@section('js')
<script type="text/javascript">
    var ref = [];
    @forelse($response['data']['referensi']['uang_harian'] as $k => $v)
    ref['{{$v->nama_referensi}}'] = {{$v->harga}};
    @empty
    @endforelse
</script>
<script type="text/javascript">
    function TambahLumpsum(ke){
        var strVar="";
        strVar += "<div class=\"form-group row\">";
        strVar += "            <label class=\"col-xs-2 col-form-label\">Quantity<\/label>";
        strVar += "            <div class=\"col-md-4\">";
        strVar += "                <input type=\"number\" name=\"qty_lumpsum[]\" class=\"form-control input-sm qty_lumpsum active qty_lumpsum_" + ke + "\" min=\"0\" value=\"0\">";
        strVar += "            <\/div>";
        strVar += "            <label class=\"col-xs-1 col-form-label\">Harga<\/label>";
        strVar += "            <div class=\"col-md-4\">";
        strVar += "                <input type=\"number\" name=\"subtotal_lumpsum[]\" class=\"form-control input-sm qty_lumpsum active sub_lumpsum_" + ke + "\"  placeholder=\"Harga\" value=\"0\" min=\"0\" required>";
        strVar += "            <\/div>";
        strVar += "                 <button class=\"btn btn-danger remove_field\"><i class=\"fa fa-trash-o\"><\/i><\/button>";
        strVar += "            <\/div>";

        $('.qty_lumpsum.active').removeClass('active');
        $(strVar).insertBefore('#jumlah_lupsum');
        $(".remove_field").click(function(){
            $(this).closest("div").remove();
            lumpsum_total();
        });

        $('#tmbl').attr('onclick', 'TambahLumpsum(' + (ke + 1) + ')' );
    }
    
    function TambahPenginapan(ke){
        var strVar="";
        strVar += "<div class=\"form-group row\">";
        strVar += "            <label class=\"col-xs-2 col-form-label\">Quantity<\/label>";
        strVar += "            <div class=\"col-md-4\">";
        strVar += "                <input type=\"number\" name=\"qty_penginapan[]\" class=\"form-control input-sm qty_penginapan active qty_penginapan_" + ke + "\" min=\"0\" value=\"0\">";
        strVar += "            <\/div>";
        strVar += "            <label class=\"col-xs-1 col-form-label\">Harga<\/label>";
        strVar += "            <div class=\"col-md-4\">";
        strVar += "                <input type=\"number\" name=\"subtotal_penginapan[]\" class=\"form-control input-sm qty_penginapan active sub_penginapan_" + ke + "\"  placeholder=\"Harga\" value=\"0\" min=\"0\" required>";
        strVar += "            <\/div>";
        strVar += "                 <button class=\"btn btn-danger remove_field\"><i class=\"fa fa-trash-o\"><\/i><\/button>";
        strVar += "            <\/div>";

        $('.qty_penginapan.active').removeClass('active');
        $(strVar).insertBefore('#jumlah_penginapan');
        $(".remove_field").click(function(){
            $(this).closest("div").remove();
            penginapan_total();
        });

        $('#btn_penginapan').attr('onclick', 'TambahPenginapan(' + (ke + 1) + ')' );
    }

    var ref_lumpsum = 0;

    $(document).on('change', '#jenis_lumpsum', function(){
        ref_lumpsum = $('#jenis_lumpsum option:selected').attr('data_ref_lumpsum');
        console.log(ref_lumpsum);
    });

    var ref_penginapan = 0;
    $(document).on('change', '#jenis_penginapan', function(){
        ref_penginapan = $('#jenis_penginapan option:selected').attr('data_ref_penginapan');
        console.log(ref_penginapan);
    });


    //Summary total lumpsum
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
        var ref = $('#jenis_lumpsum option:selected').attr('data_ref_lumpsum');
        if (ref > 0) {
            $(this).closest("div.form-group").find("input[name='subtotal_lumpsum[]']").val(qty * ref);
        }else{
            notie.alert('warning', 'Pilih jenis Lumpsum', '2');
            $('#jenis_lumpsum').focus();
        }
        lumpsum_total();
    });

     //Total Penginapan
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
        var ref = $('#jenis_penginapan option:selected').attr('data_ref_penginapan');
        if (ref > 0) {
            $(this).closest("div.form-group").find("input[name='subtotal_penginapan[]']").val(qty * ref);
        }else{
            notie.alert('warning', 'Pilih jenis penginapan', '2');
            $('#jenis_penginapan').focus();
        }
        penginapan_total();
    });






     //Function Transport

     function TambahTransport(ke){
        var strVar="";
        strVar += "<div class=\"form-group row\">";
        strVar += "            <label class=\"col-xs-2 col-form-label\">Quantity<\/label>";
        strVar += "            <div class=\"col-md-4\">";
        strVar += "                <input type=\"number\" name=\"qty_transport[]\" class=\"form-control input-sm qty_transport active qty_transport_" + ke + "\" min=\"0\" value=\"0\">";
        strVar += "            <\/div>";
        strVar += "            <label class=\"col-xs-1 col-form-label\">Harga<\/label>";
        strVar += "            <div class=\"col-md-4\">";
        strVar += "                <input type=\"number\" name=\"subtotal_transport[]\" class=\"form-control input-sm qty_transport active sub_transport_" + ke + "\"  placeholder=\"Harga\" value=\"0\" min=\"0\" required>";
        strVar += "            <\/div>";
        strVar += "                 <button class=\"btn btn-danger remove_field\"><i class=\"fa fa-trash-o\"><\/i><\/button>";
        strVar += "            <\/div>";

        $('.qty_transport.active').removeClass('active');
        $(strVar).insertBefore('#jumlah_transport');
        $(".remove_field").click(function(){
            $(this).closest("div").remove();
            transport_total();
        });

        $('#tmbh_transport').attr('onclick', 'Tambahtransport(' + (ke + 1) + ')' );
    }

    var ref_transport = 0;
    $(document).on('change', '#jenis_transport', function(){
        ref_transport = $('#jenis_transport option:selected').attr('data_ref_transport');
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
        var ref = $('#jenis_transport option:selected').attr('data_ref_transport');
        if (ref > 0) {
            $(this).closest("div.form-group").find("input[name='subtotal_transport[]']").val(qty * ref);
        }else{
            notie.alert('warning', 'Pilih jenis transport', '2');
            $('#jenis_transport').focus();
        }
        transport_total();
    });




</script>
@endsection