<?php

namespace App\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

/*
----------------------------------------------------------------------------------------------
	VALIDATION: change the requests to match your own file names if you need form validation
----------------------------------------------------------------------------------------------
*/
use App\Http\Requests\PromoStoreRequest as PromoStoreRequest;
use App\Http\Requests\PromoUpdateRequest as PromoUpdateRequest;


class PromoController extends CrudController
{
    public function __construct()
    {
    	parent::__construct();

    	$this->crud->setModel('App\Promo');
    	$this->crud->setRoute('promos');
    	$this->crud->setEntityNameStrings('promo', 'promos');

    	$this->crud->setColumns
        (
    		[
    			
		    		[
		    			'name' => 'promo_name',
		    			'label' => 'Promo Name'
		    		],
		    	
		    		[
		    			'name' => 'promo_rate',
		    			'label' => 'Promo Rate (in %)'
		    		]
		    	
    		]
    	);

    	$this->crud->addField
    	(
    		[
    			//Text
    			'name' => 'promo_name',
    			'label' => 'Promo Name',
    			'type' => 'text'
    		]
    	);

    	$this->crud->addField
    	(
    		[
    			//Number
    			'name' => 'promo_rate',
    			'label' => 'Rate',
    			'type' => 'number',
    			'suffix' => '%'
    		]
    	);

    }

    public function store(PromoStoreRequest $request)
    {
    	return parent::storeCrud();
    }
    public function update(PromoUpdateRequest $request)
    {
    	return parent::updateCrud();
    }
}
