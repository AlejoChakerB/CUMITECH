<div class="table-responsive">
    <table  class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Identificador</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->display_name }}</td>
                    <td>
                        @can('update', $permission)
                            <a href="{{ route('admin.permissions.edit', $permission) }}"
                                class="btn btn-sm btn-outline-info"
                            ><i class="far fa-edit"></i></a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
