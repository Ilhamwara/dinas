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

@section('head_title', 'SPD')

@section('title')
Surat Perjalanan Dinas
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    Surat Perjalanan Dinas
</li>
@endsection

@section('content')

@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<div class="panel panel-default col-lg-12">
    <div class="panel-body">
        {{-- <a href="{{url('surat-perjalanan-dinas/tambah')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> &nbsp;Tambah Surat Perjadin</a> --}}
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
{!! $dataTable->scripts() !!}

@endsection
