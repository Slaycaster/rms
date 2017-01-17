<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB, Auth;

use App\Stylist;
use App\Promo;

class SaleController extends Controller
{
    public function index()
    {
    	$stylists = Stylist::select(DB::raw("concat(stylist_last_name, ', ', stylist_first_name) AS stylist_name"), 'id')->where('branch_id', '=', Auth::user()->branch->id)->pluck('stylist_name', 'id');
    	$promos = ['0' => 'N/A'] + Promo::select(DB::raw("concat(promo_rate, '% | ', promo_name) AS promo"), 'id')->pluck('promo', 'id')->toArray();
    	return view('sales')
    		->with('stylists', $stylists)
    		->with('promos', $promos);	
    }
}
