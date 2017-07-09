@extends('layouts.master')

@section('css')
<style type="text/css">
    dt, dd{
        line-height: 2;
    }
</style>
@endsection

@section('head_title', 'Setting User')

@section('title')
<i class="fa fa-user fa-2x"></i> Setting User
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('user')}}"><i class="fa fa-user"></i> &nbsp;User</a>
</li>
<li class="active">
    Setting User
</li>
@endsection

@section('content')

@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div class="panel panel-default col-lg-12">
    <div class="panel-body">
        <div class="col-md-6" style="background: #eee">
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

                @if($user->pegawai != null)
                    @foreach($user->pegawai['attributes'] as $k => $v)
                        <dt>{{strtoupper(str_replace('_', ' ', $k))}}</dt>
                        <dd>{{$v}}</dd>
                    @endforeach
                @endif
            </dl>
        </div>
        <div class="col-md-6">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="post" action="" class="form-horizontal" style="margin-top: 100px;">
                <div class="form-group">
                    <label for="password" class="control-label col-md-5">Ubah Password</label>
                    <div class="col-md-7">
                        <input type="password" name="password" class="form-control" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="control-label col-md-5">Ulangi Password</label>
                    <div class="col-md-7">
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-5">
                        {{csrf_field()}}
                    </div>
                    <div class="col-md-7">
                        <button type="submit" class="btn btn-primary pull-right">Simpan <i class="fa fa-save"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')

@endsection