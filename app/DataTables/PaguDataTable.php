<?php

namespace App\DataTables;

use App\Pagu;
use Yajra\Datatables\Services\DataTable;

class PaguDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $pagu = $this->query();
        return $this->datatables
            ->eloquent($pagu)
            // ->editColumn('id', function($pagu){
            //     return '<dl class="dl-horizontal">
            //                 <dt>Id:</dt><dd>' . $pagu->id . ' </dd>
            //                 <dt>Kode Anak Satker:</dt><dd>' . $pagu->anak_satker_id . '</dd>
            //                 <dt>Program:</dt><dd>' . $pagu->program . '</dd>
            //                 <dt>Kegiatan:</dt><dd>' . $pagu->kegiatan . '</dd>
            //                 <dt>Output:</dt><dd>' . $pagu->output . '</dd>
            //                 <dt>Akun:</dt><dd>' . $pagu->akun . '</dd>
            //                 <dt>Uraian Akun:</dt><dd>' . $pagu->uraian_akun . '</dd>
            //                 <dt>PPK :</dt><dd>' . $pagu->nm_ppk . ' (' . $pagu->nip_ppk . ')</dd>
            //                 <dt>Bendahara :</dt><dd>' . $pagu->nm_bendahara . ' (' . $pagu->nip_bendahara . ')</dd>
            //             </dl>
            //     ';
            // })
            ->editColumn('akun', function($pagu){
                return $pagu->akun . '<br>
                        <em>' . $pagu->uraian_akun . '</em>';
            })
            ->editColumn('jumlah_pagu', function($pagu){
                return '<span class="price">' . number_format($pagu->jumlah_pagu, 0, ',', '.') . '</span>';
            })
            ->addColumn('action', function($pagu){

                return '
                    <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bars"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="' . url('pagu/single/' . $pagu->id) . '"><i class="fa fa-eye"></i>&nbsp; Detail</a></li>
                            <li><a href="'. url('surat-tugas/tambah/' . $pagu->id) . '"><i class="fa fa-envelope-o"></i>&nbsp; Buat Surat Tugas</a></li>
                            <li><a href="'. url('pagu/edit/' . $pagu->id) .'"><i class="fa fa-pencil"></i> &nbsp;Edit</a></li>
                        </ul>
                    </div>';
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
        $query = Pagu::query();

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
            'program',
            'kegiatan',
            'akun',
            'jumlah_pagu',
            'terealisasi_pagu',
            'sisa_pagu'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'pagudatatables_' . time();
    }
}
