<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Task extends Model
{
	use CrudTrait;

	/*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

	protected $table = 'tasks';
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

	public function issue()
	{
		return $this->belongsTo("App\Models\Issue");
	}

	public function user()
	{
		return $this->belongsTo("App\User");
	}

	public function status()
	{
		return $this->belongsTo("App\Models\Status");
	}

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

	// public static function boot()
	// {
	// 	parent::boot();
	// 	static::creating(function($model)
	// 	{
	// 			 $user = Auth::user();
	// 			 $model->created_by = $user->id;
	// 			 $model->created_by = $user->id;
	// 	});
	// 	static::updating(function($model)
	// 	{
	// 			 $user = Auth::user();
	// 			 $model->created_by = $user->id;
	// 	});
 // 	}
}
