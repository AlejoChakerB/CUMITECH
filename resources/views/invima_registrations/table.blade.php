<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="invimaTable">
        <thead>
        <tr>
            <th>Registro sanitario</th>
            <th>Nombre comercial</th>
            <th>Forma farmaceutica</th>
            <th>Fecha de vencimiento</th>
            <th>Laboratorio fabricante</th>
            <th class="text-center">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invimaRegistrations as $invimaRegistration)
            <tr>
                <td>{{ $invimaRegistration->health_register }}
                <br>
                @if($invimaRegistration->state_invima == 'Vigente')
                    <small style="color: #69C5A0"><strong>{{ $invimaRegistration->state_invima }}</strong></small>
                @elseif($invimaRegistration->state_invima == 'En tramite')
                    <small class="text-secondary"><strong>{{ $invimaRegistration->state_invima }}</strong></small>
                @elseif($invimaRegistration->state_invima == 'No vigente')
                    <small class="text-danger"><strong>{{ $invimaRegistration->state_invima }}</strong></small>
                @endif
                </td>
                <td>{{ $invimaRegistration->tradename }}
                <br>
                <small style="color: #69C5A0"><strong>{{ $invimaRegistration->generic_name }}</strong></small>
                </td>
                <td>{{ $invimaRegistration->pharmaceutical_form }}</td>
                <td>{{ $invimaRegistration->validity_registration }}</td>
                <td>{{ $invimaRegistration->laboratory_manufacturer }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['invimaRegistrations.destroy', $invimaRegistration->id], 'method' => 'delete', 'class' => "eliminarInvimaForm"]) !!}
                    <div class='btn-group'>
                        <a href="{{ route('invimaRegistrations.edit', [$invimaRegistration->id]) }}"
                           class='btn btn-default btn-xs' style="color: #6c6d77">
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-xs']) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between mb-4">
        <!-- Muestra el número de página actual a la izquierda -->
        <div class="pagination-label">
            Página <strong>{{ $invimaRegistrations->currentPage() }}</strong> de <strong>{{ $invimaRegistrations->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $invimaRegistrations->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const eliminarUsuarioForms = document.querySelectorAll('.eliminarInvimaForm');
    
        eliminarUsuarioForms.forEach((form) => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Previene la acción por defecto del formulario
                const currentForm = this; // Obtén el formulario actual
    
                Swal.fire({
                    title: '¿Estás seguro de querer eliminar este registro?',
                    html: 'Esta acción eliminará permanentemente el registro invima.<br><strong style= "color: red";>Esta acción no se puede deshacer.</strong>',
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
        color: #14ABE3;
        /* Cambia el color del título a rojo */
    }

    .custom-icon::before {
        color: #cf33ff;
        /* Cambia el color del icono a rojo */
    }

    .pagination .page-item.active .page-link {
        background-color: #69C5A0;
        border-color: #69C5A0;
        color: white;
    }
</style>
