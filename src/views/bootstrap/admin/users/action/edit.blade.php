<div class="panel panel-inverse">
    <div class="panel-heading">
        <div class="panel-title">Edit {{ $action->present()->name }}</div>
    </div>
    <div class="panel-body">
        {{ bForm::open(false) }}
            {{ bForm::text('id', $action->id, ['readonly' => 'readonly'], 'Id') }}
            {{ bForm::text('name', $action->name, null, 'Name') }}
            {{ bForm::text('keyName', $action->keyName, null, 'Key Name') }}
            {{ bForm::textarea('description', $action->description, ['style' => 'height: 100px'], 'Description') }}
            {{ bForm::select2('roles[]', $roles, $action->roles->id->toArray(), ['multiple' => 'multiple'], 'Roles', 'Select Roles') }}
            {{ bForm::submit('Save Changes') }}
        {{ bForm::close() }}
    </div>
</div>