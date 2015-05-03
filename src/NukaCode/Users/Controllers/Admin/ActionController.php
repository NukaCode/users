<?php namespace NukaCode\Users\Controllers\Admin;

use NukaCode\Admin\Controllers\AdminController;
use NukaCode\Users\Http\Requests\Admin\Edit\Action as EditAction;
use NukaCode\Users\Models\User\Permission\Action;
use NukaCode\Users\Models\User\Permission\Role;

class ActionController extends AdminController {

    /**
     * @var \User
     */
    private $action;

    /**
     * @param Action $action
     *
     */
    public function __construct(Action $action)
    {
        parent::__construct();

        $this->action = $action;
    }

    public function index()
    {
        $actions = $this->action->paginate(10);

        $this->setViewData(compact('actions'));
    }

    public function getEdit(Role $role, $id)
    {
        $action = $this->action->find($id);
        $roles  = $role->orderByNameAsc()->get()->toSelectArray(false, 'id', 'fullName');

        $this->setViewData(compact('action', 'roles'));
    }

    public function postEdit(EditAction $request, $id)
    {
        // Update the user
        $action = $this->action->find($request->only('id'));
        $action->update($request->except('roles'));
        $action->setRoles($request->get('roles'));

        // Send the response
        return \Redirect::route('admin.user.action.index')->with('message', 'Action updated.');
    }

    public function getCreate(Role $role)
    {
        $roles = $role->orderByNameAsc()->get()->toSelectArray(false, 'id', 'fullName');

        $this->setViewData(compact('roles'));
    }

    public function postCreate(EditAction $request)
    {
        // Create the Action
        $action = $this->action->create($request->except('roles'));
        $action->setRoles($request->get('roles'));

        // Send the response
        return \Redirect::route('admin.user.action.index')->with('message', 'Action created.');
    }

    public function getDelete($id)
    {
        $action = $this->action->find($id);
        $action->delete();

        return \Redirect::route('admin.user.action.index')->with('message', 'Action deleted.');
    }
}
