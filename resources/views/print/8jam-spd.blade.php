<html>
<head>
    <title>Surat Tugas</title>
    <style type="text/css">
        table tr td {
          font-size: 12px;
        }
        .ttd  {border-collapse:collapse;border-spacing:0;float: right;}
        .ttd td{font-family:Arial, sans-serif;font-size:10px;padding:2px;overflow:hidden;word-break:normal;}
        .ttd th{font-family:Arial, sans-serif;font-size:10px;font-weight:normal;padding:2px;overflow:hidden;word-break:normal;}
        .ttd .ttd-yw4l{vertical-align:top}
    </style>
</head>
<body>
    <table class="" style="width: 100%">
        <tr>
            <th class="-031e"><img src="{{asset('assets/images/garuda-hitam-putih.jpg')}}" width="50"></th>
        </tr>
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
            <td class="-031e" style="text-align:center;font-size: 12px;font-family: Arial;">Nomor: {{$response['data']['no_st']}}</td>
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
            <th class="tg-031e" rowspan="2">No.</th>
            <th class="tg-031e" rowspan="2">Pelaksana SPD</th>
            <th class="tg-031e" rowspan="2">Hari</th>
            <th class="tg-031e" rowspan="2">Tanggal</th>
            <th class="tg-yw4l" colspan="3">Pejabat Yang Mengesahkan</th>
        </tr>
        <tr>
            <th class="tg-yw4l">Nama</th>
            <th class="tg-yw4l">Jabatan</th>
            <th class="tg-yw4l">Tandatangan</th>
        </tr>
        <tr>
            <td class="nom">(1)</td>
            <td class="nom">(2)</td>
            <td class="nom">(3)</td>
            <td class="nom">(4)</td>
            <td class="nom">(5)</td>
            <td class="nom">(6)</td>
            <td class="nom">(7)</td>
        </tr>

        @forelse($response['data']['peserta'] as $k => $v)
        <tr>
            <td class="tg-031e" style="text-align: center;">{{$k+1}}</td>
            <td class="tg-031e">{{$v['nama']}}<br>{{$v['jabatan']}}<br>NIP.{{$v['nip']}}</td>
            @if($loop->first)
                <td class="tg-031e" style="text-align: center;" rowspan="{{count($response['data']['peserta'])}}">
                    @php
                        $input = explode("-", $response['data']['tanggal_awall']);

                        $d = $input[0];
                        $m = $input[1];
                        $y = $input[2];

                        $days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

                        $n = date('w', strtotime("$y-$m-$d"));

                        echo $days[$n];
                    @endphp
                </td>
                <td class="tg-031e" style="text-align: center;" rowspan="{{count($response['data']['peserta'])}}">{{$response['data']['tanggal_awal']}}</td>
                <td class="tg-yw4l" rowspan="{{count($response['data']['peserta'])}}"></td>
                <td class="tg-yw4l" rowspan="{{count($response['data']['peserta'])}}"></td>
                <td class="tg-yw4l" rowspan="{{count($response['data']['peserta'])}}"></td>
            @endif
        </tr>
        @empty
        <tr>
            <td class="tg-031e"></td>
            <td class="tg-031e"></td>
            <td class="tg-031e"></td>
            <td class="tg-031e"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
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
            <td class="ttd-yw4l">{{$response['st']->tempat_dikeluarkan_surat}}</td>
        </tr>
        <tr>
            <td class="ttd-031e">Pada Tanggal</td>
            <td class="ttd-031e">:</td>
            <td class="ttd-yw4l">{{\App\Library\Datify::readify(substr($response['st']->tanggal_surat, 0, 10))}}</td>
        </tr>
        <tr>
            <td class="ttd-031e" colspan="3">Pejabat Pembuat Komitmen Kegiatan</td>
        </tr>
        <tr>
            <td class="ttd-031e" colspan="3" style="padding-top: 72px;font-weight: bold;">
                <strong style="text-decoration: underline;">
                    {{$response['st']->pagu->nm_ppk}}
                </strong>
            </td>
        </tr>
        <tr>
            <td class="ttd-031e" colspan="3" style="padding-top: 0;">
                NIP. {{$response['st']->pagu->nip_ppk}}
            </td>
        </tr>
    </table>
</body>
</html>