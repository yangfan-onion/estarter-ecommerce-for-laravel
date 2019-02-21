<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ClientAreaRequest as StoreRequest;
use App\Http\Requests\ClientAreaRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class ClientAreaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ClientAreaCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\UserArea');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/client-areas');
        $this->crud->setEntityNameStrings('clientarea', 'client_areas');

        $this->crud->enableReorder('name', 0);
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumns([
            [
                'name'  => 'name',
                'label' => trans('client_area.name'),
            ]
        ]);

        $this->setPermissions();



        
        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // add asterisk for fields that are required in ClientAreaRequest
        // $this->crud->setRequiredFields(StoreRequest::class, 'create');
        // $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
        $this->crud->enableAjaxTable();
    }

    public function setPermissions(){
        // Get authenticated user
        $user = backpack_user();

        // Deny all accesses
        $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // Allow list access
        if ($user->can('list_client_areas')) {
            $this->crud->allowAccess('list');
        }

        // Allow create access
        if ($user->can('create_client_area')) {
            $this->crud->allowAccess('create');
        }

        // Allow update access
        if ($user->can('update_client_area')) {
            $this->crud->allowAccess('update');
        }

        // Allow reorder access
        if ($user->can('reorder_client_areas')) {
            $this->crud->allowAccess('reorder');
        // }

        // Allow delete access
        if ($user->can('delete_client_area')) {
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
