<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

use App\Stylist;

class SaleController extends Controller
{
    public function index()
    {
    	$stylists = Stylist::select(DB::raw("concat(stylist_last_name, ', ', stylist_first_name) AS stylist_name"), 'id')->pluck('stylist_name', 'id');
    	return view('sales')
    		->with('stylists', $stylists);	
    }
}
