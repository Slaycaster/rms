<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Sale extends Model
{
    use CrudTrait;

    /*
	-----------------------------------------------------
		GLOBAL VARIABLES
	-----------------------------------------------------
	*/    

	//Table name in the database
	protected $table = 'sales';
	protected $primaryKey = 'id';
	protected $hidden = ['id'];
	protected $fillable = ['service_id', 'transaction_id', 'promo_id', 'price', 'additional_charge'];

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

	public function used_stylists()
	{
		return $this->hasMany('App\UsedStylist', 'sale_id');
	}

	public function service()
	{
		return $this->belongsTo('App\Service', 'service_id', 'id');
	}

	public function transaction()
	{
		return $this->belongsTo('App\Transaction', 'transaction_id', 'id');
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
