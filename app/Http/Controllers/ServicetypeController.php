<?php

namespace App\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

/*
----------------------------------------------------------------------------------------------
	VALIDATION: change the requests to match your own file names if you need form validation
----------------------------------------------------------------------------------------------
*/
use App\Http\Requests\ServicetypeStoreRequest as ServicetypeStoreRequest;
use App\Http\Requests\ServicetypeUpdateRequest as ServicetypeUpdateRequest;


class ServicetypeController extends CrudController
{
	public function __construct()
	{
		parent::__construct();

		$this->crud->setModel('App\Servicetype');
		$this->crud->setRoute('servicetypes');
		$this->crud->setEntityNameStrings('servicetype', 'servicetypes');

		$this->crud->setColumns
		(
			[
				
					[
						'name' => 'service_type_name',
						'label' => 'Service Type (Category)'
					],

					[
						'name' => 'sub_description',
						'label' => 'Sub-description'
					]
				
			]
		);

		$this->crud->addField
		(
			[
				//Text
				'name' => 'service_type_name',
				'label' => 'Service Type',
				'type' => 'text'
			]
		);

		$this->crud->addField
		(
			[
				//Text
				'name' => 'sub_description',
				'label' => 'Sub-description',
				'type' => 'text'
			]
		);
	}

	public function store(ServicetypeStoreRequest $request)
	{
		return parent::storeCrud();
	}

	public function update(ServicetypeUpdateRequest $request)
	{
		return parent::updateCrud();
	}
}	