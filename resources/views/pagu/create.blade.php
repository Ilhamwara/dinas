@extends('layouts.master')

@section('css')

@endsection

@section('head_title', 'Tambah Pagu')


@section('title')
Tambah Pagu
@endsection

@section('breadcrumb')
<li>
    <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a>
</li>
<li>
    <a href="{{url('pagu')}}"><i class="fa fa-legal"></i> &nbsp;Data Pagu</a>
</li>
<li class="active">
    Tambah Pagu
</li>
@endsection

@section('content')

@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<div class="col-lg-12">
    <section class="box">
        <div class="content-body">
            <form role="form" method="post" action="" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-md-2">Tahun</label>
                    <div class="col-md-4">
                        <select name="tahun" class="form-control" id="tahun" required>
                            @for($i = date('Y'); $i < date('Y') + 4; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Anak Satker</label>
                    <div class="col-md-4">
                        <select name="anak_satker" class="form-control" id="anak_satker" required>
                            <option value>Pilih Kode Anak Satker</option>
                            @forelse($anak_satker as $k => $v)
                                <option value="{{$v->id}}" data-nama_ppk="{{$v->nama_ppk}}" data-nip_ppk="{{$v->nip_ppk}}" data-nama_bendahara="{{$v->nama_bendahara}}" data-nip_bendahara="{{$v->nip_bendahara}}">{{$v->kode}}</option>
                            @empty
                                <option value>Belum ada anak satker</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">PPK</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Nama</span>
                            <input type="text" class="form-control" name="nama_ppk" placeholder="Nama" aria-describedby="basic-addon1" readonly required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">NIP</span>
                            <input type="text" class="form-control" name="nip_ppk" placeholder="NIP" aria-describedby="basic-addon1" readonly required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Bendahara</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Nama</span>
                            <input type="text" class="form-control" name="nama_bendahara" placeholder="Nama" aria-describedby="basic-addon1" readonly required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">NIP</span>
                            <input type="text" class="form-control" name="nip_bendahara" placeholder="NIP" aria-describedby="basic-addon1" readonly required>
                        </div>
                    </div>
                </div>
                {{-- <div class="form-group">
                    <label class="control-label col-md-2">Satker</label>
                    <div class="col-md-3">
                        <input type="number" name="satker" class="form-control" step="1" min="1" required value="427752">
                    </div>
                </div> --}}
                <div class="form-group">
                    <label class="control-label col-md-2">Program</label>
                    <div class="col-md-4">
                        <input type="text" name="program" class="form-control" required value="" placeholder="01">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Kegiatan</label>
                    <div class="col-md-4">
                        <input type="text" name="kegiatan" class="form-control" step="1" min="1" required value="" placeholder="2488">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Output</label>
                    <div class="col-md-4">
                        <input type="text" name="output" class="form-control" required value="" placeholder="001">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Akun</label>
                    <div class="col-md-4">
                        <input type="text" name="akun" class="form-control"  required value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Uraian Akun</label>
                    <div class="col-md-8">
                        <input type="text" name="uraian" class="form-control" required value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Pagu</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Rp. </span>
                            <input type="number" name="pagu" id="pagu" class="form-control" min="0" step="1" aria-describedby="basic-addon1" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Terealisasi</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Rp. </span>
                            <input type="number" name="terealisasi" id="terealisasi" class="form-control" min="0" step="1" aria-describedby="basic-addon1" required>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-2">
                        {{csrf_field()}}
                    </div>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-success pull-right">Simpan <i class="fa fa-save"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#anak_satker').change(function(){
                var selected = $('#anak_satker :selected');
                $('input[name=nama_ppk]').val(selected.attr('data-nama_ppk'));
                $('input[name=nip_ppk]').val(selected.attr('data-nip_ppk'));
                $('input[name=nama_bendahara]').val(selected.attr('data-nama_bendahara'));
                $('input[name=nip_bendahara]').val(selected.attr('data-nip_bendahara'));
            });
        });

    </script>
@endsection