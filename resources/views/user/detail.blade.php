@extends('layouts.master')

@section('css')

@endsection

@section('head_title', 'Detail User')

@section('title')
<i class="fa fa-user fa-2x"></i> Detail User
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('user')}}"><i class="fa fa-user"></i> &nbsp;User</a>
</li>
<li class="active">
    Detail User
</li>
@endsection

@section('content')

@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div class="panel panel-default col-lg-12">
    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Username</dt>
            <dd>{{$user->username}}</dd>
            <dt>Tipe</dt>
            <dd>
                @if($user->type == 'admin')
                    <span class="label label-danger"><i class="fa fa-star"></i> ADMIN</span>
                @elseif($user->type == 'spk')
                    <span class="label label-warning"><i class="fa fa-usd"></i> SPK</span>
                @elseif($user->type == 'pegawai')
                    <span class="label label-default"><i class="fa fa-user"></i> PEGAWAI</span>
                @endif
            </dd>
            <dt>Nama</dt>
            <dd>{{$user->username}}</dd>
        </dl>
    </div>
</div>

@endsection

@section('js')

@endsection