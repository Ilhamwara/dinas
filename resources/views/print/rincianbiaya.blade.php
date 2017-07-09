<!DOCTYPE html>
<html>
<head>
    <title>Rincian Biaya Perjalanan Dinas</title>

    <style type="text/css">
        body {
            font-size: 12px;
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
            <td class="kepala">KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN REPUBLIK INDONESIA</td>
        </tr>
        <tr>
            <td class="kepala" style="font-size: 16px;">RINCIAN BIAYA PERJALANAN DINAS</td>
        </tr>
    </table>

    <table class="nomor-surat">
        <tr>
            <td class="nomor-surat" style="width: 15%">Lampiran SPPD Nomor</td>
            <td class="nomor-surat" style="width: 2px;">:</td>
            <td class="nomor-surat" style="width: 94%;">{{$response['data']['spd']->no_spd}}</td>
        </tr>
        <tr>
            <td class="nomor-surat" style="width: 15%">Tanggal</td>
            <td class="nomor-surat" style="width: 2px;">:</td>
            <td class="nomor-surat" style="width: 94%;">{{\App\Library\Datify::readify(substr($response['data']['spd']->tanggal_spd, 0, 10))}}</td>
        </tr>
        <tr>
            <td class="nomor-surat" colspan="3" style="font-size: 14px;text-align: center;">PERINCIAN PERHITUNGAN BIAYA PERJALANAN DINAS</td>
        </tr>
    </table>

    <table class="inti">
        <tr>
            <th class="inti-031e" style="width: 2%;">No</th>
            <th class="inti-031e" style="width: 38%;">Perincian Biaya</th>
            <th class="inti-031e" style="width: 30%;">Jumlah</th>
            <th class="inti-yw4l" style="width: 30%;">Keterangan</th>
        </tr>
        <tr>
            <td class="inti-031e" style="width: 2%;">1.</td>
            <td class="inti-031e" style="width: 38%;">
                {{(count($response['data']['spd']->pengeluaranLumpsum) > 0) ?
                    'Uang Harian Biasa: ' . array_first($response['data']['spd']->pengeluaranLumpsum)->qty . ' x ' . number_format(array_first($response['data']['spd']->pengeluaranLumpsum)->ref_max, 0, ',', '.')
                :
                    'Uang Harian Biasa 0'
                }}
            </td>
            <td class="inti-031e" style="width: 30%;text-align: right;">
                {{(count($response['data']['spd']->pengeluaranLumpsum) > 0) ? number_format(array_first($response['data']['spd']->pengeluaranLumpsum)->sub_total, 0, ',', '.') : '0'}}
            </td>
            <td class="inti-yw4l" style="width: 30%;"></td>
        </tr>
        <tr>
            <td class="inti-yw4l" style="width: 2%;">2.</td>
            <td class="inti-yw4l" style="width: 38%;">
                @if(count($response['data']['spd']->pengeluaranUangHarian) > 0)
                    {{array_first($response['data']['spd']->pengeluaranUangHarian)->jenis_referensi}}:  {{array_first($response['data']['spd']->pengeluaranUangHarian)->qty}} x {{number_format(array_first($response['data']['spd']->pengeluaranUangHarian)->ref_max, 0, ',', '.')}}
                @else
                    Uang Harian Rapat/Diklat: 0
                @endif
            </td>
            <td class="inti-yw4l" style="width: 30%;text-align: right;">
                {{(count($response['data']['spd']->pengeluaranUangHarian) > 0) ? number_format(array_first($response['data']['spd']->pengeluaranUangHarian)->sub_total, 0, ',', '.') : '0'}}
            </td>
            <td class="inti-yw4l" style="width: 30%;"></td>
        </tr>
        <tr>
            <td class="inti-yw4l" style="width: 2%;">3.</td>
            <td class="inti-yw4l" style="width: 38%;">
                Biaya Transport
                <ol>
                    <?php $sub_total_transport = 0;?>
                    @forelse($response['data']['spd']->pengeluaranTransport as $k => $v)
                        <li> {{ucwords((str_replace('_', ' ', $v->jenis)))}}: {{number_format($v->sub_total, 0, ',', '.')}} </li>
                        <?php $sub_total_transport += $v->sub_total; ?>
                        @empty
                        <li>Biaya Transport 0</li>
                    @endforelse
                    
                    {{-- REPRESENTASI --}}
                    @if(count($response['data']['spd']->pengeluaranRepresentasi) > 0)
                        <li> Representasi: {{array_first($response['data']['spd']->pengeluaranRepresentasi)->qty}} x {{number_format(array_first($response['data']['spd']->pengeluaranRepresentasi)->ref_max, 0, ',', '.')}}</li>
                        <?php $sub_total_transport +=  array_first($response['data']['spd']->pengeluaranRepresentasi)->sub_total; ?>
                    @else
                        <li>Biaya Representasi: 0</li>
                    @endif
                </ol>
            </td>
            <td class="inti-yw4l" style="width: 30%;text-align: right;">
                {{number_format($sub_total_transport, 0, ',', '.')}}
            </td>
            <td class="inti-yw4l" style="width: 30%;"></td>
        </tr>
        <tr>
            <td class="inti-yw4l" style="width: 2%;">4.</td>
            <td class="inti-yw4l" style="width: 38%;">
                Biaya Penginapan
                <ol>
                    <?php $sub_total_penginapan = 0;?>
                    @forelse($response['data']['spd']->pengeluaranPenginapan as $k => $v)
                        <li> {{$v->qty}} x {{number_format($v->harga_satuan, 0, ',', '.')}} </li>
                        <?php $sub_total_penginapan += $v->sub_total; ?>
                        @empty
                        <li> Biaya Penginapan 0 </li>
                    @endforelse
                </ol>
            </td>
            <td class="inti-yw4l" style="width: 30%;text-align: right;">
                {{number_format($sub_total_penginapan, 0, ',', '.')}}
            </td>
            <td class="inti-yw4l" style="width: 30%;"></td>
        </tr>
        <tr>
            <td class="inti-yw4l" style="width: 2%;">5.</td>
            <td class="inti-yw4l" style="width: 38%;">
                Pengeluaran Riil
                <ol>
                     <?php $sub_total_riil = 0;?>
                    @forelse($response['data']['spd']->pengeluaranRiil as $k => $v)
                        @if($v->jenis == 'Biaya Riil Penginapan')
                            <li> {{$v->jenis . ' ' . $v->qty . ' x ' . number_format($v->harga_satuan, 0, ',', '.') . ' = ' . number_format($v->sub_total, 0, ',', '.')}} </li>
                        @else
                            <li> {{$v->jenis . ' ' . $v->sub_total}} </li>
                        @endif
                        <?php $sub_total_riil += $v->sub_total; ?>
                    @empty
                        <li> Pengeluaran Riil 0 </li>
                    @endforelse
                </ol>
            </td>
            <td class="inti-yw4l" style="width: 30%;text-align: right;">
                {{number_format($sub_total_riil, 0, ',', '.')}}
            </td>
            <td class="inti-yw4l" style="width: 30%;"></td>
        </tr>
        <tr>
            <td class="inti-yw4l" colspan="2" style="text-align: right;font-weight: bold;">JUMLAH</td>
            <td class="inti-yw4l" style="width: 30%;text-align: right;font-weight: bold;">
                <?php 
                    $sub_total_lumpsum = (count($response['data']['spd']->pengeluaranLumpsum) > 0) ? array_first($response['data']['spd']->pengeluaranLumpsum)->sub_total : 0;
                    $sub_total_harian = (count($response['data']['spd']->pengeluaranUangHarian) > 0) ? array_first($response['data']['spd']->pengeluaranUangHarian)->sub_total : 0;
                    $total = $sub_total_lumpsum + $sub_total_harian + $sub_total_transport + $sub_total_penginapan + $sub_total_riil;
                    echo 'Rp. ' . number_format($total, 0, ',', '.');
                ?>
            </td>
            <td class="inti-yw4l" style="width: 30%;"></td>
        </tr>
        <tr>
            <td class="inti-yw4l" colspan="4" style="background: #ddd;">Terbilang: {{strtoupper(\App\Library\Terbilang::terbilangg($total))}}</td>
        </tr>
    </table>

    <table class="ttd">
        <tr>
            <td class="ttd-031e" style="width: 30%"></td>
            <td class="ttd-031e" style=""></td>
            <td class="ttd-031e" style="width: 35%">Jakarta</td>
        </tr>
        <tr>
            <td class="ttd-031e" style="width: 30%">Telah dibayar sejumlah</td>
            <td class="ttd-031e" style=""></td>
            <td class="ttd-031e" style="width: 35%">Telah diterima jumlah uang</td>
        </tr>
        <tr>
            <td class="ttd-031e" style="width: 30%; font-weight: bolder;">{{'Rp. ' . number_format($total, 0, ',', '.')}}</td>
            <td class="ttd-031e" style=""></td>
            <td class="ttd-031e" style="width: 35%; font-weight: bolder;">{{'Rp. ' . number_format($total, 0, ',', '.')}}</td>
        </tr>
        <tr>
            <td class="ttd-yw4l" style="width: 30%;"></td>
            <td class="ttd-yw4l" style=";"></td>
            <td class="ttd-yw4l" style="width: 35%;"></td>
        </tr>
        <tr>
            <td class="ttd-031e" style="width: 30%; padding-top: 5px;">Bendahara Pengeluaran Pembantu</td>
            <td class="ttd-031e" style=""></td>
            <td class="ttd-031e" style="width: 35%; padding-top: 5px;">Yang Menerima</td>
        </tr>
        <tr>
            <td class="ttd-031e" style="width: 30%; padding-top: 50px;font-weight: bold;">{{$response['data']['spd']->st->pagu->nm_bendahara}}</td>
            <td class="ttd-031e" style=""></td>
            <td class="ttd-031e" style="width: 35%; padding-top: 50px; font-weight: bold;">{{$response['data']['spd']->pegawai->nama}}</td>
        </tr>
        <tr>
            <td class="ttd-031e" style="width: 30%; padding-bottom: 5px;">NIP. {{$response['data']['spd']->st->pagu->nip_bendahara}}</td>
            <td class="ttd-031e" style="; padding-bottom: 5px;"></td>
            <td class="ttd-031e" style="width: 35%; padding-bottom: 5px;">NIP. {{$response['data']['spd']->pegawai->nip}}</td>
        </tr>
    </table>


    <table class="rampung">
        <tr>
            <th class="rampung-031e" colspan="4">PERHITUNGAN SPPD RAMPUNG</th>
        </tr>
        <tr>
            <td class="rampung-031e" style="width: 25%;">Ditetapkan sejumlah</td>
            <td class="rampung-031e" style="width: 1%;">:</td>
            <td class="rampung-031e" style="font-weight: bolder;">{{'Rp. ' . number_format($total, 0, ',', '.')}}</td>
            <td class="rampung-yw4l" style="width:35%;"></td>
        </tr>
        <tr>
            <td class="rampung-031e" style="width: 12%;">Yang telah dibayar semula</td>
            <td class="rampung-031e" style="width: 1%;">:</td>
            <td class="rampung-031e" style=""></td>
            <td class="rampung-yw4l" style="width:35%;"></td>
        </tr>
        <tr>
            <td class="rampung-031e" style="width: 12%;">Sisa kurang/lebih</td>
            <td class="rampung-031e" style="width: 1%;">:</td>
            <td class="rampung-031e" style=""></td>
            <td class="rampung-yw4l" style="width:35%;"></td>
        </tr>
        <tr>
            <td class="rampung-031e" style="width: 12%;"></td>
            <td class="rampung-031e" style="width: 1%;"></td>
            <td class="rampung-031e" style=""></td>
            <td class="rampung-yw4l" style="width:35%;">an. Kuasa Pengguna Anggaran</td>
        </tr>
        <tr>
            <td class="rampung-031e" style="width: 12%;"></td>
            <td class="rampung-031e" style="width: 1%;"></td>
            <td class="rampung-031e" style=""></td>
            <td class="rampung-yw4l" style="width:35%;">Pejabat Pembuat Komitmen Kegiatan {{$response['data']['spd']->st->pagu->kegiatan}}</td>
        </tr>
        <tr>
            <td class="rampung-031e" style="width: 12%;"></td>
            <td class="rampung-031e" style="width: 1%;"></td>
            <td class="rampung-031e" style=""></td>
            <td class="rampung-yw4l" style="width:35%;font-weight: bold;padding-top: 50px;">{{$response['data']['spd']->st->pagu->nm_ppk}}</td>
        </tr>
        <tr>
            <td class="rampung-yw4l" style="width: 12%;"></td>
            <td class="rampung-yw4l" style="width: 1%;"></td>
            <td class="rampung-yw4l" style=""></td>
            <td class="rampung-yw4l" style="width:35%;">NIP. {{$response['data']['spd']->st->pagu->nip_ppk}}</td>
        </tr>
    </table>
</body>
</html>