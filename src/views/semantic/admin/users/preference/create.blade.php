<div class="panel panel-inverse">
    <div class="panel-heading">
        <div class="panel-title">Create New Preference</div>
    </div>
    <div class="panel-body">
        {{ bForm::open(false) }}
            {{ bForm::text('name', null, null, 'Name') }}
            {{ bForm::text('keyName', null, null, 'Key Name') }}
            {{ bForm::textarea('description', null, ['style' => 'height: 100px'], 'Description') }}
            {{ bForm::text('value', null, null, 'Value') }}
            {{ bForm::text('default', null, null, 'Default') }}
            {{ bForm::select('display', ['select' => 'Select', 'text' => 'Text', 'textarea' => 'Text Area', 'radio' => 'Radio'], 'select', null, 'Display') }}
            {{ bForm::select('hiddenFlag', ['No', 'Yes'], 0, null, 'Hidden?') }}
            {{ bForm::submit('Save Preference') }}
        {{ bForm::close() }}
    </div>
</div>