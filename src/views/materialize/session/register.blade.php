<div class="row">
    <div class="col offset-s3 s6">
        <h4 class="center">Register</h4>
        {{ Form::open() }}
            {{ Form::groupOpen() }}
                {{ Form::text('username', null, ['id' => 'username', 'required' => 'required'], 'Username') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::password('password', ['id' => 'password', 'required' => 'required'], 'Password') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::email('email', null, ['id' => 'email', 'required' => 'required'], 'Email') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::submit('Complete Registration', ['class' => 'btn']) }}
            {{ Form::groupClose() }}
        {{ Form::close() }}
    </div>
</div>