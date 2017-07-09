<?php use Carbon\Carbon; $total = 0;?>
<html>
<head>
    <title>Daftar Nominatif</title>  
    <style type="text/css">
        .inti {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        .inti td {
            font-family: Arial, sans-serif;
            font-size: 12px;
            padding: 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
        }
        .inti th {
            font-family: Arial, sans-serif;
            background: #ddd;
            font-size: 12px;
            font-weight: normal;
            padding: 5px;
            border-style: solid;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
        }
        .inti .inti-yw4l {
            vertical-align: top
        }
        h1 {
            text-align: center;
            font-size: 14px;
            margin: 2px;
        }
        h2 {
            text-align: center;
            font-size: 12px;
            margin: 2px;
        }
        body{
            font-family: Arial;
        }
        .ttd {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
            border-spacing: 0;
        }
        .ttd td {
            font-family: Arial, sans-serif;
            font-size: 12px;
            overflow: hidden;
            word-break: normal;
        }
        .ttd .ttd-yw4l {
            vertical-align: top
        }
    </style>
</head>
<body>
    <h1>DAFTAR NOMINATIF</h1>
    <h2>PEMBAYARAN PERJALANAN DINAS KE DAERAH</h2>
    <table class="inti">
        <tr>
            <th class="inti-031e" rowspan="2">No</th>
            <th class="inti-031e" rowspan="2">NAMA</th>
            <th class="inti-031e" rowspan="2">GOL</th>
            <th class="inti-031e" rowspan="2">TUJUAN</th>
            <th class="inti-yw4l" rowspan="2" style="vertical-align: middle;">LAMANYA</th>
            <th class="inti-yw4l" colspan="7">RINCIAN BIAYA</th>
            <th class="inti-yw4l" rowspan="2" style="vertical-align: middle;">KETERANGAN</th>
        </tr>
        <tr>
            <th class="inti-yw4l">Pengeluaran Riil</th>
            <th class="inti-yw4l">TIKET</th>
            <th class="inti-yw4l">REPRESENTASI</th>
            <th class="inti-yw4l">AIRPORT TAX</th>
            <th class="inti-yw4l">UANG SAKU</th>
            <th class="inti-yw4l">PENGINAPAN</th>
            <th class="inti-yw4l">JUMLAH</th>
        </tr>
        @forelse($response['data'] as $k => $v)
        <tr>
            <td class="inti-031e">{{$k+1}}</td>
            <td class="inti-031e">{{$v->pegawai->nama}}</td>
            <td class="inti-031e">{{$v->pegawai->golongan}}</td>
            <td class="inti-031e">{{$v->tujuan_dinas}}</td>
            <td class="inti-yw4l">
                <?php
                    $sejak = Carbon::createFromFormat('Y-m-d H:i:s', $v->tanggal_awal);
                    $hingga = Carbon::createFromFormat('Y-m-d H:i:s', $v->tanggal_akhir);

                    echo $sejak->diffInDays($hingga)+1 . ' hari';
                ?>
            </td>
            <td class="inti-yw4l" style="text-align: right;">
                <?php
                    $riil = 0;
                    foreach ($v->pengeluaranRiil as $key => $value) {
                        $riil += $value->sub_total;
                    }
                    echo number_format($riil, 0, ',', '.');
                ?>
            </td>
            <td class="inti-yw4l" style="text-align: right;">
                <?php
                    $tiket = 0;
                    foreach ($v->pengeluaranTransport as $key => $value) {
                        if ($value->jenis == 'tiket_pp' OR $value->jenis == 'lainnya') {
                            $tiket += $value->sub_total;
                        }
                    }
                    echo number_format($tiket, 0, ',', '.');
                ?>
            </td>
            <td class="inti-yw4l" style="text-align: right;">
                <?php
                    $representatif = 0;
                    foreach ($v->pengeluaranRepresentatif as $key => $value) {
                        $representatif += $value->sub_total;
                    }
                    echo number_format($representatif, 0, ',', '.');
                ?>
            </td>
            <td class="inti-yw4l" style="text-align: right;">
                <?php
                    $airport_tax = 0;
                    foreach ($v->pengeluaranTransport as $key => $value) {
                        if ($value->jenis == 'airport_tax') {
                            $airport_tax += $value->sub_total;
                        }
                    }
                    echo number_format($airport_tax, 0, ',', '.');
                ?>
            </td>
            <td class="inti-yw4l" style="text-align: right;">
                <?php
                    $uang_saku = 0;
                    foreach ($v->pengeluaranLumpsum as $key => $value) {
                        $uang_saku += $value->sub_total;
                    }

                    foreach ($v->pengeluaranUangHarian as $key => $value) {
                        $uang_saku += $value->sub_total;
                    }
                    echo number_format($uang_saku, 0, ',', '.');
                ?>
            </td>
            <td class="inti-yw4l" style="text-align: right;">
                <?php
                    $penginapan = 0;
                    foreach ($v->pengeluaranPenginapan as $key => $value) {
                        $penginapan += $value->sub_total;
                    }
                    echo number_format($penginapan, 0, ',', '.');
                ?>
            </td>
            <td class="inti-yw4l" style="text-align: right;">
                <?php
                    $sub_total = $riil + $tiket + $representatif + $airport_tax + $uang_saku + $penginapan;
                    $total += $sub_total;
                    echo number_format($sub_total, 0, ',', '.');
                ?>
            </td>
            <td class="inti-yw4l">{{array_first($response['data'])->maksud}}</td>
        </tr>
        @empty
        <tr>
            <td class="inti-031e">1</td>
            <td class="inti-031e"></td>
            <td class="inti-031e"></td>
            <td class="inti-031e"></td>
            <td class="inti-yw4l"></td>
            <td class="inti-yw4l"></td>
            <td class="inti-yw4l"></td>
            <td class="inti-yw4l"></td>
            <td class="inti-yw4l"></td>
            <td class="inti-yw4l"></td>
            <td class="inti-yw4l"></td>
            <td class="inti-yw4l"></td>
            <td class="inti-yw4l"></td>
        </tr>
        @endforelse
        <tr>
            <td class="inti-031e" colspan="11" style="text-align: right;font-weight: bold;">Jumlah</td>
            <td class="inti-yw4l" style="text-align: right;font-weight: bold;">{{number_format($total, 0, ',', '.')}}</td>
            <td class="inti-yw4l"></td>
        </tr>
    </table>

    <table class="ttd">
        <tr>
            <td class="ttd-031e"></td>
            <td class="ttd-031e"></td>
            <td class="ttd-031e">Jakarta, Oktober 2016</td>
        </tr>
        <tr>
            <td class="ttd-031e"></td>
            <td class="ttd-031e"></td>
            <td class="ttd-031e">Pejabat Pembuat Komitmen Kegiatan</td>
        </tr>
        <tr>
            <td class="ttd-031e"></td>
            <td class="ttd-031e"></td>
            <td class="ttd-031e"></td>
        </tr>
        <tr>
            <td class="ttd-031e" style="font-weight: bold;"></td>
            <td class="ttd-031e"></td>
            <td class="ttd-031e" style="width: 35%; font-weight: bold;padding-top: 50px;">{{array_first($response['data'])->st->pagu->nm_ppk}}</td>
        </tr>
        <tr>
            <td class="ttd-yw4l"></td>
            <td class="ttd-yw4l"></td>
            <td class="ttd-yw4l" style="width: 35%">NIP. {{array_first($response['data'])->st->pagu->nip_ppk}}</td>
        </tr>
    </table>
</body>
</html>