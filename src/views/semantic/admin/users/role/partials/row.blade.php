<tr>
    <td>{{ $role->present()->group }}</td>
    <td>{{ $role->present()->name }}</td>
    <td>{{ $role->present()->priority }}</td>
    <td><a href="javascript:void(0);" class="viewDetails" title="Actions for {{ $role->present()->name }}" data-html="{{ $role->present()->actionList }}">View</a></td>
    <td class="text-right">
        <div class="mini ui right floated buttons">
            <a href="{{ URL::route('admin.user.role.edit', ['id' => $role->id], false) }}" class="mini ui primary button">
                <i class="fa fa-edit"></i>
            </a>
            {{ HTML::linkRouteIcon('admin.user.role.delete', ['id' => $role->id], 'fa fa-trash-o', null, ['class' => 'confirm-remove mini ui red button'])  }}
        </div>
    </td>
</tr>