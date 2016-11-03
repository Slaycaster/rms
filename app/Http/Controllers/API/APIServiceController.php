<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Service;
use App\Servicetype;

class APIServiceController extends Controller
{
    public function index()
    {
    	$data = Service::with('service_type')->get();
    	return json_encode($data, JSON_PRETTY_PRINT);
    }

    public function byServiceType($id)
    {
    	$data = Service::where('service_type_id', '=', $id)->with('service_type')->get();
    	return json_encode($data, JSON_PRETTY_PRINT);
    }

    public function servicetype()
    {
    	$data = Servicetype::all();
    	return json_encode($data, JSON_PRETTY_PRINT);
    }
}
