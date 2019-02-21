<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ClientTypeRequest as StoreRequest;
use App\Http\Requests\ClientTypeRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class ClientTypeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ClientTypeCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\UserType');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/client-types');
        $this->crud->setEntityNameStrings('clienttype', 'client_types');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
        $this->setPermissions();


        $this->crud->enableAjaxTable();

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // add asterisk for fields that are required in ClientTypeRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function setPermissions(){
        // Get authenticated user
        $user = backpack_user();

        // Deny all accesses
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // Allow list access
        if ($user->can('list_client_types')) {
            $this->crud->allowAccess('list');
        }

        // Allow create access
        if ($user->can('create_client_type')) {
            $this->crud->allowAccess('create');
        }

        // Allow update access
        if ($user->can('update_client_type')) {
            $this->crud->allowAccess('update');
        }

        // Allow reorder access
        if ($user->can('reorder_client_types')) {
            $this->crud->allowAccess('reorder');
        }

        // Allow delete access
        if ($user->can('delete_client_type')) {
            $this->crud->allowAccess('delete');
        }
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
