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
                    'name' => 'unit_of_measurement',
                    'label' => 'Unit'
                ],

    			[
    				'name' => 'item_stock',
    				'label' => 'Stock'
    			],

                [
                    'label' => 'Branch',
                    'type' => 'select',
                    'name' => 'branch_id',
                    'entity' => 'branch',
                    'attribute' => 'branch_name',
                    'model' => 'App\Branch'
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
                'name' => 'unit_of_measurement',
                'label' => 'Unit of Measurement',
                'type' => 'text'
            ]
        );

    	$this->crud->addField
    	(
    		[
				//Text
				'name' => 'item_stock',
				'label' => 'Stock',
				'type' => 'number'
			]
    	);

        $this->crud->addField
        (
            [
                //Relationship
                'label' => 'Branch',
                'type' => 'select',
                'name' => 'branch_id', //the DB column for the foreign key
                'entity' => 'branch', //the method that defines the relationship in you Model
                'attribute' => 'branch_name', //foreign key attribute that is shown to user
                'model' => 'App\Branch' //foreign key model
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
