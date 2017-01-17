<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Stylist extends Model
{
    use CrudTrait;

    /*
	-----------------------------------------------------
		GLOBAL VARIABLES
	-----------------------------------------------------
	*/    

	//Table name in the database
	protected $table = 'stylists';
	protected $primaryKey = 'id';
	protected $hidden = ['created_at', 'updated_at'];
	protected $fillable = ['stylist_last_name', 'stylist_first_name', 'stylist_middle_name', 'stylist_address', 'stylist_contact_no', 'stylist_email', 'date_hired', 'branch_id'];

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

	public function transactions()
	{
		return $this->hasMany('App\Transactions', 'stylist_id');
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
