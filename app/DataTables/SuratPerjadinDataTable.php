<?php

namespace App\DataTables;

use Auth;
use App\SuratPerjadin;
use Yajra\Datatables\Services\DataTable;


class SuratPerjadinDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $surat = $this->query();
        return $this->datatables
            ->eloquent($surat)
            // ->editColumn('spd_id', function($surat){
            //     return '<strong>' . $surat->no_spd . '</strong><br>' . '<small>' . $surat->hashid . '</small>';
            // })
            ->editColumn('no_spd', function($surat){
                return '<strong>' . $surat->no_spd . '</strong><br><small>' . $surat->tempat_dikeluarkan_surat . ', ' . \App\Library\Datify::readify(substr($surat->tanggal_spd, 0, 10)) . '</small><br><small>' . $surat->nama_ppk . '</small>';
            })  
            ->editColumn('nama_pegawai', function($surat){    
                return $surat->nama_pegawai . '<br><small>' . $surat->nip . '</small>';
            })
            ->editColumn('surat_tugas_id', function($surat){    
                $str = $surat->st->no_st . '<br><small>' . $surat->st->tanggal_surat . '</small><br>';
                if ($surat->cekLaporan()['status']) {
                    $str .= '<a href="' . url('laporan/download/' . $surat->cekLaporan()['data']->first()->file) . '" class="" target="_blank"> Terlapor <span class="badge badge-success"><i class="fa fa-check"></i></span></a>';
                }else{
                    $str .= '<a href="' . url('laporan/' . $surat->hashid) . '">Belum Terlapor  <span class="badge badge-danger"><i class="fa fa-info"></i></span></a>';
                }
                return $str;
            })
            ->editColumn('maksud', function($surat){    
                $rv = $surat->st->kegiatan->nama_kegiatan . '<br><small>' . date('d-m-Y', strtotime($surat->st->kegiatan->tanggal_awal)) . ' s/d ' . date('d-m-Y', strtotime($surat->st->kegiatan->tanggal_akhir)) . '</small><br><small>Di: ' . $surat->st->kegiatan->lokasi_kegiatan . '</small><br>';

                if ($surat->st->kegiatan->jenis_kegiatan == 'biasa') {
                    $rv .= '<span class="label label-success"><i class="fa fa-train"></i> BIASA</span>';
                }elseif ($surat->st->kegiatan->jenis_kegiatan == 'dalam_kota_8jam') {
                    $rv .= '<span class="label label-primary"><i class="fa fa-taxi"></i> DALAM KOTA 8 JAM</span>';
                }elseif ($surat->st->kegiatan->jenis_kegiatan == 'luar_negeri'){
                    $rv .= '<span class="label label-danger"><i class="fa fa-plane"></i> LUAR NEGERI</span>';
                }

                return $rv;
            })
            ->addColumn('action', function($surat){
                $rv = '<div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bars"></i>
                        </button>
                        <ul class="dropdown-menu  dropdown-menu-right">
                            <li><a href="'. url('rincian-biaya/create/' . $surat->hashid) . '"><i class="fa fa-calculator"></i> &nbsp;Rincian Biaya</a></li>
                            <li><a href="'. url('laporan/' . $surat->hashid) . '"><i class="fa fa-file"></i> &nbsp; Laporan</a></li>';

                if ($surat->st->kegiatan->jenis_kegiatan == 'dalam_kota_8jam') {
                    $rv .= '<li><a href="'. url('surat-tugas/cetak-tanda-terima-8jam/' . $surat->st->hashid) . '" target="_blank"><i class="fa fa-barcode"></i> &nbsp;Cetak Tanda Terima</a></li>';
                    $rv .= '<li><a href="'. url('surat-tugas/cetak-spd-8jam/' . $surat->st->st_id) . '" target="_blank"><i class="fa fa-print"></i> &nbsp;Cetak SPD</a></li>';
                }else {
                    $rv .=  '<li><a href="'. url('spd/cetak/' . $surat->hashid) . '" target="_blank"><i class="fa fa-print"></i> &nbsp;Cetak SPD</a></li>';
                }

                $rv .=  '</ul>
                    </div>';

                return $rv;
            })
            // ->addColumn('action', 'path.to.action.view')
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        if (Auth::user()->type == 'pegawai') {
            $query = SuratPerjadin::where('pegawai_id', Auth::user()->pegawai_id)->latest();
        }else{
            $query = SuratPerjadin::latest();
        }

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
                    ->addAction(['width' => '60px'])
                    ->parameters([
                        'dom' => 'Bfrtip',
                        'buttons' => ['csv', 'excel', 'pdf', 'print', 'reset', 'reload'],
                    ]);
                    // ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [            
            'no_spd',
            'nama_pegawai',
            'maksud',
            'surat_tugas_id',
            // add your columns
            // 'created_at',
            // 'updated_at',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'suratperjadindatatables_' . time();
    }
}
