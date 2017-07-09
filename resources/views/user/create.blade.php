@extends('layouts.master')

@section('css')

@endsection

@section('head_title', 'Tambah User')

@section('title')
<i class="fa fa-user fa-2x"></i> Tambah User
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('user')}}"><i class="fa fa-user"></i> &nbsp;User</a>
</li>
<li class="active">
    Tambah User
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
                    <input type="text" name="username" id="username" class="form-control" required="required" value="{{ old('username') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-md-2">Nama</label>
                <div class="col-md-6">
                    <input type="text" name="name" id="name" class="form-control" required="required" value="{{ old('name') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="control-label col-md-2">Tipe</label>
                <div class="col-md-6">
                    <label class="radio-inline"><input type="radio" name="type" class="type" value="admin" checked required>Admin</label>
                    <label class="radio-inline"><input type="radio" name="type" class="type" value="spk" required>SPK</label>
                    <label class="radio-inline"><input type="radio" name="type" class="type" value="pegawai" required>Pegawai</label>
                </div>
            </div>
            <div class="form-group" id="anak_satker_container">
                
            </div>
            <div class="form-group">
                <label for="password" class="control-label col-md-2">Password</label>
                <div class="col-md-6">
                    <input type="password" name="password" id="password" class="form-control" required="required" value="">
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
    <script type="text/javascript">
        $(document).on('change', '.type', function(){
            if ($(this).val() == 'spk') {
                var opt = '<label for="anak_satker" class="control-label col-md-2">Anak Satker</label><div class="col-md-6"><select name="anak_satker" required class="form-control">'
                opt += '@forelse($anakSatker as $k => $v) <option value="{{$v->id}}">{{$v->kode}}</option> @empty @endforelse';
                opt += '</select></div>';

                $('#anak_satker_container').html('').html(opt);
            }else{
                $('#anak_satker_container').html('');
            }
        })
    </script>
@endsection