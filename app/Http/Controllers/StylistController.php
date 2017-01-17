<?php

namespace App\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

/*
----------------------------------------------------------------------------------------------
	VALIDATION: change the requests to match your own file names if you need form validation
----------------------------------------------------------------------------------------------
*/
use App\Http\Requests\StylistStoreRequest as StylistStoreRequest;
use App\Http\Requests\StylistUpdateRequest as StylistUpdateRequest;

class StylistController extends CrudController
{
    public function __construct()
    {
    	parent::__construct();

    	$this->crud->setModel('App\Stylist');
		$this->crud->setRoute('stylists');
		$this->crud->setEntityNameStrings('Stylist', 'Stylists');

		$this->crud->setColumns
		(
			[
				
					[
						'name' => 'stylist_last_name',
						'label' => 'Last Name'
					],

				
					[
						'name' => 'stylist_first_name',
						'label' => 'First Name'
					],
				

					[
						'name' => 'stylist_middle_name',
						'label' => 'Middle Name'
					],
				

			
					[
						'name' => 'stylist_address',
						'label' => 'Address'
					],
				
					[
						'name' => 'stylist_contact_no',
						'label' => 'Contact #'
					],
				
					[
						'name' => 'stylist_email',
						'label' => 'E-mail'
					],
				

					[
						'name' => 'date_hired',
						'label' => 'Date Hired'
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
				'name' => 'stylist_last_name',
				'label' => 'Last Name',
				'type' => 'text',
			]
		);

		$this->crud->addField
		(
			[
				//Text
				'name' => 'stylist_first_name',
				'label' => 'First Name',
				'type' => 'text'
			]
		);
		$this->crud->addField
		(
			[
				//Text
				'name' => 'stylist_middle_name',
				'label' => 'Middle Name',
				'type' => 'text'
			]
		);

		$this->crud->addField
		(
			[
				//Text
				'name' => 'stylist_address',
				'label' => 'Address',
				'type' => 'text'
			]
		);

		$this->crud->addField
		(
			[
				//Text
				'name' => 'stylist_contact_no',
				'label' => 'Contact #',
				'type' => 'text'
			]
		);

		$this->crud->addField
		(
			[
				//Text
				'name' => 'stylist_email',
				'label' => 'E-mail',
				'type' => 'text'
			]
		);

		$this->crud->addField
		(
			[
				//Text
				'name' => 'date_hired',
				'label' => 'Date Hired',
				'type' => 'date'
			]
		);

		$this->crud->addField
		(
			[
				//Relationshorip - Service Type
				'label' => 'Branch',
				'type' => 'select',
				'name' => 'branch_id', //the DB column for the foreign key
				'entity' => 'branch', //the method that defines the relationship in you Model
				'attribute' => 'branch_name', //foreign key attribute that is shown to user
				'model' => 'App\Branch' //foreign key model
			]
		);
    }

    public function store(StylistStoreRequest $request)
    {
    	return parent::storeCrud();
    }

    public function update(StylistUpdateRequest $request)
    {
    	return parent::updateCrud();
    }
}
