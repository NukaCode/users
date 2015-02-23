<?php namespace NukaCode\Users\Controllers\Admin;

use NukaCode\Admin\Controllers\AdminController;
use NukaCode\Users\Http\Requests\Admin\Edit\Role as EditRole;
use NukaCode\Users\Models\User\Permission\Action;
use NukaCode\Users\Models\User\Permission\Role;

class RoleController extends AdminController {

    /**
     * @var \User
     */
    private $role;

    /**
     * @param Role $role
     *
     */
    public function __construct(Role $role)
    {
        parent::__construct();

        $this->role = $role;
    }

    public function index()
    {
        $roles = $this->role->paginate(10);

        $this->setViewData(compact('roles'));
    }

    public function getEdit(Action $action, $id)
    {
        $role    = $this->role->find($id);
        $actions = $action->orderByNameAsc()->get()->toSelectArray(false);

        $this->setViewData(compact('role', 'actions'));
    }

    public function postEdit(EditRole $request, $id)
    {
        // Update the user
        $role = $this->role->find($request->only('id'));
        $role->update($request->except('actions'));
        $role->setActions($request->get('actions'));

        // Send the response
        return \Redirect::route('admin.user.role.index')->with('message', 'Role updated.');
    }

    public function getCreate(Action $action)
    {
        $actions = $action->orderByNameAsc()->get()->toSelectArray(false);

        $this->setViewData(compact('actions'));
    }

    public function postCreate(EditRole $request)
    {
        // Create the Role
        $role = $this->role->create($request->except('actions'));
        $role->setActions($request->get('actions'));

        // Send the response
        return \Redirect::route('admin.user.role.index')->with('message', 'Role created.');
    }

    public function getDelete($id)
    {
        $this->skipView();

        $role = $this->role->find($id);
        $role->delete();

        return \Redirect::route('admin.user.role.index')->with('message', 'Role deleted.');
    }
}
