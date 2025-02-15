@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

<div class="table-responsive">
    <table class="table table-hover mb-0 shadow mb-5 rounded" id="users">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Roles</th>
                @canany(['show_user', 'update_user', 'destroy_user'])
                <th>Acciones</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @php
            $contador = 0;
            @endphp
            @foreach ($users as $user)
            @php
            $contador += 1;
            @endphp
            <tr>
                <td><strong>{{$contador}}</strong></td>
                <td>
                    <a>{{ $user->name }}</a>
                    <br>
                    <small style="color: #69C5A0"><strong>Creado {{
                            $user->created_at->format('Y-m-d')}}</strong></small>
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->getRoleDisplayNames() }}</td>
                <td>
                    @can('update_user')
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-default text-white"><i
                            class="far fa-edit" style="color: #6c6d77"></i></a>
                    @endcan
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display: inline"
                        class="eliminarUsuarioForm">
                        {{ csrf_field() }} {{ method_field('DELETE') }}
                        @can('destroy_user')
                        <button class="btn btn-sm btn-default"><i class="far fa-trash-alt"
                                style="color: #da1b1b"></i></button>
                        @endcan
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @section('js')
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

        <script>
            new DataTable('#users', {
                language: {
                    search: '<Strong style="color: #69C5A0">Buscar</Strong>',
                    info: '<strong>Página</strong> <strong>_PAGE_</strong> <strong>de</strong> <strong>_PAGES_</strong>',
                    lengthMenu: '<strong style="color: #69C5A0">Mostrar _MENU_</Strong>',
                    infoEmpty: '',
                    infoFiltered: 'Filtrado de _MAX_ registros totales',
                    zeroRecords: 'No se encontraron resultados',
                    paginate: {
                        previous: 'Anterior',
                        next: 'Siguiente'
                    }
                }
            });
        </script>
    @endsection
</div>
<div id="app">
</div>
<script src="{{ asset('js/app.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const eliminarUsuarioForms = document.querySelectorAll('.eliminarUsuarioForm');
    
        eliminarUsuarioForms.forEach((form) => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Previene la acción por defecto del formulario
                const currentForm = this; // Obtén el formulario actual
    
                Swal.fire({
                    title: '¿Estás seguro de querer eliminar este usuario?',
                    html: 'Esta acción eliminará permanentemente el usuario.<br><strong style= "color: red";>Esta acción no se puede deshacer.</strong>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        title: 'custom-title', // Clase personalizada para el título
                        content: 'custom-content', // Clase personalizada para el contenido
                        icon: 'custom-icon' // Clase personalizada para el icono
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // El usuario confirmó la eliminación, envía el formulario actual
                        currentForm.submit();
                    }
                });
            });
        });
    });
    </script>

    <style>
        .custom-title {
            color: #14ABE3; /* Cambia el color del título a rojo */
        }

        .custom-icon::before {
            color: #cf33ff; /* Cambia el color del icono a rojo */
        }

        .pagination .page-item.active .page-link {
            background-color: #69C5A0;
            border-color: #69C5A0;
            color: white;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px; 
            margin-top: 10px;
            margin-right: 4px;
        }

        .dataTables_length select {
            border-radius: 10px; 
            margin-top: 10px;
        }
    </style>