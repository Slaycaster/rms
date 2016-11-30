<?php

namespace App\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

/*
----------------------------------------------------------------------------------------------
	VALIDATION: change the requests to match your own file names if you need form validation
----------------------------------------------------------------------------------------------
*/
use App\Http\Requests\ServiceStoreRequest as ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest as ServiceUpdateRequest;

class ServiceController extends CrudController
{
	public function __construct()
	{
		parent::__construct();

		$this->crud->setModel('App\Service');
		$this->crud->setRoute('services');
		$this->crud->setEntityNameStrings('service', 'services');

		$this->crud->setColumns
		(
			[
				$this->crud->addColumn
				(
					[
						'name' => 'service_name',
						'label' => 'Service Name'
					]
				),

				$this->crud->addColumn
				(
					[
						'name' => 'sub_description',
						'label' => 'Sub-description'
					]
				),

				$this->crud->addColumn
				(
					[
						'label' => 'Service Type (Category)',
						'type' => 'select',
						'name' => 'service_type_id',
						'entity' => 'service_type',
						'attribute' => 'service_type_name',
						'model' => 'App\Servicetype'
					]
				),

				$this->crud->addColumn
				(
					[
						'name' => 'price',
						'label' => 'Price'
					]
				)
			]
		);
		$this->crud->addField
		(
			[
				//Text
				'name' => 'service_name',
				'label' => 'Service',
				'type' => 'text',

				//HTML Attribute
				'attributes' => [
					'placeholder' => 'Name of the service'
				]
			]
		);

		$this->crud->addField
		(
			[
				//Text
				'name' => 'sub_description',
				'label' => 'Sub-description',
				'type' => 'text',

				//HTML Attribute
				'attributes' => [
					'placeholder' => 'Tiny description goes here'
				]
			]
		);

		$this->crud->addField
		(
			[
				//Relationship - Service Type
				'label' => 'Category',
				'type' => 'select',
				'name' => 'service_type_id', //the DB column for the foreign key
				'entity' => 'service_type', //the method that defines the relationship in you Model
				'attribute' => 'service_type_name', //foreign key attribute that is shown to user
				'model' => 'App\Servicetype' //foreign key model
			]
		);

		$this->crud->addField
		(
			[
				//Number
				'name' => 'price',
				'label' => 'Price',
				'type' => 'number',
				'prefix' => '₱'
			]
		);
	}


	public function store(ServiceStoreRequest $request)
	{
		return parent::storeCrud();
	}

	public function update(ServiceUpdateRequest $request)
	{
		return parent::updateCrud();
	}
}
