<?php

namespace App\DataTables;

use App\Pegawai;
use Yajra\Datatables\Services\DataTable;

class PegawaiDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $pegawai = $this->query();
        return $this->datatables
            ->eloquent($pegawai)
            ->addColumn('action', function($pegawai){
                return '
                    <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cogs"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="'. url('pegawai/profile/' . $pegawai->pegawai_id) . '"><i class="fa fa-eye"></i> &nbsp;View</a></li>
                            <li><a href="'. url('pegawai/edit/' . $pegawai->pegawai_id) .'"><i class="fa fa-pencil"></i> &nbsp;Edit</a></li>
                        </ul>
                    </div>';
            })
            // ->addColumn('action', 'path.to.action.view')
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Pegawai::query();

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
                    ->addAction(['width' => '60px'])
                    ->parameters([
                        'dom' => 'Bfrtip',
                        'buttons' => ['csv', 'excel', 'pdf', 'print', 'reset', 'reload'],
                    ]);
                    // ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'pegawai_id',
            'nama',
            'nip',
            // 'pangkat',
            // 'golongan',
            // 'jabatan',
            // add your columns
            // 'created_at',
            // 'updated_at',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'pegawaidatatables_' . time();
    }
}
