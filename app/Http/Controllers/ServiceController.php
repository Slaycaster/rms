<?php

namespace App\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

/*
----------------------------------------------------------------------------------------------
	VALIDATION: change the requests to match your own file names if you need form validation
----------------------------------------------------------------------------------------------
*/
use App\Http\Requests\ServiceRequest as ServiceRequest;

class ServiceController extends CrudController
{
	public function __construct()
	{
		parent::__construct();

		$this->crud->setModel('App\Service');
		$this->crud->setRoute('admin/services');
		$this->crud->setEntityNameStrings('service', 'services');

		$this->crud->setColumns(['service_name', 'sub_description', 'service_type_id', 'price']);
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
				'prefix' => '₱',
				'suffix' => '.00'
			]
		);
	}


	public function store(ServiceRequest $request)
	{
		return parent::storeCrud();
	}

	public function update(ServiceRequest $request)
	{
		return parent::updateCrud();
	}
}
