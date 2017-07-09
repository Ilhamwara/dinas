<?php

namespace App\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;
use App\UangHarianRapat;

class UangHarianRapatDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $uangharianrapat = $this->query();
        return $this->datatables
            ->eloquent($uangharianrapat)
            ->addColumn('action', function($uangharianrapat)
            {
                return '<a href="'.url('uang-harian-rapat/edit/'.$uangharianrapat->id).'" class="btn btn-warning"><i class="fa fa-pencil"></i></a>';
            })
            ->editColumn('id', function($uangharianrapat){
                return $uangharianrapat->id;
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
        $query = UangHarianRapat::query();

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
            'tujuan_dinas',
            'fullboard_lukot',
            'fullboard_dakot',
            'fullhalf_dakot',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'uangharianrapatdatatables_' . time();
    }
}
