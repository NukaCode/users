<?php namespace NukaCode\Users\Presenters\User\Permission;

use NukaCode\Core\Presenters\BasePresenter;

/**
 * @property string $group
 * @property string $name
 * @property \NukaCode\Core\Collection $actions
 */
class RolePresenter extends BasePresenter {

    public function fullname()
    {
        return $this->group .' - '. $this->name;
    }

    public function actionList()
    {
        if ($this->actions->count() > 0) {
            return implode('<br />', $this->actions->name->toArray());
        }

        return 'None';
    }
}