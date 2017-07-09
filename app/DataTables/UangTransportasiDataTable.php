<?php

namespace App\DataTables;

use Yajra\Datatables\Services\DataTable;
use App\UangTransportasi;

class UangTransportasiDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $uangTransportasi = $this->query();
        return $this->datatables
        ->eloquent($uangTransportasi)
        ->addColumn('action', function($uangTransportasi)
        {
            return '<a href="'.url('uang-transport/edit/'.$uangTransportasi->uts_id).'" class="btn btn-warning"><i class="fa fa-pencil"></i></a>';
        })
        ->editColumn('uts_id', function($uangTransportasi){
            return $uangTransportasi->uts_id;
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
        $query = UangTransportasi::query();

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
        // 'uts_id',
        'dinas_sekitar',
        'jumlah',
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
        return 'uangtransportasidatatables_' . time();
    }
}
