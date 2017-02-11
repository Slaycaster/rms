<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class OTCSale extends Model
{
    use CrudTrait;

    /*
	-----------------------------------------------------
		GLOBAL VARIABLES
	-----------------------------------------------------
	*/    

	//Table name in the database
	protected $table = 'otc_sales';
	protected $primaryKey = 'id';
	protected $hidden = ['id'];
	protected $fillable = ['otc_item_id', 'otc_transaction_id', 'quantity', 'promo_id', 'price', 'additional_charge'];

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

	public function otc_item()
	{
		return $this->belongsTo('App\OTCItem', 'otc_item_id', 'id');
	}

	public function otc_transaction()
	{
		return $this->belongsTo('App\OTCTransaction', 'otc_transaction_id', 'id');
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
