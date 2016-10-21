<?php

namespace App\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

/*
----------------------------------------------------------------------------------------------
	VALIDATION: change the requests to match your own file names if you need form validation
----------------------------------------------------------------------------------------------
*/
use App\Http\Requests\CustomerStoreRequest as CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest as CustomerUpdateRequest;

class CustomerController extends CrudController
{
    public function __construct()
    {
    	parent::__construct();

    	$this->crud->setModel('App\Customer');
    	$this->crud->setRoute('customers');
    	$this->crud->setEntityNameStrings('customer', 'customers');

    	$this->crud->setColumns
    	(
    		[
    			$this->crud->addColumn
    			(
    				[
    					'name' => 'customer_name',
    					'label' => 'Name'
    				]
    			),
    			$this->crud->addColumn
    			(
    				[
    					'name' => 'address',
    					'label' => 'Address'
    				]
    			),
    			$this->crud->addColumn
    			(
    				[
    					'name' => 'email',
    					'label' => 'E-mail'
    				]
    			),
    			$this->crud->addColumn
    			(
    				[
    					'name' => 'contact',
    					'label' => 'Contact #'
    				]
    			)
    		]
    	);

    	$this->crud->addField
    	(
    		[
    			//Text
    			'name' => 'customer_name',
    			'label' => 'Customer Name',
    			'type' => 'text'
    		]
    	);

    	$this->crud->addField
    	(
    		[
    			//Text
    			'name' => 'address',
    			'label' => 'Address',
    			'type' => 'address'
    		]
    	);

    	$this->crud->addField
    	(
    		[
    			//Text
    			'name' => 'email',
    			'label' => 'E-mail Address',
    			'type' => 'email'
    		]
    	);

    	$this->crud->addField
    	(
    		[
    			//Text
    			'name' => 'contact',
    			'label' => 'Contact #',
    			'type' => 'text'
    		]
    	);
    }

    public function store(CustomerStoreRequest $request)
	{
		return parent::storeCrud();
	}

	public function update(CustomerUpdateRequest $request)
	{
		return parent::updateCrud();
	}
}
