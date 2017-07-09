@extends('layouts.master')

@section('css')
<style type="text/css">
    .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{
        padding:5px;
        text-align: center;
    }

    .table>tbody>tr>th {
        background: #333;
        color: #fff;
        vertical-align: middle;
    }

    .nm {
        text-align: left;
    }

    .fa-plane {
        color: #ff4d4d;
    }

</style>
@endsection

@section('head_title', 'Monitoring')

@section('title')
Monitoring
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    Monitoring
</li>
@endsection

@section('content')

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-inline" method="get" action="">
            <div class="form-group">
                <div class="col-md-10">
                    <select name="instansi" class="form-control">
                        @forelse($instansi as $k => $v)
                            <option value="{{$v->hashid}}" @if(null != request()->instansi && request()->instansi == $v->hashid) selected @endif>{{$v->unit_kerja}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success">Tampilkan</button>
                </div>
            </div>
        </form>
        <hr>
        <table class="table table-condensed table-hover table-striped table-bordered table-responsive">
            {{-- @for($i = 1; $i<=30; $i++) --}}
                {{-- <tr> --}}
                    {!!$data!!}
                {{-- </tr> --}}
            {{-- @endfor --}}
        </table>
    </div>
</div>


@endsection

@section('js')

@endsection