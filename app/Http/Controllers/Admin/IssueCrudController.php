<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\IssueRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class IssueCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class IssueCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Issue');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/issue');
        $this->crud->setEntityNameStrings('issue', 'issues');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->addColumn(
            [    // Select
                'name' => 'project.name',
                'label' => 'Project',
                'orderable' => true,
                'orderLogic' => function ($query, $column, $columnDirection) {
                    return $query->Join('projects', 'projects.id', '=', 'issues.project_id')
                        ->orderBy('projects.project_id', $columnDirection)->select('issues.*');
                }
            ]
        );
        $this->crud->setFromDb();

        $this->crud->removeColumn('project_id');

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(IssueRequest::class);
        $this->crud->addField(
            [  // Select
               'label' => "Projects",
               'type' => 'select',
               'name' => 'project_id', // the db column for the foreign key
               'entity' => 'project', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model' => "App\Models\Project" // foreign key model
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
