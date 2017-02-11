<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class OTCItem extends Model
{
    use CrudTrait;

    /*
	-----------------------------------------------------
		GLOBAL VARIABLES
	-----------------------------------------------------
	*/    

	//Table name in the database
	protected $table = 'otc_items';
	protected $primaryKey = 'id';
	protected $hidden = ['created_at', 'updated_at'];
	protected $fillable = ['otc_item_name', 'otc_item_stock', 'otc_unit_of_measurement', 'otc_item_price', 'branch_id'];

	/*
	-----------------------------------------------------
		FUNCTIONS
	-----------------------------------------------------
	*/

	/*
	-----------------------------------------------------
		RELATIONSHIPS
	-----------------------------------------------------
	*/	

	public function branch()
	{
		return $this->belongsTo('App\Branch', 'branch_id', 'id');
	}

	/*
	-----------------------------------------------------
		SCOPES
	-----------------------------------------------------
	*/		

	/*
	-----------------------------------------------------
		ACCESSORS
	-----------------------------------------------------
	*/

	/*
	-----------------------------------------------------
		MUTATORS
	-----------------------------------------------------
	*/		
}
