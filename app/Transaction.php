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
	protected $hidden = 'id';
	protected $fillable = ['customer_id', 'branch_id', 'date', 'promo_id', 'price'];

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