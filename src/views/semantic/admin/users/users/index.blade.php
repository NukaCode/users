<div class="text-right">
    {{ HTML::linkRoute('admin.user.user.create', 'Create New User', [], ['class' => 'btn btn-primary']) }}
</div>
<br />
<div class="panel panel-inverse">
    <div class="panel-heading">
        Users
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Roles</th>
        </tr>
        </thead>
        <tbody>
            @each('admin.user.user.partials.row', $users, 'user', 'raw|No users exist.')
        </tbody>
    </table>
</div>
@if ($users->total() > $users->perPage())
    <div class="text-center">
        {{ $users->render() }}
    </div>
@endif

<script>
    @section('onReadyJs')
        $('.viewDetails').popover({
            trigger: 'hover',
            html: true
        });
    @stop
</script>