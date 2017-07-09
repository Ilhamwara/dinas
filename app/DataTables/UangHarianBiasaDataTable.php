<?php

namespace App\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;
use App\UangHarianBiasa;

class UangHarianBiasaDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $uangharianbiasa = $this->query();
        return $this->datatables
            ->eloquent($uangharianbiasa)
            ->addColumn('action', function($uangharianbiasa)
            {
                return '<a href="'.url('uang-harian/edit/'.$uangharianbiasa->id).'" class="btn btn-warning"><i class="fa fa-pencil"></i></a>';
            })
            ->editColumn('tujuan_id', function($uangharianbiasa){
                return $uangharianbiasa->tujuan->tujuan;
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
        $query = UangHarianBiasa::query();

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
            // add your columns
            'tujuan_id',
            'luar_kota',
            'dalam_kota',
            'diklat',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'uangharianbiasadatatables_' . time();
    }
}
