<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PangkatGol;

class PangkatGolController extends Controller
{
    //

    public function search()
    {
    	$response = [
    		'status' => false,
    		'data' => null,
    		'message' => ''
    	];


    	$pangkatgol = PangkatGol::select('id', 'golongan', 'pangkat', 'nama_pangkat', 'eselon', 'tingkat');
 
    	if (null != request('golongan')) {
    		$pangkatgol->where('golongan', request('golongan'));
    	}

    	if (null != request('pangkat')) {
    		$pangkatgol->where('pangkat', request('pangkat'));
    	}

    	if (null != request('nama_pangkat')) {
    		$pangkatgol->where('nama_pangkat', request('nama_pangkat'));
    	}

    	if (null != request('eselon')) {
    		$pangkatgol->where('eselon', request('eselon'));
    	}
	    	
	    if (null != request('tingkat')) {
    		$pangkatgol->where('tingkat', request('tingkat'));
    	}

    	if ($result = $pangkatgol->get()) {
    		$response['status']	= true;
    		$response['data']	= $result;
    	}

    	return response()->json($response,200);
    }
}
