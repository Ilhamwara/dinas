<?php

namespace App\DataTables;

use App\Referensi;
use Yajra\Datatables\Services\DataTable;

class ReferensiDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $referensi = $this->query();
        return $this->datatables
        ->eloquent($referensi)
        ->addColumn('action', function($referensi){
            return '<a href="'. url('referensi/edit') . '/' . $referensi->id . '" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</a>';
        })
        ->editColumn('tujuan_id', function($referensi){
            return $referensi->tujuan->tujuan;
        })
        ->editColumn('jenis', function($referensi){
            return $referensi->jn->nama;
        })
        ->editColumn('kelas', function($referensi){
            return $referensi->kelas;
        })
        ->editColumn('nama_referensi', function($referensi){
            return $referensi->nama;
        })
        ->editColumn('tahun', function($referensi){
            return $referensi->tahun;
        })
        ->editColumn('harga', function($referensi){
            return '<strong class="rp">Rp. ' . number_format($referensi->harga,0, ',', '.') . '</strong>';
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
        $query = Referensi::query();

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
        'tujuan_id',
        'jenis',
        'kelas',
        'nama',
        'tahun',
        'harga',
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
        return 'referensidatatables_' . time();
    }
}
