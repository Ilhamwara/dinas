<html>
<head>
    <title>Surat Tugas</title>
    <style type="text/css">
        table tr td {
          font-size: 12px;
      }
  </style>
</head>
<body>


    <table class="" style="width: 100%">
        <tr>
            <th class="-031e"><img src="{{asset('assets/images/garuda-hitam-putih.jpg')}}" width="70"></th>
        </tr>
        <tr>
            <td class="-031e" style="text-align:center;font-size: large;font-family: Arial;font-weight: bold;">KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN</td>
        </tr>
        <tr>
            <td class="-031e" style="text-align:center;font-size: large;font-family: Arial;font-weight: bold;">REPUBLIK INDONESIA</td>
        </tr>
        <tr>
            <td class="-031e" style="text-align:center;font-size: large;font-family: Arial;font-weight: bold;">INSPEKTORAT</td>
        </tr>
        <tr>
            <td class="-031e" style="text-align: center;">Jl. Lapangan Banteng Timur No. 2-4 Jakarta 10710</td>
        </tr>
        <tr>
            <td class="-yw4l" style="text-align: center;border-bottom: 1px solid #000;padding-bottom: 10px;">Telpon 3456825 Fax. 3456825</td>
        </tr>
    </table>
    {{-- JUDUL --}}
    <table class="" style="width: 100%">
      <tr>
        <td class="-031e" style="text-align:center;font-size: x-large;font-family: Arial;font-weight: bold;padding-top: 20px;">SURAT TUGAS</td>
    </tr>
    <tr>
        <td class="-031e" style="text-align:center;font-size: large;font-family: Arial;">Nomor: {{$response['data']['no_st']}}</td>
    </tr>
</table>
<p style="text-align: justify;font-size: 14px;font-family: Arial;line-height: 2;">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang bertandatangan di bawah ini, menugaskan pegawai sebagaimana tersebut di bawah untuk melaksanakan perjalanan dinas terkait <strong>{{$response['data']['nama_kegiatan']}}</strong> mulai tanggal <strog>{{$response['data']['tanggal_awal']}}</strog> s.d <strong>{{$response['data']['tanggal_akhir']}}</strong>, bertempat di <strong>{{$response['data']['tujuan_dinas']}}</strong>. Adapun pegawai yang ditugaskan melaksanakan penugasan tersebut adalah:
</p>
<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;width: 100%}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg">
    <tr>
        <th class="tg-031e">NO.</th>
        <th class="tg-yw4l">Nama</th>
        <th class="tg-yw4l">NIP</th>
        <th class="tg-yw4l">GOL</th>
        <th class="tg-yw4l">Jabatan</th>
    </tr>
    @forelse($response['data']['peserta'] as $k => $v)
    <tr>
        <td class="tg-031e">{{$k+1}}</td>
        <td class="tg-yw4l">{{$v['nama']}}</td>
        <td class="tg-yw4l">{{$v['nip']}}</td>
        <td class="tg-yw4l">{{$v['golongan']}}</td>
        <td class="tg-yw4l">{{$v['jabatan']}}</td>
    </tr>
    @empty
    @endforelse
</table>

<p style="text-align: justify;font-size: 14px;font-family: Arial;line-height: 2;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian surat tugas ini dibuat untuk dilaksanakan dengan penuh rasa tanggungjawab. Atas perhatian dan kerjasamanya diucapkan terimakasih.
</p>

<table style="width: 100%;">
    <tr>
        <td style="width: 65%;"></td>
        <td>
            <div style="text-align: right;">
                <p style="text-align: justify;font-size: 14px;font-family: Arial;line-height: 1;">
                    Dikeluarkan di {{$response['data']['tempat_dikeluarkan_surat']}}
                    <br>
                    Pada tanggal {{$response['data']['tanggal_surat']}}
                    <br>
                    <br>
                    Inspektur,
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <strong>{{$response['data']['nama_inspektur']}}</strong>
                    <br>
                    NIP {{$response['data']['nip_inspektur']}}
                </p>
            </div>
        </td>
    </tr>
</table>
</body>
</html>