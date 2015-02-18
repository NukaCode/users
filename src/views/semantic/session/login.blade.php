<div class="row">
	<div class="col-md-offset-3 col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Login</div>
			<div class="panel-body">
				{{ bForm::open() }}
					{{ bForm::text('username', null, array('id' => 'username', 'required' => 'required'), 'Username', 4) }}
					{{ bForm::password('password', array('id' => 'password', 'required' => 'required'), 'Password', 4) }}
					<div class="form-group">
						<div class="col-md-offset-2 col-md-10">
							{{ Form::submit('Login', ['class' => 'btn btn-primary']) }}
							{{ HTML::linkRoute('register', 'Register', [], ['class' => 'btn btn-info']) }}
						</div>
					</div>
				{{ bForm::close() }}
			</div>
		</div>
	</div>
</div>