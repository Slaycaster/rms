<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Transaction extends Model
{
    use CrudTrait;
    /*
	-----------------------------------------------------
		GLOBAL VARIABLES
	-----------------------------------------------------
	*/    

	//Table name in the database
	protected $table = 'transactions';
	protected $primaryKey = 'id';
	//protected $hidden = ['id'];
	protected $fillable = ['customer_id', 'branch_id', 'promo_id', 'user_id', 'price'];

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

	public function customer()
	{
		return $this->belongsTo('App\Customer', 'customer_id', 'id');
	}

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

	public function sales()
	{
		return $this->hasMany('App\Sale', 'transaction_id');
	}

	public function used_items()
	{
		return $this->hasMany('App\UsedItem', 'transaction_id');
	}

	public function used_stylists()
	{
		return $this->hasMany('App\UsedStylist', 'transaction_id');
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
