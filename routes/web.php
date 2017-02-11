<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'admin'], function()
{
	//Route::get('dashboard', 'Admin\AdminController@index');

	Route::group(['middleware' => ['role:Administrator']], function () {
		CRUD::resource('user', 'UserCrudController');
		CRUD::resource('servicetypes', 'ServicetypeController');
		CRUD::resource('services', 'ServiceController');
		CRUD::resource('stylists', 'StylistController');
		CRUD::resource('branches', 'BranchController');
		CRUD::resource('promos', 'PromoController');
		CRUD::resource('customers', 'CustomerController');
		CRUD::resource('items', 'ItemController');
		CRUD::resource('otc_items', 'OTCItemController');
	});
	
	Route::get('sales', 'SaleController@index');	
	Route::get('otc_sales', 'SaleController@otc');	
	Route::get('reports', 'ReportsController@index');
	Route::get('reports/sales/today', 'ReportsController@today');
	Route::get('reports/sales/branch', 'ReportsController@branch');
	Route::get('reports/sales/customer', 'ReportsController@customer');
	Route::get('reports/inventory', 'ReportsController@inventory');

	Route::get('reports/otc', 'ReportsController@otc_index');
	Route::get('reports/otc_sales/today', 'ReportsController@today_otc');
	Route::get('reports/otc_sales/branch', 'ReportsController@branch_otc');
	Route::get('reports/otc_sales/customer', 'ReportsController@customer_otc');
	Route::get('reports/inventory/otc', 'ReportsController@inventory_otc');
});