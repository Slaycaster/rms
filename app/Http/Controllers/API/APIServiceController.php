<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Service;

class APIServiceController extends Controller
{
    public function index()
    {
    	$data = Service::with('service_type')->get();
    	return json_encode($data, JSON_PRETTY_PRINT);
    }
}
