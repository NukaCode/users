<div class="panel panel-inverse">
    <div class="panel-heading">
        <div class="panel-title">Edit {{ $role->present()->fullName }}</div>
    </div>
    <div class="panel-body">
        {{ bForm::open(false) }}
            {{ bForm::text('id', $role->id, ['readonly' => 'readonly'], 'Id') }}
            {{ bForm::text('group', $role->group, null, 'Group') }}
            {{ bForm::text('name', $role->name, null, 'Name') }}
            {{ bForm::text('keyName', $role->keyName, null, 'Key Name') }}
            {{ bForm::text('priority', $role->priority, null, 'Priority') }}
            {{ bForm::select2('actions[]', $actions, $role->actions->id->toArray(), ['multiple' => 'multiple'], 'Actions', 'Select Actions') }}
            {{ bForm::submit('Save Changes') }}
        {{ bForm::close() }}
    </div>
</div>