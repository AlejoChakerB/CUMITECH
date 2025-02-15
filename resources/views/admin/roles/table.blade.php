<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Identificador</th>
                <th>Nombre</th>
                <th>Permisos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->display_name }}</td>
                    <td>
                        <span class="truncate" onclick="showFullText(this)">
                            {{ $role->permissions->pluck('display_name')->implode(', ') }}
                        </span>
                        <span class="full-text" onclick="showMinText(this)" style="display:none;">
                            {{ $role->permissions->pluck('display_name')->implode(', ') }}
                        </span>
                    </td>
                    <td>
                        @can('roles')
                            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-outline-info"><i
                                    class="fa fa-edit"></i></a>
                        @endcan
                        @can('roles')
                            @if ($role->id !== 1)
                                <form method="POST" action="{{ route('admin.roles.destroy', $role) }}"
                                    style="display: inline">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Estás seguro de querer eliminar esta Role?')"><i
                                            class="far fa-trash-alt"></i></button>
                                </form>
                            @endif
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    .truncate {
        display: inline-block;
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        cursor: pointer;
    }

    .full-text {
        display: none;
        cursor: pointer;
    }
</style>

<script>
    function showFullText(element) {
        const truncatedText = element;
        const fullText = element.nextElementSibling;

        // Cambiar la visibilidad
        if (fullText.style.display === 'none') {
            fullText.style.display = 'inline';
            truncatedText.style.display = 'none';
        }
    }

    function showMinText(element) {
        const truncatedText = element;
        const minText = element.previousElementSibling;

        // Cambiar la visibilidad
        if (minText.style.display === 'none') {
            minText.style.display = 'inline-block';
            truncatedText.style.display = 'none';
        }
    }
</script>
