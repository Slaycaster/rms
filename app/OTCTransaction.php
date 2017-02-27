<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class OTCTransaction extends Model
{
    use CrudTrait;
    /*
	-----------------------------------------------------
		GLOBAL VARIABLES
	-----------------------------------------------------
	*/    

	//Table name in the database
	protected $table = 'otc_transactions';
	protected $primaryKey = 'id';
	//protected $hidden = ['id'];
	protected $fillable = ['invoice_id', 'customer', 'customer_contact', 'customer_address', 'branch_id', 'promo_id', 'user_id', 'price', 'stylist_id'];

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

	public function promo()
	{
		return $this->belongsTo('App\Promo', 'promo_id', 'id');
	}
	
	public function user()
	{
		return $this->belongsTo('App\User', 'user_id', 'id');
	}

	public function stylist()
	{
		return $this->belongsTo('App\Stylist', 'stylist_id', 'id');
	}

	public function otc_sales()
	{
		return $this->hasMany('App\OTCSale', 'otc_transaction_id');
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
