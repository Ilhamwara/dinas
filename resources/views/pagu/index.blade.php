@extends('layouts.master')

@section('css')
{{-- <link href="{{url('assets')}}/css/button-datatables.css" rel="stylesheet" type="text/css"/> --}}
<link href="{{url('assets')}}/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
    .price {
        text-align: right;
        font-weight: bolder;
    }
</style>
@endsection

@section('head_title', 'Pagu')


@section('title')
Data Pagu
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    Data Pagu
</li>
@endsection

@section('content')

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ URL::to('pagu/import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <ul>
                            <li>File harus berupa file <em>spreadsheet</em>  &nbsp;(.xls, .xlsx, .csv)</li>
                            <li>Format file tersebut harus sesuai jumlah kolomnya dengan database.</li>
                            <li>Download template <a href="{{url('/template_pagu_perjadin.xlsx')}}" style="color:orange;text-decoration: underline;">disini</a></li>
                        </ul>
                    </div>

                    {{csrf_field()}}
                    <input type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="import_file" class="form-control" required />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload <i class="fa fa-upload"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>



@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<div class="col-lg-12">
    <section class="box">
        <div class="content-body">
        	
        	<div class="btn-group pull-right">
        		<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> Impor</button>
        		<a href="{{url('pagu/create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Buat</a>
        	</div>
            <br>
            <hr />
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
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
 {!! $dataTable->scripts() !!}
@endsection