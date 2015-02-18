<div class="ui right floated basic segment">
    {{ HTML::linkRoute('admin.user.role.create', 'Create New Role', [], ['class' => 'ui primary button']) }}
</div>
<br />
<h4 class="ui top attached inverted header">
    Roles
</h4>
<table class="ui table attached bottom">
    <thead>
        <tr>
            <th>Name</th>
            <th>Key Name</th>
            <th>Priority</th>
            <th>Actions</th>
            <th class="two wide">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @each('admin.users.role.partials.row', $roles, 'role', 'raw|No roles exist.')
    </tbody>
</table>
@if ($roles->total() > $roles->perPage())
    <div class="text-center">
        {{ $roles->render() }}
    </div>
@endif

<script>
    @section('onReadyJs')
        $('.viewDetails').popup({
            on: 'hover',
            position: 'right center'
        });
    @stop
</script>