@extends('layouts.master')

@section('css')

@endsection

@section('head_title', 'Sunting User')

@section('title')
<i class="fa fa-user fa-2x"></i> Sunting User
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('user')}}"><i class="fa fa-user"></i> &nbsp;User</a>
</li>
<li class="active">
    Sunting User
</li>
@endsection

@section('content')

@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div class="panel panel-default col-lg-12">
    <div class="panel-body">
        <form class="form-horizontal" id="userForm" method="post" action>
            {{csrf_field()}}
            <div class="form-group">
                <label for="username" class="control-label col-md-2">Username</label>
                <div class="col-md-6">
                    <input type="text" name="username" id="username" class="form-control" required="required" value="{{ $user->username }}">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-md-2">Nama</label>
                <div class="col-md-6">
                    <input type="text" name="name" id="name" class="form-control" required="required" value="{{ $user->name }}">
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="control-label col-md-2">Tipe</label>
                <div class="col-md-6">
                    <label class="radio-inline"><input type="radio" name="type" value="admin" @if($user->type == 'admin') checked @endif required>Admin</label>
                    <label class="radio-inline"><input type="radio" name="type" value="spk" @if($user->type == 'spk') checked @endif required>SPK</label>
                    <label class="radio-inline"><input type="radio" name="type" value="pegawai" @if($user->type == 'pegawai') checked @endif required>Pegawai</label>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="control-label col-md-2">Password</label>
                <div class="col-md-6">
                    <input type="password" name="password" id="password" class="form-control" value="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success pull-right">Simpan&nbsp; <i class="fa fa-save"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')

@endsection