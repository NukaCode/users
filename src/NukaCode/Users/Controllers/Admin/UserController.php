<?php namespace NukaCode\Users\Controllers\Admin;

use NukaCode\Core\Controllers\AdminController;
use NukaCode\Users\Http\Requests\Admin\Edit\User;
use NukaCode\Users\Models\User\Permission\Role;

class UserController extends AdminController {

	/**
	 * @var \User
	 */
	private $user;

	/**
	 * @param \User $user
	 */
	public function __construct(\User $user)
	{
		parent::__construct();

		$this->user = $user;
	}

	public function index()
	{
		$users = $this->user->paginate(10);

		$this->setViewData(compact('users'));
	}

	public function getEdit(Role $role, $id)
	{
		$user  = $this->user->find($id);
		$roles = $role->orderByNameAsc()->get()->toSelectArray(false, 'id', 'fullName');

		$this->setViewData(compact('user', 'roles'));
	}

	public function postEdit(User $request, $id)
	{
		// Update the user
		$user = $this->user->find($request->only('id'));
		$user->update($request->except('roles'));
		$user->setRoles($request->get('roles'));

		// Send the response
		return \Redirect::route('admin.user.user.index')->with('message', 'User updated.');
	}

	public function getCreate(Role $role)
	{
		$roles = $role->orderByNameAsc()->get()->toSelectArray(false, 'id', 'fullName');

		$this->setViewData(compact('roles'));
	}

	public function postCreate(User $request)
	{
		// Update the user
		$details             = $request->except('roles');
		$details['password'] = 'changeme';
		$user                = $this->user->create($details);
		$user->setRoles($request->get('roles'));

		// Send the response
		return \Redirect::route('admin.user.user.index')->with('message', 'User created.');
	}

	public function getDelete($id)
	{
		$user = $this->user->find($id);
		$user->delete();

		return \Redirect::route('admin.user.user.index')->with('message', 'User deleted.');
	}
}
