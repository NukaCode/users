<div class="panel panel-inverse">
    <div class="panel-heading">
        <div class="panel-title">Update {{ $user->present()->username }}</div>
    </div>
    <div class="panel-body">
        {{ bForm::open(false) }}
            {{ bForm::text('id', $user->id, ['readonly' => 'readonly'], 'Id') }}
            {{ bForm::text('username', $user->username, null, 'Username') }}
            {{ bForm::email('email', $user->email, null, 'Email') }}
            {{ bForm::text('firstName', $user->firstName, null, 'First Name') }}
            {{ bForm::text('lastName', $user->lastName, null, 'Last Name') }}
            {{ bForm::select2('roles[]', $roles, $user->roles->id->toArray(), ['multiple' => 'multiple'], 'Roles', 'Select Roles') }}
            {{ bForm::submit('Save Changes') }}
        {{ bForm::close() }}
    </div>
</div>