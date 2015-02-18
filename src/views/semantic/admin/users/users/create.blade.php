<div class="panel panel-inverse">
    <div class="panel-heading">
        <div class="panel-title">Create New User</div>
    </div>
    <div class="panel-alert panel-alert-info">
        The password will be set to changeme.
    </div>
    <div class="panel-body">
        {{ bForm::open(false) }}
            {{ bForm::text('username', null, null, 'Username') }}
            {{ bForm::email('email', null, null, 'Email') }}
            {{ bForm::text('firstName', null, null, 'First Name') }}
            {{ bForm::text('lastName', null, null, 'Last Name') }}
            {{ bForm::select2('roles[]', $roles, null, ['multiple' => 'multiple'], 'Roles', 'Select Roles') }}
            {{ bForm::submit('Save User') }}
        {{ bForm::close() }}
    </div>
</div>