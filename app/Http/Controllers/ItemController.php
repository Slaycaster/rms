<?php

namespace App\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

/*
----------------------------------------------------------------------------------------------
	VALIDATION: change the requests to match your own file names if you need form validation
----------------------------------------------------------------------------------------------
*/
use App\Http\Requests\ItemStoreRequest as ItemStoreRequest;
use App\Http\Requests\ItemUpdateRequest as ItemUpdateRequest;

class ItemController extends CrudController
{
    public function __construct()
    {
    	parent::__construct();

    	$this->crud->setModel('App\Item');
    	$this->crud->setRoute('items');
    	$this->crud->setEntityNameStrings('Item', 'Items');

    	$this->crud->setColumns
    	(
    		[
    			[
    				'name' => 'item_name',
    				'label' => 'Name'
    			],

    			[
    				'name' => 'item_unit_of_measurement',
    				'label' => 'Unit of Measurement'
    			]
    		]
    	);

    	$this->crud->addField
    	(
			[
				//Text
				'name' => 'item_name',
				'label' => 'Name',
				'type' => 'text' 
			]
    	);

    	$this->crud->addField
    	(
    		[
				//Text
				'name' => 'item_unit_of_measurement',
				'label' => 'Unit of Measurement',
				'type' => 'text'
			]
    	);
    }

    public function store(ItemStoreRequest $request)
	{
		return parent::storeCrud();
	}

	public function update(ItemUpdateRequest $request)
	{
		return parent::updateCrud();
	}
}
