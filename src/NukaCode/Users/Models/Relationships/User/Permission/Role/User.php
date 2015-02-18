<?php namespace NukaCode\Users\Models\Relationships\User\Permission\Role;


trait User {

    public function user()
    {
        return $this->belongsTo('NukaCode\Users\Models\User', 'user_id');
    }

    public function role()
    {
        return $this->belongsTo('NukaCode\Users\Models\User\Permission\Role', 'role_id');
    }
}