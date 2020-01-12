<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NoticeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class NoticeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class NoticeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Notice');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/notice');
        $this->crud->setEntityNameStrings('notice', 'notices');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
        $this->crud->removeColumn('file');

        $this->crud->addColumn([  
          'name' => 'file',
          'label' => 'file',
          'type' => 'image',
        ]);
      
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(NoticeRequest::class);
      
        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
        $this->crud->removeField('details');
        $this->crud->removeField('department_id');
        $this->crud->removeField('publish_at');
        $this->crud->removeField('status');
        $this->crud->removeField('file');
        $this->crud->addField([   // CKEditor
          'name' => 'details',
          'label' => 'details',
          'type' => 'ckeditor',
        ]);

        $this->crud->addField([   // CKEditor
            'name' => 'file',
            'label' => 'file',
            'upload' => true,
            'crop' => true,
            'type' => 'image',
            'disk' => 'local',
        ]);

        $this->crud->addField([   // CKEditor
            'name' => 'status',
            'label' => 'Status',
            'type' => 'enum'
        ]);

        $this->crud->addField([   // CKEditor
            'name' => 'publish_at',
            'label' => 'Publish_at',
            'type' => 'date_picker'
        ]);

        $this->crud->addField([   // CKEditor
            'name' => 'department_id',
            'label' => 'Department',
            'type' => 'select',
            'entity' => 'department', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Department" // foreign key model
        ]);

        $this->crud->removeField('created_by');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
