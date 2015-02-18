<h4 class="ui header inverted attached top">
    Edit {{ $role->present()->fullName }}
</h4>
<div class="ui segment attached">
    {{ bForm::open(false) }}
        {{ bForm::text('id', $role->id, ['readonly' => 'readonly'], 'Id') }}
        {{ bForm::text('group', $role->group, null, 'Group') }}
        {{ bForm::text('name', $role->name, null, 'Name') }}
        {{ bForm::text('keyName', $role->keyName, null, 'Key Name') }}
        {{ bForm::text('priority', $role->priority, null, 'Priority') }}
        {{ bForm::select('actions[]', $actions, $role->actions->id->toArray(), ['multiple' => 'multiple'], 'Actions', 'Select Actions') }}
        {{ bForm::submit('Save Changes') }}
    {{ bForm::close() }}
</div>