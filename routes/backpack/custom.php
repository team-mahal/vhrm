<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', ''),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::get('dashboard',"AdminController@dashboard");
    Route::get('taskst',"AdminController@taskst");
    Route::get('issue1',"IssueCrudController@issue1");
    Route::get('attendances',"AdminController@attendances");
    Route::get('attendances/update/{id}',"AdminController@attendancesupdate");
    Route::post('checkin',"AdminController@checkin");
    Route::crud('client', 'ClientCrudController');
    Route::crud('project', 'ProjectCrudController');
    Route::crud('issue', 'IssueCrudController');
    Route::crud('task', 'TaskCrudController');
    Route::crud('department', 'DepartmentCrudController');
    Route::crud('designation', 'DesignationCrudController');
    Route::crud('notice', 'NoticeCrudController');
    Route::crud('weekend', 'WeekendCrudController');
    Route::crud('holiday', 'HolidayCrudController');
    Route::crud('issues_type', 'Issues_typeCrudController');
    Route::crud('status', 'StatusCrudController');
    Route::crud('attendance', 'AttendanceCrudController');
}); // this should be the absolute last line of this file