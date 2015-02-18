<?php namespace NukaCode\Users\Controllers\Admin\User;

use NukaCode\Users\Repositories\User\Permission\ActionRepository;
use NukaCode\Users\Repositories\User\Permission\RoleRepository;
use NukaCode\Users\Repositories\User\PreferenceRepository;
use NukaCode\Users\Repositories\UserRepository;
use Session;

class UserController extends \BaseController {

    /**
     * @var UserRepository
     */
    private $userRepo;

    /**
     * @var RoleRepository
     */
    private $roleRepo;

    /**
     * @var ActionRepository
     */
    private $actionRepo;

    /**
     * @var PreferenceRepository
     */
    private $preferenceRepo;

    /**
     * @param UserRepository       $userRepo
     * @param RoleRepository       $roleRepo
     * @param ActionRepository     $actionRepo
     * @param PreferenceRepository $preferenceRepo
     */
    public function __construct(UserRepository $userRepo, RoleRepository $roleRepo,
                                ActionRepository $actionRepo, PreferenceRepository $preferenceRepo)
    {
        parent::__construct();

        $this->userRepo       = $userRepo;
        $this->roleRepo       = $roleRepo;
        $this->actionRepo     = $actionRepo;
        $this->preferenceRepo = $preferenceRepo;
    }

    public function index()
    {
        $userCount       = $this->userRepo->model->count();
        $roleCount       = $this->roleRepo->model->count();
        $actionCount     = $this->actionRepo->model->count();
        $preferenceCount = $this->preferenceRepo->model->count();

        $users       = $this->userRepo->paginate(10);
        $roles       = $this->roleRepo->paginate(10);
        $actions     = $this->actionRepo->paginate(10);
        $preferences = $this->preferenceRepo->paginate(10);

        $this->setViewData(compact('userCount', 'roleCount', 'actionCount', 'preferenceCount', 'users', 'roles', 'actions', 'preferences'));
    }

    public function userCustomize()
    {
        $users = $this->userRepo->paginate(10);

        $this->setViewPath('admin.user.customize.user.table');
        $this->setViewData(compact('users'));
    }

    public function roleCustomize()
    {
        $roles = $this->roleRepo->paginate(10);

        $this->setViewPath('admin.user.customize.role.table');
        $this->setViewData(compact('roles'));
    }

    public function actionCustomize()
    {
        $actions = $this->actionRepo->paginate(10);

        $this->setViewPath('admin.user.customize.action.table');
        $this->setViewData(compact('actions'));
    }

    public function preferenceCustomize()
    {
        $preferences = $this->preferenceRepo->paginate(10);

        $this->setViewPath('admin.user.customize.preference.table');
        $this->setViewData(compact('preferences'));
    }
}