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
    .judul{
        text-align: center;
    }
</style>
@endsection
@section('title')
Daftar Nominatif
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
   Daftar Nominatif
</li>
@endsection
@section('content')
    <div class="content-body">
    <div class="table-responsive">
    <form id="form1" action="index.php" method="post">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th rowspan="2" class="judul">No</th>
        <th rowspan="2" class="judul">Pelaksana Perjalanan Dinas</th>
        <th rowspan="2" class="judul">Gol</th>
        <th rowspan="2" class="judul">Tujuan</th>
        <th rowspan="2" class="judul">Lamanya</th>
        <th rowspan="2" class="judul">Tanggal Perjalanan Dinas</th>
        <th colspan="10" class="judul">Rincian Biaya Perjalanan Dinas</th>
        </tr>
        <tr>
        <th class="judul">Pengeluaran Riil</th>
        <th class="judul">Tiket</th>
        <th class="judul">Representasi</th>
        <th class="judul">Airport Tax</th>
        <th class="judul">Uang Saku</th>
        <th class="judul">Penginapan</th>
        <th class="judul">Jumlah</th>
        <th class="judul">Keterangan</th>
          
      </tr>
    </thead>
    <tbody>
      <tr id="item">
        <td><input type="text" name="no" class="form-control input-sm" value="" style="width: 50px;" required="" autofocus></td>
        <td><input type="text" name="ppd" class="form-control input-sm" value="" style="width: 300px;" required="" autofocus></td>
        <td><input type="text" name="gol" class="form-control input-sm" value="" style="width: 50px;" required="" autofocus></td>
        <td><input type="text" name="tujuan" class="form-control input-sm" value="" style="width: 300px;" required="" autofocus></td>
        <td><input type="text" name="lamanya" class="form-control input-sm" value="" style="width: 200px;" required="" autofocus></td>
        <td><input type="text" name="tanggal pd" class="form-control input-sm" value="" style="width: 400px;" required="" autofocus></td>
        <td><div class="input-group">
            <span class="input-group-addon">Rp</span><input type="text" name="pengeluaran riil" class="form-control input-sm" value="" style="width: 200px;" required="" autofocus></div></td>
        <td><div class="input-group">
            <span class="input-group-addon">Rp</span><input type="text" name="tiket" class="form-control input-sm" value="" style="width: 200px;  " required="" autofocus></div></td>
        <td><div class="input-group">
            <span class="input-group-addon">Rp</span><input type="text" name="representasi" class="form-control input-sm" value="" style="width: 200px;" required="" autofocus></div></td>
        <td><div class="input-group">
            <span class="input-group-addon">Rp</span><input type="text" name="airport tax" class="form-control input-sm" value="" style="width: 200px;" required="" autofocus></div></td>
        <td><div class="input-group">
            <span class="input-group-addon">Rp</span><input type="text" name="uang saku" class="form-control input-sm" value="" style="width: 200px;" required="" autofocus></div></td>
        <td><div class="input-group">
            <span class="input-group-addon">Rp</span><input type="text" name="penginapan" class="form-control input-sm" value="" style="width: 200px;" required="" autofocus></div></td>
        <td><div class="input-group">
            <span class="input-group-addon">Rp</span><input type="text" name="jumlah" class="form-control input-sm" value="" style="width: 200px;  " required="" autofocus>
            </div></td>
        <td><input type="text" name="keterangan" class="form-control input-sm" value="" style="width: 400px;  " required="" autofocus>
          </td>
      </tr>
    <tr id="jumlahnya">
        <td colspan="10" style="text-align: center;">Jumlah</td>
        <td colspan="10"><div class="input-group">
            <span class="input-group-addon">Rp</span><input type="text" name="ppd" class="form-control input-sm" value="" style="width: 300px; text-align:center;" required="" autofocus></div></</td>
        </tr>
    </tbody>
  </table>
        </form>
        
        <a onclick="tambah()" class="btn btn-primary">Tambah</a><br/><br/>
        
  </div>
    <br><br>
<div class="row">
    <div class="col-md-4">
    <p>Disahkan Oleh:<br>
    Kepala Seksi Pencairan Dana I<br>
    KPPN Jakarta I (018)</p>
    <br><br><br><br>
    <input type="text" name="" class="form-control input-sm" value="" style="width: 300px;" required="" placeholder="Nama" autofocus readonly>  
    <input type="text" name="" class="form-control input-sm" value="" style="width: 300px;" required="" placeholder="NIP" autofocus readonly>  
    </div>
    <div class="col-md-4"></div>
     <div class="col-md-4">
    <input type="text" name="" class="form-control input-sm" value="" style="width: 300px;" required="" placeholder="Tempat dan Tanggal" autofocus > 
    <input type="text" name="" class="form-control input-sm" value="" style="width: 300px;" required="" placeholder="PPK" autofocus>
    <br><br><br><br><br>     
    <input type="text" name="" class="form-control input-sm" value="" style="width: 300px;" required="" placeholder="Nama" autofocus readonly>  
    <input type="text" name="" class="form-control input-sm" value="" style="width: 300px;" required="" placeholder="NIP" autofocus readonly>  
    </div>
    
    
         
    <div>
    <button type="button" class="btn btn-primary" style="float:right; margin-top:30px;"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>
</div>
        </div>
</div>

</body>

<script src="jquery.min.js"></script>
<script src="script.js"></script>
<script>
function tambah(){
$('<tr id="item"><td><input type="text" name="no" class="form-control input-sm" value="" style="width: 50px;" required="" autofocus></td><td><input type="text" name="ppd" class="form-control input-sm" value="" style="width: 300px;" required="" autofocus></td><td><input type="text" name="gol" class="form-control input-sm" value="" style="width: 50px;" required="" autofocus></td><td><input type="text" name="tujuan" class="form-control input-sm" value="" style="width: 300px;" required="" autofocus></td><td><input type="text" name="lamanya" class="form-control input-sm" value="" style="width: 200px;" required="" autofocus></td><td><input type="text" name="tanggal pd" class="form-control input-sm" value="" style="width: 400px;" required="" autofocus></td><td><div class="input-group"><span class="input-group-addon">Rp</span><input type="text" name="pengeluaran riil" class="form-control input-sm" value="" style="width: 200px;" required="" autofocus></div></td><td><div class="input-group"><span class="input-group-addon">Rp</span><input type="text" name="tiket" class="form-control input-sm" value="" style="width: 200px;  " required="" autofocus></div></td><td><div class="input-group"><span class="input-group-addon">Rp</span><input type="text" name="representasi" class="form-control input-sm" value="" style="width: 200px;" required="" autofocus></div></td><td><div class="input-group"><span class="input-group-addon">Rp</span><input type="text" name="airport tax" class="form-control input-sm" value="" style="width: 200px;" required="" autofocus></div></td><td><div class="input-group"><span class="input-group-addon">Rp</span><input type="text" name="uang saku" class="form-control input-sm" value="" style="width: 200px;" required="" autofocus></div></td><td><div class="input-group"><span class="input-group-addon">Rp</span><input type="text" name="penginapan" class="form-control input-sm" value="" style="width: 200px;" required="" autofocus></div></td><td><div class="input-group"><span class="input-group-addon">Rp</span><input type="text" name="jumlah" class="form-control input-sm" value="" style="width: 200px;  " required="" autofocus></div></td><td><input type="text" name="keterangan" class="form-control input-sm" value="" style="width: 400px;  " required="" autofocus></td></tr>').insertBefore('#jumlahnya');
}
</script>
@endsection 