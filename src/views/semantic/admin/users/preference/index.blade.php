<div class="text-right">
    {{ HTML::linkRoute('admin.user.preference.create', 'Create New Preference', [], ['class' => 'btn btn-primary']) }}
</div>
<br />
<div class="panel panel-inverse">
    <div class="panel-heading">
        Preferences
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Value</th>
                <th>Default</th>
            </tr>
        </thead>
        <tbody>
            @each('admin.users.preference.partials.row', $preferences, 'preference', 'raw|No preferences exist.')
        </tbody>
    </table>
</div>
@if ($preferences->total() > $preferences->perPage())
    <div class="text-center">
        {{ $preferences->render() }}
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