<?php

namespace App\DataTables;

use Yajra\Datatables\Services\DataTable;
use App\UangHarianLuar;

class UangHarianLuarDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $uangharianluar = $this->query();
        return $this->datatables
            ->eloquent($uangharianluar)
            ->addColumn('action', function($uangharianluar)
            {
                return '<a href="'.url('uang-harian-luar-negeri/edit/'.$uangharianluar->id).'" class="btn btn-warning"><i class="fa fa-pencil"></i></a>';
            })
            ->editColumn('negara', function($uangharianluar){
                return $uangharianluar->tujuan->tujuan;
            })
            ->editColumn('a', function($uangharianluar)
            {
                return '$' . $uangharianluar->a;
            })
            ->editColumn('b', function($uangharianluar)
            {
                return '$' . $uangharianluar->b;
            })
            ->editColumn('c', function($uangharianluar)
            {
                return '$' . $uangharianluar->c;
            })
            ->editColumn('d', function($uangharianluar)
            {
                return '$' . $uangharianluar->d;
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
        $query = UangHarianluar::query();

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
            'negara',
            'a',
            'b',
            'c',
            'd',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'uangharianluardatatables_' . time();
    }
}
