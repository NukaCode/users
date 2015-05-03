<?php namespace NukaCode\Users\Models\Observers\User\Preference;

class UserObserver {

    public function saving($model)
    {
        $model->validateValue();
    }
}