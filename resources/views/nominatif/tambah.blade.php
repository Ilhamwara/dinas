@extends('layouts.master')

@section('css')

@endsection

@section('head_title', 'Tambah Daftar Nominatif')

@section('title')
Tambah Daftar Nominatif
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('nominatif')}}">Daftar Nominatif</a>
</li>
<li class="active">
    Tambah Daftar Nominatif
</li>
@endsection

@section('content')

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div class="panel panel-default col-lg-12">
    <div class="panel-body">
      <h4 class="text-center">DAFTAR NOMINATIF</h4>
      <div class="row">
        <p class="text-center">No Surat Tugas</p>
        <input type="text" name="no" class="form-control" style="width: 250px; margin:auto;" required>
    </div>
    <br>

    <div class="table-responsive">
        <form action="" method="post">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th rowspan="2" class="text-center"></th>
                    <th rowspan="2" class="text-center">Pelaksana Perjalanan Dinas</th>
                    <th rowspan="2" class="text-center">Gol</th>
                    <th rowspan="2" class="text-center">Tujuan</th>
                    <th rowspan="2" class="text-center">Lamanya</th>
                    <th colspan="2" class="text-center">Tanggal Perjalanan Dinas</th>
                    <th colspan="10" class="text-center">Rincian Biaya Perjalanan Dinas</th>
                </tr>
                <tr>
                    <th class="text-center">Dari</th>
                    <th class="text-center">Sampai</th>
                    <th class="text-center">Pengeluaran Riil</th>
                    <th class="text-center">Tiket</th>
                    <th class="text-center">Representasi</th>
                    <th class="text-center">Airport Tax</th>
                    <th class="text-center">Uang Saku</th>
                    <th class="text-center">Penginapan</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">Keterangan</th>
                </tr>
            </thead>
            <tbody>
              <tr id="item">
                <td class="text-center"></td>
                <td>
                    <input type="text" name="ppd" class="form-control" style="width: 300px;" required>
                </td>
                <td>
                    <input type="text" name="gol" class="form-control" style="width: 50px;" required>
                </td>
                <td>
                    <input type="text" name="tujuan" class="form-control" style="width: 300px;" required>
                </td>
                <td>
                    <input type="text" name="lamanya" class="form-control" style="width: 200px;" required>
                </td>
                <td>
                    <input type="text" name="tanggal_dari" class="form-control" style="width: 300px;" required>
                </td>
                <td>
                    <input type="text" name="tanggal_sampai" class="form-control" style="width: 300px;" required>
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon">Rp</span><input type="text" name="pengeluaran riil" class="form-control" style="width: 200px;" required>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon">Rp</span><input type="text" name="tiket" class="form-control" style="width: 200px;  " required>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon">Rp</span><input type="text" name="representasi" class="form-control" style="width: 200px;" required>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon">Rp</span><input type="text" name="airport tax" class="form-control" style="width: 200px;" required>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon">Rp</span><input type="text" name="uang saku" class="form-control" style="width: 200px;" required>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon">Rp</span><input type="text" name="penginapan" class="form-control" style="width: 200px;" required>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon">Rp</span><input type="text" name="jumlah" class="form-control" style="width: 200px;  " required>
                    </div>
                </td>
                <td>
                    <input type="text" name="keterangan" class="form-control" style="width: 400px;  " required>
                </td>
            </tr>
            <tr id="jumlahnya">
                <td colspan="10" style="text-align: center;">Jumlah</td>
                <td colspan="10">
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon">Rp</span><input type="text" name="ppd" class="form-control" style="width: 100%; text-align:center;" required>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</form>
<a onclick="tambah()" class="btn btn-primary">Tambah form</a>
<br/><br/>
</div>
<br><br>
<div class="row">
    <div class="col-md-4 pull-left">
        <p>
            Disahkan Oleh:<br>
            Kepala Seksi Pencairan Dana I<br>
            KPPN Jakarta I (018)
        </p>
        <br><br><br><br><br>
        <input type="text" name="" class="form-control" required placeholder="Nama">
        <input type="text" name="" class="form-control" required placeholder="NIP">  
    </div>
    <div class="col-md-4 pull-right">
        <input type="text" name="" class="form-control" required placeholder="Tempat dan Tanggal">
        <input type="text" name="" class="form-control" required placeholder="PPK">
        <br><br><br><br><br>
        <input type="text" name="" class="form-control" required placeholder="Nama">  
        <input type="text" name="" class="form-control" required placeholder="NIP">  
    </div>
</div> 
</div>
</div>

@endsection

@section('js')
<script type="text/javascript">
 function tambah(){
    $('<tr id="item">'+
        '<td>'+
        '<button class="btn btn-danger remove_field" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o"></i></button>'+
        '</td>'+
        '<td>'+
        '<input type="text" name="ppd" class="form-control" style="width: 300px;" required>'+
        '</td>'+
        '<td>'+
        '<input type="text" name="gol" class="form-control" style="width: 50px;" required>'+
        '</td>'+
        '<td>'+
        '<input type="text" name="tujuan" class="form-control" style="width: 300px;" required>'+
        '</td>'+
        '<td>'+
        '<input type="text" name="lamanya" class="form-control" style="width: 200px;" required>'+
        '</td>'+
        '<td>'+
        '<input type="text" name="tanggal_dari" class="form-control" style="width: 300px;" required>'+
        '</td>'+
        '<td>'+
        '<input type="text" name="tanggal_sampai" class="form-control" style="width: 300px;" required>'+
        '</td>'+
        '<td>'+
        '<div class="input-group">'+
        '<span class="input-group-addon">Rp</span>'+
        '<input type="text" name="pengeluaran riil" class="form-control" style="width: 200px;" required>'+
        '</div>'+
        '</td>'+
        '<td>'+
        '<div class="input-group">'+
        '<span class="input-group-addon">Rp</span>'+
        '<input type="text" name="tiket" class="form-control" style="width: 200px;  " required>'+
        '</div>'+
        '</td>'+
        '<td>'+
        '<div class="input-group">'+
        '<span class="input-group-addon">Rp</span>'+
        '<input type="text" name="representasi" class="form-control" style="width: 200px;" required>'+
        '</div>'+
        '</td>'+
        '<td>'+
        '<div class="input-group">'+
        '<span class="input-group-addon">Rp</span>'+
        '<input type="text" name="airport tax" class="form-control" style="width: 200px;" required>'+
        '</div>'+
        '</td>'+
        '<td>'+
        '<div class="input-group">'+
        '<span class="input-group-addon">Rp</span>'+
        '<input type="text" name="uang saku" class="form-control" style="width: 200px;" required>'+
        '</div>'+
        '</td>'+
        '<td>'+
        '<div class="input-group">'+
        '<span class="input-group-addon">Rp</span>'+
        '<input type="text" name="penginapan" class="form-control" style="width: 200px;" required>'+
        '</div>'+
        '</td>'+
        '<td>'+
        '<div class="col-md-12">'+
        '<div class="input-group">'+
        '<span class="input-group-addon">Rp</span>'+
        '<input type="text" name="jumlah" class="form-control" style="width: 100%;" required>'+
        '</div>'+
        '</div>'+
        '</td>'+
        '<td>'+
        '<input type="text" name="keterangan" class="form-control" style="width: 400px;" required>'+
        '</td>'+
        '</tr>').insertBefore('#jumlahnya'); 
    $(".remove_field").click(function(){
        $(this).closest("tr").remove();
    });
}; 
</script>
@endsection