<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WeekendRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class WeekendCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class WeekendCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Weekend');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/weekend');
        $this->crud->setEntityNameStrings('weekend', 'weekends');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
        $this->crud->removeColumn('created_by');
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(WeekendRequest::class);
        $this->crud->addField([   // CKEditor
            'name' => 'department_id',
            'label' => 'Department',
            'type' => 'select',
            'entity' => 'department', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Department" // foreign key model
        ]);
        $this->crud->addField([   // CKEditor
            'name' => 'user_id',
            'label' => 'User',
            'type' => 'select',
            'entity' => 'User', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\User" // foreign key model
        ]);
        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
        $this->crud->removeField('created_by');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
