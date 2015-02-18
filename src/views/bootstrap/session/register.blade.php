<div class="row">
	<div class="col-md-offset-3 col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Register</div>
			<div class="panel-body">
				{{ Form::open() }}
                    {{ Form::groupOpen() }}
                        {{ Form::text('username', null, array('id' => 'username', 'required' => 'required'), 'Username') }}
                    {{ Form::groupClose() }}
                    {{ Form::groupOpen() }}
                        {{ Form::password('password', array('id' => 'password', 'required' => 'required'), 'Password') }}
                    {{ Form::groupClose() }}
                    {{ Form::groupOpen() }}
                        {{ Form::email('email', null, array('id' => 'email', 'required' => 'required'), 'Email') }}
                    {{ Form::groupClose() }}
                    {{ Form::offsetGroupOpen() }}
                        {{ Form::submit('Complete Registration', ['class' => 'btn btn-primary']) }}
                        {{ Form::reset('Reset Fields', ['class' => 'btn btn-inverse']) }}
                    {{ Form::offsetGroupClose() }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>