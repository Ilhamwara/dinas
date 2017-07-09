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

@section('head_title', 'User')

@section('title')
<i class="fa fa-user fa-2x"></i> User
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    User
</li>
@endsection

@section('content')

@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div class="panel panel-default col-lg-12">
    <div class="panel-body">
        <a href="{{url('user/create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah User</a>
        <br>
        <br>
        <br>
       {!! $dataTable->table() !!}
    </div>
</div>

@endsection

@section('js')
    <script src="{{url('assets')}}/js/jquery-datatables.js" type="text/javascript"></script> 
    <script src="{{url('assets')}}/js/datatables.js" type="text/javascript"></script>

    <script src="{{url('assets')}}/js/zip-datatables.js" type="text/javascript"></script> 
    <script src="{{url('assets')}}/js/pdf-datatables.js" type="text/javascript"></script> 
    <script src="{{url('assets')}}/js/fvs-datatables.js" type="text/javascript"></script> 

    <script src="{{url('assets')}}/js/print-datatables.js" type="text/javascript"></script> 
    <script src="{{url('assets')}}/js/button-html5-datatables.js" type="text/javascript"></script> 
    {!! $dataTable->scripts() !!}
@endsection