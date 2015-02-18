<div class="panel panel-inverse">
    <div class="panel-heading">
        <div class="panel-title">Create New Action</div>
    </div>
    <div class="panel-body">
        {{ bForm::open(false) }}
            {{ bForm::text('name', null, null, 'Name') }}
            {{ bForm::text('keyName', null, null, 'Key Name') }}
            {{ bForm::textarea('description', null, ['style' => 'height: 100px'], 'Description') }}
            {{ bForm::select2('roles[]', $roles, null, ['multiple' => 'multiple'], 'Roles', 'Select Roles') }}
            {{ bForm::submit('Save Action') }}
        {{ bForm::close() }}
    </div>
</div>