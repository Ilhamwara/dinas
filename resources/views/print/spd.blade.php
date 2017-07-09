<!DOCTYPE html>
<html>
    <head>
        <title>Cetak SPD</title>
        <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{font-family:Arial, sans-serif;font-size:12px;padding:5px;overflow:hidden;word-break:normal;}
        .tg th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:5px;overflow:hidden;word-break:normal;}
        .tg .tg-yw4l{vertical-align:middle;}
        
        .main  {border-collapse:collapse;border-spacing:0;width: 100%;}
        .main td{font-family:Arial, sans-serif;font-size:12px;padding:5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
        .main th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
        .main .main-yw4l{vertical-align:top}

        .ttd  {border-collapse:collapse;border-spacing:0;float: right;}
        .ttd td{font-family:Arial, sans-serif;font-size:12px;padding:5px;overflow:hidden;word-break:normal;}
        .ttd th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:5px;overflow:hidden;word-break:normal;}
        .ttd .ttd-yw4l{vertical-align:top}
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>


    <table class="tg">
        <tr>
            <td class="tg-031e">Lembar Ke</td>
            <td class="tg-031e">: 1</td>
            <td class="tg-031e"></td>
        </tr>
        <tr>
            <td class="tg-031e">Kode No</td>
            <td class="tg-031e">:</td>
            <td class="tg-031e"></td>
        </tr>
        <tr>
            <td class="tg-yw4l">Nomor</td>
            <td class="tg-031e">:</td>
            <td class="tg-yw4l">{{$spd->no_spd}}</td>
        </tr>
    </table>

    <h5 style="text-align: center;margin: 10px;">Surat Perjalanan Dinas (SPD)</h5>


    <table class="main">
        <tr>
            <td class="main-031e" style="text-align: center;width: 10px;">1</td>
            <td class="main-031e">Pejabat berwenang yang memberikan perintah</td>
            <td class="main-yw4l" colspan="2">Pejabat Pembuat Komitmen Kegiatan</td>
        </tr>
        <tr>
            <td class="main-yw4l" style="text-align: center;width: 10px;">2</td>
            <td class="main-yw4l">Nama Pegawai yang diperintahkann</td>
            <td class="main-yw4l" colspan="2">{{$spd->nama_pegawai . ' - ' . $spd->nip}}</td>
        </tr>
        <tr>
            <td class="main-031e" style="text-align: center;width: 10px;">3</td>
            <td class="main-031e">a. Pangkat/Gol<br>b. Jabatan dan Instansi<br>c. Tingkat Biaya Perjalanan Dinas</td>
            <td class="main-yw4l" colspan="2">
                a. {{$spd->pegawai->golongan.' / '.$spd->pegawai->pangkat}}<br>
                b. {{$spd->jabatan}}<br>
                c. {{$spd->tingkat_biaya}}
            </td>
        </tr>
        <tr>
            <td class="main-031e" style="text-align: center;width: 10px;">4</td>
            <td class="main-031e">Maksud Perjalanan Dinas</td>
            <td class="main-yw4l" colspan="2">{{$spd->st->kegiatan->nama_kegiatan}}</td>
        </tr>
        <tr>
            <td class="main-yw4l" style="text-align: center;width: 10px;">5</td>
            <td class="main-yw4l">Alat angkutan yang dipergunakan</td>
            <td class="main-yw4l" colspan="2">{{$spd->tipe_transport}}</td>
        </tr>
        <tr>
            <td class="main-yw4l" style="text-align: center;width: 10px;">6</td>
            <td class="main-yw4l">a. Tempat Berangkat<br>b. Tempat Tujuan</td>
            <td class="main-yw4l" colspan="2">
                a. {{$spd->asal}}<br>
                b. {{$spd->tujuan_dinas}}
            </td>
        </tr>
        <tr>
            <td class="main-yw4l" style="text-align: center;width: 10px;">7</td>
            <td class="main-yw4l">a. Lamanya perjalanan dinas<br>b. Tanggal Berangkat<br>c. Tanggal harus kembali</td>
            <td class="main-yw4l" colspan="2">
                a. {{$spd->durasi}}<br>
                b. {{\App\Library\Datify::readify(substr($spd->tanggal_awal, 0, 10))}}<br>
                c. {{\App\Library\Datify::readify(substr($spd->tanggal_akhir, 0, 10))}}
            </td>
        </tr>
        <tr>
            <td class="main-yw4l" style="text-align: center;width: 10px;">8</td>
            <td class="main-yw4l">Pengikut: Nama<br>1.<br>2.</td>
            <td class="main-yw4l">Tanggal Lahir</td>
            <td class="main-yw4l">Keterangan</td>
        </tr>
        <tr>
            <td class="main-yw4l" style="text-align: center;width: 10px;">9</td>
            <td class="main-yw4l">Pembebanan anggaran:<br>a. Instansi<br>b. Akun</td>
            <td class="main-yw4l" colspan="2">
                {{$spd->st->pagu->tahun}}<br>
                a. Kemenko Bid. Perekonomian<br>
                b. {{$spd->st->pagu->akun}}
            </td>
        </tr>
        <tr>
            <td class="main-yw4l" style="text-align: center;width: 10px;">10</td>
            <td class="main-yw4l">Keterangan lain-lain</td>
            <td class="main-yw4l" colspan="2">{{$spd->keterangan}}</td>
        </tr>
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
            <td class="ttd-yw4l">{{$spd->tempat_dikeluarkan_surat}}</td>
        </tr>
        <tr>
            <td class="ttd-031e">Pada Tanggal</td>
            <td class="ttd-031e">:</td>
            <td class="ttd-yw4l">{{\App\Library\Datify::readify(substr($spd->tanggal_spd, 0, 10))}}</td>
        </tr>
        <tr>
            <td class="ttd-031e" colspan="3">Pejabat Pembuat Komitmen Kegiatan</td>
        </tr>
        <tr>
            <td class="ttd-031e" colspan="3" style="padding-top: 72px;font-weight: bold;">
                <strong style="text-decoration: underline;">
                    {{$spd->nama_ppk}}
                </strong>
            </td>
        </tr>
        <tr>
            <td class="ttd-031e" colspan="3" style="padding-top: 0;">
                NIP. {{$spd->nip_ppk}}
            </td>
        </tr>
    </table>

    <div class="page-break"></div>

    <table class="" style="width: 100%">
        <tr>
            <th class="-031e"><img src="{{asset('assets/images/garuda-hitam-putih.jpg')}}" width="50"></th>
        </tr>
        <tr>
            <td class="-031e" style="text-align:center;font-family: Arial;font-weight: bold;">KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN</td>
        </tr>
        <tr>
            <td class="-031e" style="text-align:center;font-family: Arial;font-weight: bold;">REPUBLIK INDONESIA</td>
        </tr>
        <tr>
            <td class="-031e" style="text-align:center;font-family: Arial;font-weight: bold;">-2-</td>
        </tr>
    </table>

    
    <style type="text/css">
        .tm {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #000;
        }
        .tm td {
            font-family: Arial, sans-serif;
            font-size: 11px;
            padding: 1px 3px;
            border-width: 1px;
            overflow: hidden;
            word-break: normal;
        }
        .tm th {
            font-family: Arial, sans-serif;
            font-size: 11px;
            font-weight: normal;
            padding: 1px 3px;
            overflow: hidden;
            word-break: normal;
            vertical-align: top;
            font-weight: bold;
        }
        .tm .tm-yw4l {
            vertical-align: top
        }
    </style>
    <table class="tm">
        <tr>
            <td class="tm-031e" colspan="4" rowspan="6"></td>
            <th class="tm-031e" rowspan="6">I.</th>
            <td class="tm-yw4l">Berangkat dari</td>
            <td class="tm-yw4l">:</td>
            <td class="tm-yw4l">Tempat kedudukan</td>
        </tr>
        <tr>
            <td class="tm-yw4l">Ke</td>
            <td class="tm-yw4l">:</td>
            <td class="tm-yw4l">{{$spd->tujuan_dinas}}</td>
        </tr>
        <tr>
            <td class="tm-yw4l">Pada Tanggal</td>
            <td class="tm-yw4l">:</td>
            <td class="tm-yw4l">{{\App\Library\Datify::readify(substr($spd->tanggal_akhir, 0, 10))}}</td>
        </tr>
        <tr>
            <td class="tm-yw4l" colspan="3">Pejabat Pembuat Komitmen</td>
        </tr>
        <tr>
            <td class="tm-yw4l" colspan="3" style="padding-top: 20px;">{{$spd->nama_ppk}}</td>
        </tr>
        <tr>
            <td class="tm-yw4l" colspan="3">NIP. {{$spd->nip_ppk}}</td>
        </tr>
        <tr>
            <th class="tm-031e"  style="border-top: 1px solid #000;"  rowspan="6">II.</th>
            <td class="tm-031e"  style="border-top: 1px solid #000;" >Tiba di</td>
            <td class="tm-031e"  style="border-top: 1px solid #000;" >:</td>
            <td class="tm-yw4l"  style="border-top: 1px solid #000;" ></td>
            <td class="tm-031e"  style="border-top: 1px solid #000;"  rowspan="6"></td>
            <td class="tm-yw4l"  style="border-top: 1px solid #000;" >Berangkat dari</td>
            <td class="tm-yw4l"  style="border-top: 1px solid #000;" >:</td>
            <td class="tm-yw4l"  style="border-top: 1px solid #000;" ></td>
        </tr>
        <tr>
            <td class="tm-031e" rowspan="2">Pada Tanggal</td>
            <td class="tm-031e" rowspan="2">:</td>
            <td class="tm-yw4l" rowspan="2"></td>
            <td class="tm-yw4l">Ke</td>
            <td class="tm-yw4l">:</td>
            <td class="tm-yw4l"></td>
        </tr>
        <tr>
            <td class="tm-yw4l">Pada Tanggal</td>
            <td class="tm-yw4l">:</td>
            <td class="tm-yw4l"></td>
        </tr>
        <tr>
            <td class="tm-031e" colspan="3">Kepala</td>
            <td class="tm-yw4l" colspan="3">Kepala</td>
        </tr>
        <tr>
            <td class="tm-031e" colspan="3" style="padding-top: 20px;">.........................................</td>
            <td class="tm-yw4l" colspan="3" style="padding-top: 20px;">.........................................</td>
        </tr>
        <tr>
            <td class="tm-yw4l" colspan="3">NIP.</td>
            <td class="tm-yw4l" colspan="3">NIP.</td>
        </tr>
        <tr>
            <th class="tm-031e" style="border-top: 1px solid #000;"  rowspan="6">III.</th>
            <td class="tm-031e" style="border-top: 1px solid #000;" >Tiba di</td>
            <td class="tm-031e" style="border-top: 1px solid #000;" >:</td>
            <td class="tm-yw4l" style="border-top: 1px solid #000;" ></td>
            <td class="tm-031e" style="border-top: 1px solid #000;"  rowspan="6"></td>
            <td class="tm-yw4l" style="border-top: 1px solid #000;" >Berangkat dari</td>
            <td class="tm-yw4l" style="border-top: 1px solid #000;" >:</td>
            <td class="tm-yw4l" style="border-top: 1px solid #000;" ></td>
        </tr>
        <tr>
            <td class="tm-031e" rowspan="2">Pada Tanggal</td>
            <td class="tm-031e" rowspan="2">:</td>
            <td class="tm-yw4l" rowspan="2"></td>
            <td class="tm-yw4l">Ke</td>
            <td class="tm-yw4l">:</td>
            <td class="tm-yw4l"></td>
        </tr>
        <tr>
            <td class="tm-yw4l">Pada Tanggal</td>
            <td class="tm-yw4l">:</td>
            <td class="tm-yw4l"></td>
        </tr>
        <tr>
            <td class="tm-031e" colspan="3">Kepala</td>
            <td class="tm-yw4l" colspan="3">Kepala</td>
        </tr>
        <tr>
            <td class="tm-031e" colspan="3" style="padding-top: 20px;">.........................................</td>
            <td class="tm-yw4l" colspan="3" style="padding-top: 20px;">.........................................</td>
        </tr>
        <tr>
            <td class="tm-yw4l" colspan="3">NIP.</td>
            <td class="tm-yw4l" colspan="3">NIP.</td>
        </tr>
        <tr>
            <th class="tm-031e" style="border-top: 1px solid #000;"  rowspan="6">IV.</th>
            <td class="tm-031e" style="border-top: 1px solid #000;" >Tiba di</td>
            <td class="tm-031e" style="border-top: 1px solid #000;" >:</td>
            <td class="tm-yw4l" style="border-top: 1px solid #000;" ></td>
            <td class="tm-031e" style="border-top: 1px solid #000;"  rowspan="6"></td>
            <td class="tm-yw4l" style="border-top: 1px solid #000;" >Berangkat dari</td>
            <td class="tm-yw4l" style="border-top: 1px solid #000;" >:</td>
            <td class="tm-yw4l" style="border-top: 1px solid #000;" ></td>
        </tr>
        <tr>
            <td class="tm-031e" rowspan="2">Pada Tanggal</td>
            <td class="tm-031e" rowspan="2">:</td>
            <td class="tm-yw4l" rowspan="2"></td>
            <td class="tm-yw4l">Ke</td>
            <td class="tm-yw4l">:</td>
            <td class="tm-yw4l"></td>
        </tr>
        <tr>
            <td class="tm-yw4l">Pada Tanggal</td>
            <td class="tm-yw4l">:</td>
            <td class="tm-yw4l"></td>
        </tr>
        <tr>
            <td class="tm-031e" colspan="3">Kepala</td>
            <td class="tm-yw4l" colspan="3">Kepala</td>
        </tr>
        <tr>
            <td class="tm-031e" colspan="3" style="padding-top: 20px;">.........................................</td>
            <td class="tm-yw4l" colspan="3" style="padding-top: 20px;">.........................................</td>
        </tr>
        <tr>
            <td class="tm-yw4l" colspan="3">NIP.</td>
            <td class="tm-yw4l" colspan="3">NIP.</td>
        </tr>
        <tr>
            <th class="tm-031e" style="border-top: 1px solid #000;"  rowspan="6">V.</th>
            <td class="tm-031e" style="border-top: 1px solid #000;" >Tiba di</td>
            <td class="tm-031e" style="border-top: 1px solid #000;" >:</td>
            <td class="tm-yw4l" style="border-top: 1px solid #000;" ></td>
            <td class="tm-031e" style="border-top: 1px solid #000;"  rowspan="6"></td>
            <td class="tm-yw4l" style="border-top: 1px solid #000;" >Berangkat dari</td>
            <td class="tm-yw4l" style="border-top: 1px solid #000;" >:</td>
            <td class="tm-yw4l" style="border-top: 1px solid #000;" ></td>
        </tr>
        <tr>
            <td class="tm-031e" rowspan="2">Pada Tanggal</td>
            <td class="tm-031e" rowspan="2">:</td>
            <td class="tm-yw4l" rowspan="2"></td>
            <td class="tm-yw4l">Ke</td>
            <td class="tm-yw4l">:</td>
            <td class="tm-yw4l"></td>
        </tr>
        <tr>
            <td class="tm-yw4l">Pada Tanggal</td>
            <td class="tm-yw4l">:</td>
            <td class="tm-yw4l"></td>
        </tr>
        <tr>
            <td class="tm-031e" colspan="3">Kepala</td>
            <td class="tm-yw4l" colspan="3">Kepala</td>
        </tr>
        <tr>
            <td class="tm-yw4l" colspan="3" style="padding-top: 20px;">.........................................</td>
            <td class="tm-yw4l" colspan="3" style="padding-top: 20px;">.........................................</td>
        </tr>
        <tr>
            <td class="tm-yw4l" colspan="3">NIP.</td>
            <td class="tm-yw4l" colspan="3">NIP.</td>
        </tr>
        <tr>
            <th style="border-top: 1px solid #000;"  rowspan="6">VI.</th>
            <td style="border-top: 1px solid #000;" >Tiba di</td>
            <td style="border-top: 1px solid #000;" >:</td>
            <td style="border-top: 1px solid #000;text-align:left;" >Tempat Kedudukan</td>
            <td style="border-top: 1px solid #000;"  rowspan="6"></td>
            <td style="border-top: 1px solid #000;"  colspan="3" rowspan="3">Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.</td>
        </tr>
        <tr>
            <td rowspan="2">Pada Tanggal</td>
            <td rowspan="2">:</td>
            <td rowspan="2">{{\App\Library\Datify::readify(substr($spd->tanggal_akhir, 0, 10))}}</td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td colspan="3">Pejabat Pembuat Komitmen</td>
            <td colspan="3">Pejabat Pembuat Komitmen</td>
        </tr>
        <tr>
            <td colspan="3" style="padding-top: 20px;">{{$spd->nama_ppk}}</td>
            <td colspan="3" style="padding-top: 20px;">.........................................</td>
        </tr>
        <tr>
            <td colspan="3">NIP. {{$spd->nip_ppk}}</td>
            <td colspan="3">NIP.</td>
        </tr>
        <tr>
            <th>VII.</th>
            <td colspan="7">Catatan Lain-lain</td>
        </tr>
        <tr>
            <th style="border-top: 1px solid #000;" >VIII.</th>
            <td style="border-top: 1px solid #000;"  colspan="7">PERHATIAN:<br>PPK yang menerbitkan SPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba, serta bendahara pengeluaran bertanggungjawab berdasarkan Peraturan Keuangan Negara apabila negara menderita rugi akibat kesalahan, kelalaian, dan kealpaannya.</td>
        </tr>
    </table>
<script type="text/javascript">
    window.onload(print());
</script>
</body>
</html>

