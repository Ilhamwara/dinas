<?php

namespace App\DataTables;

use App\Laporan;
use Auth;
use App\DetailSuratTugas;
use Yajra\Datatables\Services\DataTable;

class LaporanDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $laporan = $this->query();

        return $this->datatables
            ->eloquent($laporan)
            ->addColumn('action', function($laporan)
            {
                return '<a href="' . url('laporan/download/' . $laporan->first()->file) . '" class="btn btn-danger btn-xs">Download <i class="fa fa-download"></i></a>';
            })
            ->editColumn('surat_tugas_id', function($laporan){
                $rv = '<strong>' . $laporan->st->kegiatan->nama_kegiatan . '</strong><br>';
                $rv .= $laporan->st->kegiatan->lokasi_kegiatan . '<br>';
                $rv .= \App\Library\Datify::readify($laporan->st->kegiatan->tanggal_awal) . ' - ' . \App\Library\Datify::readify($laporan->st->kegiatan->tanggal_akhir) . '<br>';

                if ($laporan->st->kegiatan->jenis_kegiatan == 'biasa') {
                    $rv .= '<span class="label label-success"><i class="fa fa-train"></i> BIASA</span>';
                }elseif ($laporan->st->kegiatan->jenis_kegiatan == 'dalam_kota_8jam') {
                    $rv .= '<span class="label label-primary"><i class="fa fa-taxi"></i> DALAM KOTA 8 JAM</span>';
                }elseif ($laporan->st->kegiatan->jenis_kegiatan == 'luar_negeri'){
                    $rv .= '<span class="label label-danger"><i class="fa fa-plane"></i> LUAR NEGERI</span>';
                }
                return $rv;
            })
            ->editColumn('id_spd', function($laporan){
                $rv = '<strong>ST:</strong> <a href="' . url('surat-tugas/cetak/' . $laporan->st->st_id) . '" target="_blank">' . $laporan->st->no_st . '</a><br>';
                $rv .= '<strong>SPD:</strong> <a href="' . url('spd/cetak/' . $laporan->spd->hashid) . '" target="_blank">' . $laporan->spd->no_spd . '</a><br>';

                if ($laporan->st->kegiatan->jenis_kegiatan == 'dalam_kota_8jam') {
                    $rv .= 'KOLEKTIF';
                }else{
                    $rv .= $laporan->spd->pegawai->nama;
                }

                return $rv;
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        if(Auth::user()->type == 'pegawai'){
            $st_id = [];
            $mySt = DetailSuratTugas::where('pegawai_id', Auth::user()->pegawai_id)->get();
            if ($mySt) {
                foreach ($mySt as $key => $value) {
                    $st_id[] = $value->surat_tugas_id;
                }
            }

            $query = Laporan::with('st')->with('spd')->with('spd.pegawai')->whereIn('surat_tugas_id', $st_id)->latest();

        }elseif (Auth::user()->type == 'admin') {
            
            $query = Laporan::with('st')->with('spd')->with('spd.pegawai')->latest();
        
        }elseif (Auth::user()->type == 'spk') {
            $query = Laporan::with('st')->with('spd')->with('spd.pegawai')->latest();
            
        }else{
            die();
        }

        // $query = Laporan::with('spd');

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'surat_tugas_id',
            'id_spd',
            // add your columns
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'laporandatatables_' . time();
    }
}
