<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Issues_type extends Model
{
		use CrudTrait;

		/*
		|--------------------------------------------------------------------------
		| GLOBAL VARIABLES
		|--------------------------------------------------------------------------
		*/

		protected $table = 'issues_types';
		// protected $primaryKey = 'id';
		// public $timestamps = false;
		protected $guarded = ['id'];
		// protected $fillable = [];
		// protected $hidden = [];
		// protected $dates = [];

		/*
		|--------------------------------------------------------------------------
		| FUNCTIONS
		|--------------------------------------------------------------------------
		*/

		/*
		|--------------------------------------------------------------------------
		| RELATIONS
		|--------------------------------------------------------------------------
		*/

		/*
		|--------------------------------------------------------------------------
		| SCOPES
		|--------------------------------------------------------------------------
		*/

		/*
		|--------------------------------------------------------------------------
		| ACCESSORS
		|--------------------------------------------------------------------------
		*/

		/*
		|--------------------------------------------------------------------------
		| MUTATORS
		|--------------------------------------------------------------------------
		*/

		public static function boot()
		{
			 parent::boot();
			 static::creating(function($model)
			 {
					 $user = Auth::user();
					 $model->created_by = $user->id;
					 $model->created_by = $user->id;
			 });
			 static::updating(function($model)
			 {
					 $user = Auth::user();
					 $model->created_by = $user->id;
			 });
	 	}
}
