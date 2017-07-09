@extends('layouts.master')

@section('css')
<link href="{{url('assets')}}/css/button-datatables.css" rel="stylesheet" type="text/css"/>
<link href="{{url('assets')}}/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('head_title', 'Pegawai')


@section('title')
Data Pegawai
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    Data Pegawai
</li>
@endsection

@section('content')
{{-- <div class="col-lg-12">
    <section class="box">
        <div class="content-body">
            <a href="{{url('pegawai/tambah')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Pegawai</a>
                <br>
                <br>
                <div class="table-responsive">
                    <table id="example" width="100%" cellspacing="0"  class="display nowrap table table-hover table-condensed table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Golongan</th>
                                <th>Jabatan</th>
                                <th>Lokasi Kerja</th>
                                <th>Pangkat</th>
                                <th>Unit Kerja</th>      
                                <th>Action</th>             
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>1286126182</td>
                                <td>Ilham</td>
                                <td>Golongan</td>
                                <td>Jabatan</td>
                                <td>Lokasi Kerja</td>
                                <td>Pankat</td>
                                <td>Unit Kerja</td>
                                <td>
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cogs"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{url('pegawai/profile/1')}}"><i class="fa fa-eye"></i> &nbsp;View</a></li>
                                        <li><a href="{{url('pegawai/edit/1')}}"><i class="fa fa-pencil"></i> &nbsp;Edit</a></li>
                                    </ul>
                                </div>                         
                            </td>
                        </tr>              
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div> --}}
@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div class="col-lg-12">
    <section class="box">
        <div class="content-body">
            <a href="{{url('pegawai/tambah')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Pegawai</a>
            <br>
            <br>
            <br>
            {!! $dataTable->table() !!}
        </div>
    </section>
</div>
@endsection


@section('js')
<script src="{{url('assets')}}/js/jquery-datatables.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/js/button-datatables.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/js/zip-datatables.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/js/pdf-datatables.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/js/fvs-datatables.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/js/button-flash.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/js/print-datatables.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/js/button-html5-datatables.js" type="text/javascript"></script> 
<script src="{{url('assets')}}/js/datatables.js" type="text/javascript"></script>
{{-- <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    });
</script> --}}

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
 {!! $dataTable->scripts() !!}
@endsection