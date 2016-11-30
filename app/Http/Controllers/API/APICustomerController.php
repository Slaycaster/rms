<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;

class APICustomerController extends Controller
{
    public function customers()
    {
    	$data = Customer::all();
    	return json_encode($data, JSON_PRETTY_PRINT);
    }
}
