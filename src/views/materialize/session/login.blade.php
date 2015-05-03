<div class="row">
	<div class="col offset-s3 s6">
        <h4 class="center">Login</h4>
        {{ Form::open() }}
            {{ Form::groupOpen() }}
                {{ Form::text('username', null, ['id' => 'username', 'required' => 'required'], 'Username') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::password('password', ['id' => 'password', 'required' => 'required'], 'Password') }}
            {{ Form::groupClose() }}
            {{ Form::groupOpen() }}
                {{ Form::submit('Login', ['class' => 'btn']) }}
                {{ HTML::linkRoute('register', 'Register', [], ['class' => 'btn blue']) }}
            {{ Form::groupClose() }}
        {{ Form::close() }}
	</div>
</div>