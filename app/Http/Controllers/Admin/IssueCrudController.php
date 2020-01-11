<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\IssueRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\User;
use App\Models\Project;
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
         $this->crud->addFilter([
            'type'  => 'date_range',
            'name'  => 'deadline',
            'label' => 'Dead line'
        ],
            false,
            function ($value) { // if the filter is active, apply these constraints
                    $dates = json_decode($value);
                    $this->crud->addClause('where', 'deadline', '>=', $dates->from);
                    $this->crud->addClause('where', 'deadline', '<=', $dates->to);
            });

        $this->crud->addFilter([
          'name' => 'status',
          'type' => 'select2_multiple',
          'label'=> 'Project'
        ], function() {
            $arrayName = array();
            foreach (Project::all() as $key => $value) {
                $arrayName[$value->id]=$value->name;
            }
            return $arrayName;
        }, function($values) { // if the filter is active
            foreach (json_decode($values) as $key => $value) {
                $this->crud->addClause('where', 'project_id', $value);
            }
        });
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->addColumn(
            [    // Select
                'name' => 'project.name',
                'label' => 'Project',
                'orderable' => true,
                'orderLogic' => function ($query, $column, $columnDirection) {
                    return $query->Join('projects', 'projects.id', '=', 'issues.project_id')
                        ->orderBy('projects.id', $columnDirection)->select('issues.*');
                }
            ]
        );

        $this->crud->addColumn(
            [    // Select
                'name' => 'issues_type.name',
                'label' => 'Issues_type',
                'orderable' => true,
                'orderLogic' => function ($query, $column, $columnDirection) {
                    return $query->Join('issues_types', 'issues_types.id', '=', 'issues.issues_type_id')
                        ->orderBy('issues_types.id', $columnDirection)->select('issues.*');
                }
            ]
        );

        $this->crud->setFromDb();

        $this->crud->removeColumn('project_id');
        $this->crud->removeColumn('issues_type_id');

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
        $this->crud->addField(
            [  // Select
               'label' => "Issues_type",
               'type' => 'select',
               'name' => 'issues_type_id', // the db column for the foreign key
               'entity' => 'Issues_type', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model' => "App\Models\Issues_type" // foreign key model
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
               'label' => "deadline",
               'type' => 'date_picker',
               'name' => 'deadline', // the db column for the foreign key
            ]
        );
        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
        $this->crud->removeField('created_by');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
