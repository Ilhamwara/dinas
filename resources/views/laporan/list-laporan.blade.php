@extends('layouts.master')

@section('head_title', 'Laporan Perjalanan Dinas')
@section('title')
Laporan Perjalanan Dinas
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    Laporan Perjalanan Dinas
</li>
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-body">
			{{-- {{$spd}} --}}
		</div>
		<div class="panel-footer">
			
		</div>
	</div>
@endsection

@section('js')
@endsection