@extends('layouts.master')
@section('css')
    <link href="{{url('assets')}}/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        table tr td {
          font-size: 12px;
        }
        .ttd  {border-collapse:collapse;border-spacing:0;float: right;}
        .ttd td{font-family:Arial, sans-serif;font-size:10px;padding:2px;overflow:hidden;word-break:normal;}
        .ttd th{font-family:Arial, sans-serif;font-size:10px;font-weight:normal;padding:2px;overflow:hidden;word-break:normal;}
        .ttd .ttd-yw4l{vertical-align:top}
    </style>
@endsection
@section('head_title', 'Rincian Biaya Perjadin')
@section('title')
Rincian Biaya Perjalanan Dinas Dalam Kota 8 Jam
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li class="active">
    Rincian Biaya Perjalanan Dinas Dalam Kota 8 Jam
</li>
@endsection
@section('content')
<div class="panel panel-default">
<form method="post" action="">
<div class="panel-body">
    <table class="" style="width: 100%">
        <tr>
            <td class="-031e" style="text-align:center;font-size: 12px;font-family: Arial;font-weight: bold;">KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN</td>
        </tr>
        <tr>
            <td class="-031e" style="text-align:center;font-size: 12px;font-family: Arial;font-weight: bold;">REPUBLIK INDONESIA</td>
        </tr>
        <tr>
            <td class="-031e" style="text-align: center;">Jl. Lapangan Banteng Timur No. 2-4 Jakarta 10710</td>
        </tr>
        <tr>
            <td class="-yw4l" style="text-align: center;border-bottom: 1px solid #000;padding-bottom: 10px;">Telpon 3456825 Fax. 3456825</td>
        </tr>
    </table>


    <table class="" style="width: 100%">
        <tr>
            <td class="-031e" style="text-align:center;font-size: 14px;font-family: Arial;font-weight: bold;padding-top: 10px;">FORM BUKTI KEHADIRAN PELAKSANAAN PERJALANAN DINAS JABATAN DALAM KOTA SAMPAI DENGAN 8 (DELAPAN) JAM</td>
        </tr>
        <tr>
            <td class="-031e" style="text-align:center;font-size: 12px;font-family: Arial;">Nomor: {{$response['data']['st']->no_st}}</td>
        </tr>
    </table>


    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }
        .tg td {
            font-family: Arial, sans-serif;
            font-size: 10px;
            padding: 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
        }
        .tg th {
            background: #eee;
            font-family: Arial, sans-serif;
            font-size: 10px;
            font-weight: normal;
            padding: 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
        }
        .tg .tg-yw4l {
            vertical-align: top
        }
        .nom {
            padding: 2px;
            text-align: center;
            font-weight: bold;
        }
    </style>
    <table class="tg">
        <tr>
            <th class="tg-031e">No.</th>
            <th class="tg-031e">Pelaksana SPD</th>
            <th class="tg-031e">Besaran</th>
            <th class="tg-031e">Tandatangan</th>
        </tr>
        <tr>
            <td class="nom">(1)</td>
            <td class="nom">(2)</td>
            <td class="nom">(3)</td>
            <td class="nom">(4)</td>
        </tr>

        @forelse($response['data']['pegawai'] as $k => $v)
        <tr>
            <td class="tg-031e" style="text-align: center;">{{$k+1}}</td>
            <td class="tg-031e">{{$v['nama']}}<br>{{$v['jabatan']}}<br>NIP.{{$v['nip']}}</td>
            <td class="tg-yw4l">
                <div class="input-group">
                    <input type="text" class="form-control" value="Rp. {{number_format($response['data']['referensi'], 0, ',', '.')}}" disabled>
                    <span class="input-group-addon">
                        <input type="checkbox" name="pg_id[]" value="{{$v->hashid}}" @if(in_array($v->pegawai_id, $response['data']['existingPengeluaran'])) checked @endif>
                    </span>
                </div><!-- /input-group -->
            </td>
            <td class="tg-yw4l"></td>
        </tr>
        @empty
        <tr>
            <td class="tg-031e"></td>
            <td class="tg-031e"></td>
            <td class="tg-031e"></td>
            <td class="tg-031e"></td>
        </tr>
        @endforelse
    </table>

    <table class="ttd">
        <tr>
            <th class="ttd-031e"></th>
            <th class="ttd-031e"></th>
            <th class="ttd-yw4l"></th>
        </tr>
        <tr>
            <td class="ttd-yw4l">Dikeluarkan di</td>
            <td class="ttd-yw4l">:</td>
            <td class="ttd-yw4l"></td>
        </tr>
        <tr>
            <td class="ttd-031e">Pada Tanggal</td>
            <td class="ttd-031e">:</td>
            <td class="ttd-yw4l">{{\App\Library\Datify::readify(substr($response['data']['st']->tanggal_surat, 0, 10))}}</td>
        </tr>
        <tr>
            <td class="ttd-031e" colspan="3">Pejabat Pembuat Komitmen Kegiatan</td>
        </tr>
        <tr>
            <td class="ttd-031e" colspan="3" style="padding-top: 72px;font-weight: bold;">
                <strong style="text-decoration: underline;">
                    {{$response['data']['st']->pagu->nm_ppk}}
                </strong>
            </td>
        </tr>
        <tr>
            <td class="ttd-031e" colspan="3" style="padding-top: 0;">
                NIP. {{$response['data']['st']->pagu->nip_ppk}}
                {{-- {{dd($response)}} --}}
                <br>
                <button type="submit" class="btn btn-primary btn-block">Simpan <i class="fa fa-save"></i></button>
            </td>
        </tr>
    </table>
    </div>
    {{csrf_field()}}
    <input type="hidden" name="st_id" value="{{$response['data']['st']->hashid}}">
    </form>
</div>
@endsection 

@section('js')
<script type="text/javascript" src="{{asset('assets/js/terbilang.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/rupiah.js')}}"></script>
<script type="text/javascript" src="{{url('assets')}}/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="{{url('assets')}}/js/bootstrap-datepicker.id.min.js"></script>

@endsection