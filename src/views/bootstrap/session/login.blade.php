<div class="row">
	<div class="col-md-offset-3 col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Login</div>
			<div class="panel-body">
				{{ Form::open() }}
                    {{ Form::groupOpen() }}
					    {{ Form::text('username', null, ['id' => 'username', 'required' => 'required'], 'Username') }}
                    {{ Form::groupClose() }}
                    {{ Form::groupOpen() }}
					    {{ Form::password('password', ['id' => 'password', 'required' => 'required'], 'Password') }}
                    {{ Form::groupClose() }}
                    {{ Form::offsetGroupOpen() }}
                        {{ Form::submit('Login', ['class' => 'btn btn-primary']) }}
                        {{ HTML::linkRoute('register', 'Register', [], ['class' => 'btn btn-info']) }}
                    {{ Form::offsetGroupClose() }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>