<?php

namespace App\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;
use App\UangPenginapan;

class UangPenginapanDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $uangPenginapan = $this->query();
        return $this->datatables
        ->eloquent($uangPenginapan)
        ->addColumn('action', function($uangPenginapan)
        {
            return '<a href="'.url('uang-penginapan/edit/'.$uangPenginapan->id).'" class="btn btn-warning"><i class="fa fa-pencil"></i></a>';
        })
        ->editColumn('tujuan_id', function($uangPenginapan)
        {
            return $uangPenginapan->tujuan->tujuan;
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
        $query = UangPenginapan::query();

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
        'eselon_satu',
        'eselon_dua',
        'eselontiga_golempat',
        'eselonempat_goltiga',
        'golongan_satudua',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'uangpenginapandatatables_' . time();
    }
}
