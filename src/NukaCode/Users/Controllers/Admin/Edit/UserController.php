<?php namespace NukaCode\Users\Controllers\Admin\Edit;

use NukaCode\Users\Http\Requests\Admin\Edit\User;
use NukaCode\Users\Models\User\Permission\Role;
use NukaCode\Core\Ajax\Ajax;
use NukaCode\Users\Repositories\User\Permission\RoleRepository;
use NukaCode\Users\Repositories\UserRepository;

class UserController extends \BaseController {

	/**
	 * @var UserRepositoryInterface
	 */
	private $userRepo;

	/**
	 * @var Ajax
	 */
	private $ajax;

	public function __construct(UserRepository $userRepo, Ajax $ajax)
	{
		parent::__construct();

		$this->userRepo = $userRepo;
		$this->ajax     = $ajax;
	}

	public function getIndex(RoleRepository $roleRepo, $id)
	{
		$user  = $this->userRepo->find($id);
		$roles = $roleRepo->orderByName()->toSelectArray(false, 'id', 'fullName');

		$this->setViewData(compact('user', 'roles'));
	}

	public function postIndex(User $request, $id)
	{
		// Update the user
		$this->userRepo->findFirst($request->only('id'));
		$this->userRepo->update($request->except('roles'));
		$this->userRepo->setRoles($request->get('roles'));

		// Send the response
		return $this->ajax->sendResponse();
	}

} 