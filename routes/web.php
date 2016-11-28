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

	CRUD::resource('servicetypes', 'ServicetypeController');
	CRUD::resource('services', 'ServiceController');
	CRUD::resource('branches', 'BranchController');
	CRUD::resource('promos', 'PromoController');
	CRUD::resource('customers', 'CustomerController');
	
	Route::get('sales', 'SaleController@index');	
});