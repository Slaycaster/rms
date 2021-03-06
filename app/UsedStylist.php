<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class UsedStylist extends Model
{
    use CrudTrait;

    /*
	-----------------------------------------------------
		GLOBAL VARIABLES
	-----------------------------------------------------
	*/    

	//Table name in the database
	protected $table = 'used_stylists';
	protected $primaryKey = 'id';
	protected $hidden = ['id'];
	protected $fillable = ['stylist_id', 'sale_id'];

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

	public function stylist()
	{
		return $this->belongsTo('App\Stylist', 'stylist_id', 'id');
	}

	public function sale()
	{
		return $this->belongsTo('App\Sale', 'sale_id', 'id');
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
