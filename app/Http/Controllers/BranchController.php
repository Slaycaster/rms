<?php

namespace App\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

/*
----------------------------------------------------------------------------------------------
	VALIDATION: change the requests to match your own file names if you need form validation
----------------------------------------------------------------------------------------------
*/
use App\Http\Requests\BranchRequest as BranchRequest;

class BranchController extends CrudController
{
	
	public function __construct()
	{
		parent::__construct();

		$this->crud->setModel('App\Branch');
		$this->crud->setRoute('admin/branches');
		$this->crud->setEntityNameStrings('branch', 'branches');

		$this->crud->setColumns(['branch_name', 'branch_address']);

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

	public function store(BranchRequest $request)
	{
		return parent::storeCrud();
	}
	public function update(BranchRequest $request)
	{
		return parent::updateCrud();
	}
}