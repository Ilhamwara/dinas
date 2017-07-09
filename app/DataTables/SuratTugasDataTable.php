<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Auth;
use App\SuratTugas;
use App\DetailSuratTugas;
use Yajra\Datatables\Services\DataTable;

class SuratTugasDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $suratTugas = $this->query();
        return $this->datatables
            ->eloquent($suratTugas)
            ->addColumn('action', function($suratTugas){
                return '<button type="button" onclick="find(' . $suratTugas->st_id . ')" class="btn btn-default" data-toggle="popover" data-trigger="focus" title="Dismissible popover" data-content="And heres some amazing content. Its very engaging. Right?"><i class="fa fa-eye"></button>';
            })
            ->editColumn('no_st', function($suratTugas){
                return '<strong>' . $suratTugas->no_st . '</strong>' . 
                        '<br>Tgl: ' . \App\Library\Datify::readify(substr($suratTugas->tanggal_surat, 0, 10));
            })
            ->editColumn('nama_kegiatan', function($suratTugas){
                return '<strong>' . $suratTugas->nama_kegiatan . '</strong>' . 
                        '<br>Sejak: ' . \App\Library\Datify::readify(substr($suratTugas->tanggal_awal, 0, 10)) .
                        '<br>Hingga: ' . \App\Library\Datify::readify(substr($suratTugas->tanggal_akhir, 0, 10));
            })
            ->editColumn('tujuan_dinas', function($suratTugas)
            {
                $rv = '';
                if ($suratTugas->kegiatan->jenis_kegiatan == 'biasa') {
                    $rv .= '<span class="label label-success"><i class="fa fa-train"></i> BIASA</span>';
                }elseif ($suratTugas->kegiatan->jenis_kegiatan == 'dalam_kota_8jam') {
                    $rv .= '<span class="label label-primary"><i class="fa fa-taxi"></i> DALAM KOTA 8 JAM</span>';
                }elseif ($suratTugas->kegiatan->jenis_kegiatan == 'luar_negeri'){
                    $rv .= '<span class="label label-danger"><i class="fa fa-plane"></i> LUAR NEGERI</span>';
                }elseif ($suratTugas->kegiatan->jenis_kegiatan == 'konsinyering'){
                    $rv .= '<span class="label label-warning"><i class="fa fa-bus"></i> KONSINYERING</span>';
                }

                $rv .= '<br><br>' . $suratTugas->tujuan_dinas;

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

            $query = SuratTugas::whereIn('st_id', $st_id)->latest();

        }elseif (Auth::user()->type == 'admin') {
            
            $query = SuratTugas::latest();
        
        }elseif (Auth::user()->type == 'spk') {
            $query = SuratTugas::latest();
            
        }else{
            die();
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
            'no_st',
            'nama_kegiatan',
            'tujuan_dinas',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'surattugasdatatables_' . time();
    }
}
