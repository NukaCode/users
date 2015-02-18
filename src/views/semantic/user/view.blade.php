<style>
	.bg-inverse {
		background-color: #444;
		color: #fff;
	}
</style>
<div class="jumbotron" style="margin-left: -5%;margin-right: -5%;margin-bottom: 0;">
	<div class="row">
		<div class="col-md-4">
			{{ HTML::image($user->present()->image, null, ['class'=> 'media-object pull-left', 'style' => 'width: 150px;']) }}
		</div>
		<div class="col-md-4">
			<strong>Roles</strong>
			<ul class="list-unstyled">
				@foreach ($user->roles as $role)
					<li>{{ $role->fullName }}</li>
				@endforeach
			</ul>
		</div>
		<div class="col-md-4">
			<table class="table table-hover table-condensed table-inner">
				<tbody>
				<tr>
					<td style="width: 100px;"><strong>Username:</strong></td>
					<td>{{ $user->present()->username }}</td>
				</tr>
				<tr>
					<td><strong>Full Name:</strong></td>
					<td>{{ $user->present()->fullName }}</td>
				</tr>
				<tr>
					<td><strong>Email:</strong></td>
					<td>{{ $user->present()->emailLink }}</td>
				</tr>
				<tr>
					<td><strong>Join Date:</strong></td>
					<td>{{ $user->present()->createdAtReadable }}</td>
				</tr>
				<tr>
					<td><strong>Last Active:</strong></td>
					<td>{{ $user->present()->lastActiveReadable }}</td>
				</tr>
				<tr>
					<td><strong>Status:</strong></td>
					<td>{{ $user->present()->online }}</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="jumbotron bg-inverse" style="margin-left: -5%;margin-right: -5%;padding: 10px 60px;">
	<div class="row">
		<div class="col-md-6">
				<h2>{{ $user->present()->username }}'s Profile</h2>
			@if (Auth::check() && $user->id == Auth::user()->id)
				<div class="pull-right">
					{{ HTML::link('user/account', 'Edit') }}
				</div>
			@endif
		</div>
	</div>
</div>
@yield('userStats')