<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
// use App\Pegawai;
// use App\Satker;
// use App\DataTables\PegawaiDataTable;

class DaftarNominatifController extends Controller
{
    public function index()
    {
       return view('daftar-nominatif.index');
    }

    public function show($id, Request $request)
    {
    	
    }

    public function create(Request $request)
    {
       
    }

    public function save(Request $request)
    {
    	
    }

    public function edit($id, Request $request)
    {
    	
    }

    public function update($id, Request $request)
    {
    
    }
}
