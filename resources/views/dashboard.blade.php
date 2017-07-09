@extends('layouts.master')

@section('head_title', 'Dashboard')

@section('css')
<style type="text/css">
    .tile-counter{
        box-shadow: 0px 0px 5px 0px #aaa;
        transition: .3s ease-out;
    }
    .content > h2{ color: #aaa; }
    .content > span{ color: #aaa; }
    .tile-counter:hover{
        transform: scale(1.05);
    }
    .r3_weather{
        background: #2C3E50 !important;
        box-shadow: 3px 5px 10px 0px #566573;
    }
    .wekk{
        padding: 15px;
        color: #999999;
        margin: 0px;
        min-height: 175px;
    }
    .wekk li{
        display: inline-block;
        padding: 10px 0;
        border-bottom: 1px solid rgba(200, 200, 200, 0.4);
        width: 100%;
    }
    .wekk li .day{
        color: #aaaaaa;
        display: inline-block;
        min-width: 60px;
        font-size: 90%;
        width: 70px;
        overflow: hidden;
        -o-text-overflow: ellipsis;
        text-overflow: ellipsis;
        vertical-align: top;
    }
    .wekk li i{
        margin: 0 30px;
    }
    .wekk li .temp{
        float: right;
        color: #777777;
        font-size: 90%;
    }
    .shortcut{
        background: #5D6D7E;
        color: #fff; 
        padding: 5px; 
        position: absolute; 
        margin-top:-15px; 
        margin-left: 7px;
    }
    .shortcut:hover{
        text-decoration: none;
        color: #fff;
    }
</style>
@endsection

@section('title')
Dashboard
@endsection

@section('content')
<div class="col-xs-12 col-sm-6 col-lg-4">
    <div class="tile-counter bg-white">
        <div class="pull-right">
            <a href="{{url('/kegiatan/tambah')}}" class="fa fa-plus text-white shortcut" data-toogle="tooltip" title="Tambah Kegiatan"></a>
        </div>
        <div class="content">        
            <i class='fa fa-star-half-o icon-lg'></i>
            <h2 class="number_counter" data-speed="3000" data-from="1001" data-to="3504">{{$kegiatan_count}}</h2>
            <div class="clearfix"></div>
            <span><b>Kegiatan</b></span>
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-6 col-lg-4">
    <div class="tile-counter bg-white">
        <div class="pull-right">
            <a href="{{url('/kegiatan/tambah')}}" class="fa fa-plus text-white shortcut" data-toogle="tooltip" title="Tambah SPD"></a>
        </div>
        <div class="content">
            <i class='fa fa-envelope icon-lg'></i>
            <h2 class="number_counter" data-speed="3000" data-from="1001" data-to="3504">{{$spd_count}}</h2>
            <div class="clearfix"></div>
            <span><b>Surat Perjalanan Dinas</b></span>
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-6 col-lg-4">
    <div class="tile-counter bg-white">
        <div class="pull-right">
            <a href="{{url('/surat-tugas')}}" class="fa fa-plus text-white shortcut" data-toogle="tooltip" title="Tambah Surat Tugas"></a>
        </div>
        <div class="content">
            <i class='fa fa-envelope-o icon-lg'></i>
            <h2 class="number_counter" data-speed="3000" data-from="1001" data-to="3504">{{$surat_tugas_count}}</h2>
            <div class="clearfix"></div>
            <span><b>Surat Tugas</b></span>
        </div>
    </div>
</div>
<div class="">
    <div class="box col-md-6">
        <div class="content-body">  
            <div class="row">
                <div class="col-xs-12">
                    <h4>Pagu tahun {{session('tahun')}}</h4>
                    <dl class="dl-horizontal">
                        <dt>Total</dt>
                        <dd>Rp. {{number_format($total, 0, ',', '.')}}</dd>
                        <dt>Terealisasi</dt>
                        <dd>Rp. {{number_format($terealisasi, 0, ',', '.')}}</dd>
                        <dt>Sisa</dt>
                        <dd>Rp. {{number_format($sisa, 0, ',', '.')}}</dd>
                    </dl>
                    <div class="chart-container">
                        <canvas id="paguChart" ></canvas>
                    </div>
                </div>      
            </div> <!-- End .row -->
        </div>
    </div>
    <div class="col-md-6">
        <ul class="list-group">
            <li class="list-group-item active">
                <h4 class="list-group-item-heading">SPD Terakhir</h4>
            </li>
            @forelse($spd_terakhir as $k => $v)
                <a href="{{url('kegiatan/single/' . $v->st->kegiatan->kegiatan_id)}}" class="list-group-item">
                    <h5 class="list-group-item-heading">{{$v->pegawai->nama}}</h5>
                    <p class="list-group-item-text">{{$v->st->kegiatan->nama_kegiatan}}</p>
                 </a>
            @empty
                <li class="list-group-item">Belum ada perjadin</li>
            @endforelse
        </ul>
    </div>
</div>
{{-- <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="r3_weather">
        <div class="wid-weather wid-weather-small">
            <div class="">
                <div class="location">
                    <h3>Jakarta, INA</h3>
                    <span></span>
                </div>
                <div class="clearfix"></div>
                <div class="degree" style="padding: 0px 25px !important;">
                    <i class='fa fa-clock-o icon-lg text-white'></i><span>NOW</span><br><span style="font-size: 15px;" id="jam"></span>
                    <br><br>
                </div>
                <h4 class="text-center" style="color: #fff;">E-Perjadin</h4>
                <div class="clearfix"></div>
                <div class="wekk bg-white">
                    <ul class="list-unstyled">
                        <li><span class='day'>Sunday</span><i class='fa fa-child icon-xs'></i><span class='temp'>23° - 27°</span></li>
                        <li><span class='day'>Monday</span><i class='fa fa-child icon-xs'></i><span class='temp'>21° - 26°</span></li>
                        <li><span class='day'>Tuesday</span><i class='fa fa-child icon-xs'></i><span class='temp'>24° - 28°</span></li>
                        <li><span class='day'>Wednesday</span><i class='fa fa-child icon-xs'></i><span class='temp'>25° - 26°</span></li>
                        <li><span class='day'>Thursday</span><i class='fa fa-child icon-xs'></i><span class='temp'>22° - 25°</span></li>
                        <li><span class='day'>Friday</span><i class='fa fa-child icon-xs'></i><span class='temp'>21° - 28°</span></li>
                        <li><span class='day'>Satday</span><i class='fa fa-child icon-xs'></i><span class='temp'>23° - 29°</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
@section('js')
{{-- <script type="text/javascript">
    setTimeout("waktu()",1000);
    function waktu(){
        var today = new Date();
        var jam  = today.getHours();
        var menit = today.getMinutes();
        var detik = today.getSeconds();
        setTimeout("waktu()",1000);
        document.getElementById("jam").innerHTML = jam+" : "+menit+" : "+detik;
    }
</script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js" type="text/javascript"></script>
{{-- <script src="{{url('assets')}}/js/chart-chartjs.js" type="text/javascript"></script> --}}
<script>
    $(document).ready(function(){
        var data = {
            datasets: [{
                data: [
                    {{$total . ',' . $terealisasi . ',' . $sisa}}
                ],
                backgroundColor: [
                    "#36A2EB",
                    "#FF6384",
                    "#4BC0C0"                    
                ],
                label: 'Pagu Tahun {{session('tahun')}}' // for legend
            }],
            labels: [
                "Total",
                "Terealisasi",
                "Sisa"
            ]
        };
        // And for a doughnut chart
        var paguChart = $('#paguChart');
        var myDoughnutChart = new Chart(paguChart, {
            type: 'doughnut',
            data: data,
            options: {
                animation:{
                    animateScale:true
                }
            }
        });
    })
</script>
@endsection