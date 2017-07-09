<?php

namespace App\DataTables;
use App\Kegiatan;
use App\SuratTugas;
use Yajra\Datatables\Services\DataTable;
use Auth;

class KegiatanDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $kegiatan = $this->query();
        return $this->datatables
            ->eloquent($kegiatan)
            ->editColumn('nama_kegiatan', function($kegiatan){
                return '<a href="#" onclick="detail(' . $kegiatan->kegiatan_id . ')" style="text-decoration:underline;">'. $kegiatan->nama_kegiatan .'</a><br>' . date('d M Y', strtotime($kegiatan->tanggal_awal)) . ' s/d ' . date('d M Y', strtotime($kegiatan->tanggal_akhir));
            })
            ->addColumn('action', function($kegiatan){

                return '
                    <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bars"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="' . url('kegiatan/single/' . $kegiatan->kegiatan_id) . '"><i class="fa fa-eye"></i>&nbsp; Detail</a></li>
                            <li><a href="'. url('surat-tugas/tambah/' . $kegiatan->kegiatan_id) . '"><i class="fa fa-envelope-o"></i>&nbsp; Buat Surat Tugas</a></li>
                            <li><a href="'. url('kegiatan/edit/' . $kegiatan->kegiatan_id) .'"><i class="fa fa-pencil"></i> &nbsp;Edit</a></li>
                            <li>
                                <form method="post" action="' . url('hapuskegiatan') . '">
                                    <input type="hidden" name="kegiatan_id" value="'. $kegiatan->kegiatan_id .'">
                                    ' . csrf_field() .'
                                    <button type="submit"  onclick="return confirm(\'Yakin akan menghapus Kegiatan ini?\nIni juga akan menghapus SPD dan Surat Tugas yang berkaitan dengan kegiatan ini.\')" ><i class="fa fa-trash"></i> &nbsp;Delete</button>
                                    
                                </form>
                            </li>
                        </ul>
                    </div>';
            })
            ->editColumn('Surat Tugas', function($kegiatan){
                if (count($kegiatan->st) > 0) {
                    $str = '<ul>';
                    foreach ($kegiatan->st as $key => $value) {
                        // $str .= '<li><a href="' . url('surat-tugas') . '/' . $value->st_id . '">' .  $value->no_st . '</a></li>';
                        $str .= '<li>' .  $value->no_st . '</li>';
                    }
                    $str .= '</ul>';

                    return $str;
                }

                return '<a href="' . url('surat-tugas/tambah/' . $kegiatan->kegiatan_id) . '" class="label label-warning">Belum dibuat</a>';
            })
            ->editColumn('jenis_kegiatan', function($kegiatan)
            {
                $rv = '';
                if ($kegiatan->jenis_kegiatan == 'biasa') {
                    $rv = '<span class="label label-success"><i class="fa fa-train"></i> BIASA</span>';
                }elseif ($kegiatan->jenis_kegiatan == 'dalam_kota_8jam') {
                    $rv = '<span class="label label-primary"><i class="fa fa-taxi"></i> DALAM KOTA 8 JAM</span>';
                }elseif ($kegiatan->jenis_kegiatan == 'luar_negeri'){
                    $rv = '<span class="label label-danger"><i class="fa fa-plane"></i> LUAR NEGERI</span>';
                }elseif ($kegiatan->jenis_kegiatan == 'konsinyering'){
                    $rv = '<span class="label label-warning"><i class="fa fa-bus"></i> KONSINYERING</span>';
                }

                return $rv;
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
        $query = null;
        if (Auth::user()->type == 'admin') {
            $query = Kegiatan::query();
        }elseif(Auth::user()->type == 'spk'){
            $query = Kegiatan::query();
        }elseif (Auth::user()->type == 'pegawai') {
            $query = Kegiatan::query();
        }

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
                    ->addAction(['width' => '20px'])
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
            'kegiatan_id',
            // 'no_kegiatan',
            'nama_kegiatan',
            'jenis_kegiatan',
            'lokasi_kegiatan',
            'nama_penyelenggara',
            'Surat Tugas',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'kegiatandatatables_' . time();
    }
}
