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
Pengeluaran Riil
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    Pengeluaran Riil
</li>
@endsection
@section('content')
<div class="col-lg-12">
    <section class="box">
        <div class="content-body">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="border:none;">Nama:</td>
                            <td style="border:none;"><input type="text" name="" class="form-control input-sm" value="" style="width: 400px;" required="required" autofocus></td>
                        </tr>
                        <tr>
                            <td style="border:none;">NIP:</td>
                            <td style="border:none;"><input type="text" name="" class="form-control input-sm" value="" style="width: 400px;" required="required" autofocus></td>
                        </tr>
                        <tr>
                            <td style="border:none;">Jabatan:</td>
                            <td style="border:none;"><input type="text" name="" class="form-control input-sm" value="" style="width: 400px;" required="required" autofocus></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p>Berdasarkan Surat Perjalanan Dinas (SPD)  </p>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="border:none;">Nomor:</td>
                            <td style="border:none;"><input type="text" name="" class="form-control input-sm" value="" style="width: 400px;" required="required" autofocus></td>
                        </tr>
                        <tr>
                            <td style="border:none;">Tanggal:</td>
                            <td style="border:none;"><input type="text" name="" class="form-control input-sm" value="" style="width: 400px;" required="required" autofocus></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p>dengan ini kami menyatakan dengan sesungguhnya bahwa:</p>
            <p>1. Biaya transport pegwai dan/ atau biaya penginapan dibawah ini yang tidak dapat diperoleh bukti bukti pengeluarannya, meliputi:</p>

            <hr>

            <h4 style="text-align: center;">Rincian Biaya Riil</h4>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="text-align:center;">No</th>
                    <th style="text-align:center;">Uraian</th>
                    <th style="text-align:center;">Jumlah</th>

                </tr>
            </thead>
            <tbody>
              <tr id="item">
                <td style="text-align:center;"></td>
                <td>
                    <select class="form-control" id="sel1" name="jenis[]">
                        <option value="">Hotel-Bandara PP</option>
                        <option value="">Sewa Kendaraan</option>
                        <option value="">Biaya Taksi</option>
                        <option value="">Penginapan riil</option>
                        <option value="">Jakarta-Bandung</option>
                    </select>      
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon">Rp</span>
                        <input type="text" name="pengeluaran_riil[]" class="form-control" required>
                    </div>
                </td>
            </tr>
            <tr>
                <tr id="jumlahnya">
                    <td class="nomor"></td>
                    <td style="text-align:center;">Jumlah</td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" name="pengeluaran riil" class="form-control" required>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <a onclick="tambah()" class="btn btn-warning">Tambah form</a>
    <br><br>
    <p>2. Jumlah uang tersebut pada angka 1 di atas benar - benar dikeluarkan untuk pelaksanaan perjalanan Dinas dimaksud dan apabila dikemudian hari terdapat kelebihan atas pembayaran, kami bersedia untuk menyetorkan kelebihan tersebut ke Kas Negara.</p>
    <p>Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya.</p>

    <div class="col-md-4 pull-right">
        <input type="text" name="" class="form-control" placeholder="Tanggal" required>    
    </div>
    <div class="row" style="clear: both;">
        <div class="col-md-4 pull-left" style="margin-top:40px;">
            <p>Mengetahui,</p>
            <p>Pejabat Pembuat Komitmen Kegiatan</p>
            <br><br><br><br><br>
            <input type="text" name="" class="form-control input-sm" placeholder="Nama PPK" style="width: 250px;" required="" autofocus>
            <input type="text" name="" class="form-control input-sm" placeholder="NIP" style="width: 250px;" required="" autofocus>
        </div>
        <div class="col-md-4 pull-right" style="margin-top:70px;">
            <p>Pelaksana SPD</p>
            <br><br><br><br><br>
            <input type="text" name="" class="form-control" placeholder="Nama Pelaksana" required>
            <input type="text" name="" class="form-control" placeholder="NIP" required>

            <button class="btn btn-primary pull-right" style="margin-top:40px;">Simpan</button>
        </div>
    </div>

</div>
</section>
</div>
</body>

<script>
    function tambah(){
        $('<tr id="baru">'+
            '<td style="text-align:center;">'+
            '<a class="btn btn-danger remove_field"><i class="fa fa-trash-o"></i></a>'+
            '</td>'+
            '<td>'+
            '<select class="form-control" id="sel1">'+
            '<option value="">Hotel-Bandara PP</option>'+
            '<option value="">Sewa Kendaraan</option>'+
            '<option value="">Biaya Taksi</option>'+
            '<option value="">Penginapan riil</option>'+
            '<option value="">Jakarta-Bandung</option>'+
            '</select>'+
            '<td>'+
            '<div class="input-group">'+
            '<span class="input-group-addon">Rp</span>'+
            '<input type="text" name="pengeluaran riil" class="form-control" required>'+
            '</div>'+
            '</td>'+
            '</tr>').insertBefore('#jumlahnya');

        $(".remove_field").click(function(){
            $(this).closest("tr").remove();

        });
    }
</script>
</html>

@endsection