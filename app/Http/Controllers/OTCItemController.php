<?php

namespace App\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

/*
----------------------------------------------------------------------------------------------
	VALIDATION: change the requests to match your own file names if you need form validation
----------------------------------------------------------------------------------------------
*/
use App\Http\Requests\OTCItemStoreRequest as OTCItemStoreRequest;
use App\Http\Requests\OTCItemUpdateRequest as OTCItemUpdateRequest;

class OTCItemController extends CrudController
{
    public function __construct()
    {
    	parent::__construct();

    	$this->crud->setModel('App\OTCItem');
    	$this->crud->setRoute('otc_items');
    	$this->crud->setEntityNameStrings('Over-the-counter Item', 'Over-the-counter Items');

    	$this->crud->enableAjaxTable(); 
        $this->crud->enableExportButtons();

    	$this->crud->setColumns
    	(
    		[
    			[
    				'name' => 'otc_item_name',
    				'label' => 'Name'
    			],

                [
                    'name' => 'otc_unit_of_measurement',
                    'label' => 'Unit of Measurement'
                ],

    			[
    				'name' => 'otc_item_stock',
    				'label' => 'Stock'
    			],

                [
                    'name' => 'otc_item_price',
                    'label' => 'Price'
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
				'name' => 'otc_item_name',
				'label' => 'Name',
				'type' => 'text' 
			]
    	);

        $this->crud->addField
        (
            [
                //Text
                'name' => 'otc_unit_of_measurement',
                'label' => 'Unit of Measurement',
                'type' => 'text'
            ]
        );

    	$this->crud->addField
    	(
    		[
				//Text
				'name' => 'otc_item_stock',
				'label' => 'Stock',
				'type' => 'number'
			]
    	);

        $this->crud->addField
        (
            [
                //Number
                'name' => 'otc_item_price',
                'label' => 'Item Price',
                'type' => 'text',
                'prefix' => '₱'
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

    public function store(OTCItemStoreRequest $request)
	{
		return parent::storeCrud();
	}

	public function update(OTCItemUpdateRequest $request)
	{
		return parent::updateCrud();
	}
}
