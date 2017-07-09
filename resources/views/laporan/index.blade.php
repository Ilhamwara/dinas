@extends('layouts.master')

@section('css')
    <link href="{{url('assets')}}/css/button-datatables.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets')}}/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        strong:parent {
            text-align: right;
        }
    </style>
@endsection

@section('head_title', 'Laporan Perjalanan')

@section('title')
Laporan Perjalanan
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    Laporan Perjalanan
</li>
@endsection

@section('content')

@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div class="panel panel-default col-lg-12">
    <div class="panel-body">
       {!! $dataTable->table() !!}
    </div>
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
    {!! $dataTable->scripts() !!}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
@endsection
