<?php

namespace App\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $user = $this->query();
        return $this->datatables
            ->eloquent($user)
            ->addColumn('action', function($user){
                return '
                    <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bars"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="'. url('user/detail/' . $user->hashid) . '" ><i class="fa fa-eye"></i> &nbsp;Detail</a></li>
                            <li><a href="'. url('user/delete/' . $user->hashid) . '" ><i class="fa fa-trash-o"></i> &nbsp;Hapus</a></li>
                            <li><a href="'. url('user/edit/' . $user->hashid) . '" ><i class="fa fa-pencil"></i> &nbsp;Sunting</a></li>
                           
                        </ul>
                    </div>';
            })
            ->editColumn('type', function($user){
                $type = '';
                if ($user->type == 'admin') {
                    $type = '<span class="label label-danger"><i class="fa fa-star"></i> ADMIN</span>';
                }elseif($user->type == 'spk') {
                    $type = '<span class="label label-warning"><i class="fa fa-usd"></i> SPK</span>';
                }elseif($user->type == 'pegawai') {
                    $type = '<span class="label label-default"><i class="fa fa-user"></i> PEGAWAI</span>';
                }

                return $type;
            })
            ->editColumn('id', function($user){
                return $user->hashid;
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
        $query = User::query();

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
            'username',
            'name',
            'type',
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
        return 'userdatatables_' . time();
    }
}
