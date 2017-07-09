@extends('layouts.master')

@section('css')

@endsection

@section('head_title', 'Anak Satker')


@section('title')
Data Anak Satker
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    Data Anak Satker
</li>
@endsection

@section('content')

@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div class="col-lg-12">
    <section class="box">
        <div class="content-body">
        	Anak Satker
        	<div class="btn-group pull-right">
        		<a href="{{url('anak-satker/create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Anak Satker</a>
        	</div>

            <table class="table table-condensed table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun</th>
                        <th>Kode</th>
                        <th>Unit Kerja</th>
                        <th>No. SPD</th>
                        <th>PPK</th>
                        <th>Bendahara</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anak_satker as $k => $v)
                        <tr>
                            <td>{{($k+1)}}</td>
                            <td>{{$v->tahun}}</td>
                            <td>{{$v->kode}}</td>
                            <td>{{\App\Satker::find($v->id_unit_kerja)->unit_kerja}}</td>
                            <td>{{$v->no_spd}}</td>
                            <td>{!!$v->nama_ppk . '<br>' . $v->nip_ppk !!}</td>
                            <td>{!!$v->nama_bendahara . '<br>' . $v->nip_bendahara !!}</td>
                            <td>
                                <!-- Single button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{url('anak-satker/edit/' . $v->id)}}"><i class="fa fa-pencil"></i>&nbsp; Edit</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#"><i class="fa fa-trash-o"></i>&nbsp; Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8">Belum ada anak satker</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection