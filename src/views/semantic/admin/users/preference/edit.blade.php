<div class="panel panel-inverse">
    <div class="panel-heading">
        <div class="panel-title">Edit {{ $preference->present()->name }}</div>
    </div>
    <div class="panel-body">
        {{ bForm::open(false) }}
            {{ bForm::text('id', $preference->id, ['readonly' => 'readonly'], 'Id') }}
            {{ bForm::text('name', $preference->name, null, 'Name') }}
            {{ bForm::text('keyName', $preference->keyName, null, 'Key Name') }}
            {{ bForm::textarea('description', $preference->description, ['style' => 'height: 100px'], 'Description') }}
            {{ bForm::text('value', $preference->value, null, 'Value') }}
            {{ bForm::text('default', $preference->default, null, 'Default') }}
            {{ bForm::select('display', ['select' => 'Select', 'text' => 'Text', 'textarea' => 'Text Area', 'radio' => 'Radio'], $preference->display, null, 'Display') }}
            {{ bForm::select('hiddenFlag', ['No', 'Yes'], $preference->hiddenFlag, null, 'Hidden?') }}
            {{ bForm::submit('Save Changes') }}
        {{ bForm::close() }}
    </div>
</div>