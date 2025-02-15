<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="contractsTable">
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Salario</th>
                <th>Inicio de contrato</th>
                <th>Deshabilitado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contracts as $contract)
            <tr>
                <td>{{ $contract->employe_id ? $contract->employe->name : 'Sin ID' }}
                <br>
                <small style="color: #A2C61E"><strong>{{ $contract->employe_id ? $contract->employe->dni : 'Sin ID' }}</strong></small>
                </td>
                <td>{{ number_format($contract->salary, 0, ',', '.'); }}</td>
                <td>{{ $contract->start_date_contract->format('Y-m-d') }}</td>
                <td class="text-center">{{ $contract->disable }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['contracts.destroy', $contract->id], 'method' => 'delete'
                    , 'class' => "eliminarContractForm"]) !!}
                    <div class='btn-group'>
                        @can('show_contracts')
                        <a href="{{ route('contracts.show', [$contract->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye" style="color: #13A4DA"></i>
                        </a>
                        @endcan
                        @can('update_contracts')
                        <a href="{{ route('contracts.edit', [$contract->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit" style="color: #6c6d77"></i>
                        </a>
                        @endcan
                        @can('destroy_contracts')
                        {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' => 'submit', 'class' => 'btn
                        btn-default btn-xs']) !!}
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-between mb-1 mt-2" style="background-color: transparent">
    <!-- Muestra el número de página actual a la izquierda -->
    <div class="pagination-label">
        Página <strong>{{ $contracts->currentPage() }}</strong> de <strong>{{ $contracts->lastPage() }}</strong>
    </div>
    <!-- Muestra la paginación generada por Laravel a la derecha -->
    <div>
        {{ $contracts->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const eliminarUsuarioForms = document.querySelectorAll('.eliminarContractForm');
    
        eliminarUsuarioForms.forEach((form) => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Previene la acción por defecto del formulario
                const currentForm = this; // Obtén el formulario actual
    
                Swal.fire({
                    title: '¿Estás seguro de querer eliminar este registro?',
                    html: 'Esta acción eliminará permanentemente el contrato del empleado.<br><strong style= "color: red";>Esta acción no se puede deshacer.</strong>',
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
        background-color: #14ABE3;
        border-color: #14ABE3;
        color: white;
    }
</style>