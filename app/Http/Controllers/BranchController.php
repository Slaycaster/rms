<?php

namespace App\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

/*
----------------------------------------------------------------------------------------------
	VALIDATION: change the requests to match your own file names if you need form validation
----------------------------------------------------------------------------------------------
*/
use App\Http\Requests\BranchStoreRequest as BranchStoreRequest;
use App\Http\Requests\BranchUpdateRequest as BranchUpdateRequest;

class BranchController extends CrudController
{
	
	public function __construct()
	{
		parent::__construct();

		$this->crud->setModel('App\Branch');
		$this->crud->setRoute('branches');
		$this->crud->setEntityNameStrings('branch', 'branches');

		$this->crud->setColumns
		(
			[
				
					[
						'name' => 'branch_name',
						'label' => 'Branch Name'
					],
				

					[
						'name' => 'branch_address',
						'label' => 'Address'
					]
				
			]
		);

		$this->crud->addField
		(
			[
				//Text
				'name' => 'branch_name',
				'label' => 'Branch Name',
				'type' => 'text'
			]
		);

		$this->crud->addField
		(
			[
				//Text
				'name' => 'branch_address',
				'label' => 'Address',
				'type' => 'text'
			]
		);
	}

	public function store(BranchStoreRequest $request)
	{
		return parent::storeCrud();
	}
	public function update(BranchUpdateRequest $request)
	{
		return parent::updateCrud();
	}
}