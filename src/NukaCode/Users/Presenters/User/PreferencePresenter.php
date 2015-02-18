<?php namespace NukaCode\Users\Presenters\User;

use NukaCode\Core\Presenters\BasePresenter;

class PreferencePresenter extends BasePresenter {

    public function hidden()
    {
        return $this->hiddenFlag == 1 ? 'Hidden' : null;
    }
}