<div class="panel panel-inverse">
    <div class="panel-heading">
        <div class="panel-title">Create New Role</div>
    </div>
    <div class="panel-body">
        {{ bForm::open(false) }}
            {{ bForm::text('group', null, null, 'Group') }}
            {{ bForm::text('name', null, null, 'Name') }}
            {{ bForm::text('keyName', null, null, 'Key Name') }}
            {{ bForm::text('priority', null, null, 'Priority') }}
            {{ bForm::select2('actions[]', $actions, null, ['multiple' => 'multiple'], 'Actions', 'Select Actions') }}
            {{ bForm::submit('Save Role') }}
        {{ bForm::close() }}
    </div>
</div>