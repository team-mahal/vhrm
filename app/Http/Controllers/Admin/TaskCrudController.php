<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TaskRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TaskCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class TaskCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Task');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/task');
        $this->crud->setEntityNameStrings('task', 'tasks');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(
            [    // Select
                'name' => 'issue.title',
                'label' => 'Issue',
                'orderable' => true,
                'orderLogic' => function ($query, $column, $columnDirection) {
                    return $query->Join('issues', 'issues.id', '=', 'tasks.issue_id')
                        ->orderBy('issues.id', $columnDirection)->select('tasks.*');
                }
            ]
        );

        $this->crud->addColumn(
            [    // Select
                'name' => 'user.name',
                'label' => 'Employee',
                'orderable' => true,
                'orderLogic' => function ($query, $column, $columnDirection) {
                    return $query->Join('users', 'users.id', '=', 'tasks.user_id')
                        ->orderBy('users.id', $columnDirection)->select('tasks.*');
                }
            ]
        );
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();

        $this->crud->removeColumn('issue_id');
        $this->crud->removeColumn('user_id');

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(TaskRequest::class);

        $this->crud->addField(
            [  // Select
               'label' => "Issues",
               'type' => 'select',
               'name' => 'issue_id', // the db column for the foreign key
               'entity' => 'issue', // the method that defines the relationship in your Model
               'attribute' => 'title', // foreign key attribute that is shown to user
               'model' => "App\Models\Issue" // foreign key model
            ]
        );

        $this->crud->addField(
            [  // Select
               'label' => "Employee",
               'type' => 'select',
               'name' => 'user_id', // the db column for the foreign key
               'entity' => 'user', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model' => "App\User" // foreign key model
            ]
        );

        $this->crud->addField(
            [  // Select
               'label' => "Status",
               'type' => 'select',
               'name' => 'status_id', // the db column for the foreign key
               'entity' => 'Status', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model' => "App\Models\Status" // foreign key model
            ]
        );

        $this->crud->addField(
            [  // Select
               'label' => "start_date",
               'type' => 'datetime_picker',
               'name' => 'start_date', // the db column for the foreign key
            ]
        );
        $this->crud->addField(
            [  // Select
               'label' => "end_date",
               'type' => 'datetime_picker',
               'name' => 'end_date', // the db column for the foreign key
            ]
        );
        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
        $this->crud->removeField('created_by');
        $this->crud->removeField('careated_at');

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
