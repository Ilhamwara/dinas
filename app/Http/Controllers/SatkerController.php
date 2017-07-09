<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\SatkerDataTable;


class SatkerController extends Controller
{
    //
    public function index(SatkerDataTable $dataTable)
    {
        return $dataTable->render('satker.index');
    }

}
