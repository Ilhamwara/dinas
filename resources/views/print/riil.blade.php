<!DOCTYPE html>
<html>
<head>
    <title>Rincian Biaya Perjalanan Dinas</title>

    <style type="text/css">
        body, table>tr>td {
            font-size: 12px;
            font-family: Arial, sans-serif;

        }

        .kepala {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        .kepala td {
            text-align: center;
            font-family: Arial, sans-serif;
            padding: 2px;
            overflow: hidden;
            word-break: normal;
        }
        .nomor-surat {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        .nomor-surat td {
            text-align: left;
            font-family: Arial, sans-serif;
            padding: 2px;
            overflow: hidden;
            word-break: normal;
        }

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

        .ttd {
            border-bottom: 1px solid #000;
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

        ol {
            list-style-type: lower-alpha;
            margin: 1px;
        }
        ol li {
            padding: 1px;
            padding-left: 0px;
        }
        .rampung {
            width: 100%;
            margin-top: 5px;
        }

        .rampung td {
            font-family: Arial, sans-serif;
            overflow: hidden;
            word-break: normal;
        }
        .rampung th {
            font-family: Arial, sans-serif;
            overflow: hidden;
            word-break: normal;
        }
        .rampung .rampung-yw4l {
            vertical-align: top
        }
    </style>
</head>

<body>

    <table class="kepala">
        <tr>
            <td class="kepala"  style="border-bottom: 1px double #000;padding-bottom: 10px;">
                KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN<br>
                REPUBLIK INDONESIA
            </td>
        </tr>
        <tr>
            <td style="padding-top: 20px;">DAFTAR PENGELUARAN RIIL</td>
        </tr>
    </table>

    <table class="nomor-surat" style="margin-top: 20px;">
        <tr>
            <td class="nomor-surat" style="width: 35%;">Yang bertandatangan di bawah ini</td>
            <td class="nomor-surat">:</td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="nomor-surat" style="width: 15%">Nama</td>
            <td class="nomor-surat" style="width: 2px;">:</td>
            <td class="nomor-surat" style="width: 94%;">{{$response['data']['spd']->pegawai->nama}}</td>
        </tr>
        <tr>
            <td class="nomor-surat" style="width: 15%">NIP</td>
            <td class="nomor-surat" style="width: 2px;">:</td>
            <td class="nomor-surat" style="width: 94%;">
                {{$response['data']['spd']->pegawai->nip}}
                {{-- {{\App\Library\Datify::readify(substr($response['data']['spd']->tanggal_spd, 0, 10))}} --}}
            </td>
        </tr>
        <tr>
            <td class="nomor-surat" style="width: 15%">Jabatan</td>
            <td class="nomor-surat" style="width: 2px;">:</td>
            <td class="nomor-surat" style="width: 94%;">{{$response['data']['spd']->pegawai->jabatan}}</td>
        </tr>
    </table>
    <table style="margin-top: 20px;">
        <tr>
            <td>
                Berdasar Surat Perjalanan Dinas (SPD) Nomor: {{$response['data']['spd']->no_spd}} Pejabat Pembuat Komitmen Kegiatan tanggal {{\App\Library\Datify::readify(substr($response['data']['spd']->tanggal_spd, 0, 10))}} dengan ini kami menyatakan dengan sesungguhnya bahwa:
            </td>
        </tr>
    </table>
    <table style="margin-top: 10px;">
        <tr>
            <td>1.</td>
            <td>Biaya Transport pegawai dan/atau biaya penginapan di bawah ini yang tidak dapat diperoleh bukti-bukti pengeluarannya, meliputi:</td>
        </tr>
    </table>

    <table class="inti" style="margin-top: 20px;">
        <tr>
            <th class="inti-031e" style="width: 2%;">No</th>
            <th class="inti-031e" style="">Uraian</th>
            <th class="inti-031e" style="width: 30%;">Jumlah</th>
        </tr>
        <?php $total = 0; ?>
        @forelse($response['data']['spd']->pengeluaranRiil as $k => $v)
            <?php $total += $v->sub_total;?>
            <tr>
                <td class="inti-031e" style="width: 2%;">{{($k+1)}}</td>
                @if($v->jenis == 'Biaya Riil Penginapan')
                    <td class="inti-031e" style="">{{$v->jenis}} 0.3 x {{$v->qty}} x {{number_format($v->ref_max / 0.3, 0, ',', '.')}}</td>
                @else
                    <td class="inti-031e" style="">{{$v->jenis}}</td>
                @endif
                <td class="inti-031e" style="width: 30%;text-align: right;">{{number_format($v->sub_total, 0, ',', '.')}}</td>
            </tr>
        @empty
        @endforelse

        <tr>
            <th class="inti-031e" colspan="2" style="text-align: right;font-weight: bold;">Jumlah</th>
            <th class="inti-031e" style="width: 30%;text-align: right;font-weight: bold;">Rp. {{number_format($total, 0, ',', '.')}}</th>
        </tr>
    </table>
    <table style="margin-top: 20px;">
        <tr>
            <td>2.</td>
            <td>Jumlah uang tersebut pada angka 1 di atas benar-benar dikeluarkan untuk pelaksanaan perjalanan dinas dimaksud dan apabila di kemudian hari terdapat kelebihan atas pembayaran, kami bersedia untuk menyetor kelebihan tersebut ke Kas Negara.</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Demikian pernyataan ini kami buat dengan sebenarnya, uhntuk dipergunakan sebagaimana mestinya.</td>
        </tr>
    </table>

    <table style="width: 100%;margin-top: 20px;">
        <tr>
            <td>Mengetahui</td>
            <td></td>
            <td style="width: 30%;">Jakarta</td>
        </tr>
        <tr>
            <td>Pejabat Pembuat Komitmen</td>
            <td></td>
            <td style="width: 30%;">Pejabat Negawa/Pegawai</td>
        </tr>
        <tr>
            <td>Kegiatan</td>
            <td></td>
            <td style="width: 30%;">yang melakukan perjalanan dinas</td>
        </tr>
        <tr>
            <td style="font-weight: bold; padding-top: 50px;">{{$response['data']['spd']->st->pagu->nm_ppk}}</td>
            <td></td>
            <td style="font-weight: bold; width: 30%; padding-top: 50px;">{{$response['data']['spd']->pegawai->nama}}</td>
        </tr>
        <tr>
            <td style="">NIP. {{$response['data']['spd']->st->pagu->nip_ppk}}</td>
            <td></td>
            <td style="width: 30%;">NIP. {{$response['data']['spd']->pegawai->nip}}</td>
        </tr>
    </table>
</body>
</html>  