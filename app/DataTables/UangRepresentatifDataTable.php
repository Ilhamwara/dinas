<?php

namespace App\DataTables;

use Yajra\Datatables\Services\DataTable;
use App\UangRepresentatif;

class UangRepresentatifDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $uangrepresentatif = $this->query();
        return $this->datatables
            ->eloquent($uangrepresentatif)
            ->addColumn('action', function($UangRepresentatif)
            {
                return '<a href="'.url('uang-representatif/edit/'.$UangRepresentatif->id).'" class="btn btn-warning"><i class="fa fa-pencil"></i></a>';
            })
            ->editColumn('id', function($UangRepresentatif){
                return $UangRepresentatif->id;
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
        $query = UangRepresentatif::query();

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
            // 'id',
            // add your columns
            'uraian_representatif',
            'ur_lukot',
            'ur_dakot',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'uangrepresentatifdatatables_' . time();
    }
}
