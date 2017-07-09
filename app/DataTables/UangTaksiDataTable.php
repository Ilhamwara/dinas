<?php

namespace App\DataTables;
use Yajra\Datatables\Services\DataTable;
use App\UangTaksi;

class UangTaksiDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $uangtaksi = $this->query();
        return $this->datatables
            ->eloquent($uangtaksi)
            ->addColumn('action', function($uangtaksi)
            {
                return '<a href="'.url('uang-taksi/edit/'.$uangtaksi->id).'" class="btn btn-warning"><i class="fa fa-pencil"></i></a>';
            })
            ->editColumn('id', function($uangtaksi){
                return $uangtaksi->id;
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
        $query = UangTaksi::query();

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
            'satuan',
            'jumlah',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'uangtaksidatatables_' . time();
    }
}
