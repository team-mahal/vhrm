<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProjectCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ProjectCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Project');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/project');
        $this->crud->setEntityNameStrings('project', 'projects');
       
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->addColumn(
            [    // Select
                'name' => 'client.name',
                'label' => 'client.name',
                'orderable' => true,
                'orderLogic' => function ($query, $column, $columnDirection) {
                    return $query->Join('clients', 'clients.id', '=', 'projects.client_id')
                        ->orderBy('clients.client_id', $columnDirection)->select('projects.*');
                }
            ]
        );
        $this->crud->setFromDb();

        $this->crud->removeColumn('client_id');
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ProjectRequest::class);

        $this->crud->addField(
            [  // Select
               'label' => "Clients",
               'type' => 'select',
               'name' => 'client_id', // the db column for the foreign key
               'entity' => 'client', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model' => "App\Models\Client" // foreign key model
            ]
        );
        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
