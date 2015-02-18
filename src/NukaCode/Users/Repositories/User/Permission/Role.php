<?php namespace NukaCode\Users\Repositories\User\Permission;

use NukaCode\Users\Models\User\Permission\Role as RoleModel;
use NukaCode\Core\Repositories\BaseRepository;

class Role extends BaseRepository {

    /**
     * @var \NukaCode\Users\Models\User\Permission\Role
     */
    private $role;

    public function __construct(RoleModel $role)
    {
        $this->model = $role;
    }
} 