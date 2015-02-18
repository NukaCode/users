<?php namespace NukaCode\Users\Presenters\User\Permission;

use NukaCode\Core\Presenters\BasePresenter;

/**
 * @property \NukaCode\Core\Collection $roles
 */
class ActionPresenter extends BasePresenter {

    public function roleList()
    {
        if ($this->roles->count() > 0) {
            return implode('<br />', $this->roles->fullName->toArray());
        }

        return 'None';
    }
}