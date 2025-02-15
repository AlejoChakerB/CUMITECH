<div id="app">
    <div class="table-responsive">
        <table class="table table-hover shadow mb-5 rounded" id="medicinesTable">
            <thead>
                <tr>
                    <th>Fecha ingreso</th>
                    <th># Acta</th>
                    <th>Nombre generico</th>
                    <th>Registro sanitario</th>
                    <th>Cantidad</th>
                    <th>Fecha vencimiento</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medicines as $medicine)
                <tr>
                    <td>{{ $medicine->admission_date->format('Y-m-d') }}</td>
                    <td class="text-center">{{ $medicine->act_number }}</td>
                    <td>{{ $medicine->generic_name }}
                        <br>
                        <small style="color: #69C5A0"><strong>{{ $medicine->pharmaceutical_form }}</strong></small>
                        <small style="color: #69C5A0"><strong>{{ $medicine->concentration }}</strong></small>
                    </td>
                    <td><small>{{ $medicine->invima_registrations_id ? $medicine->invima_registration->health_register :
                            'Sin ID'}}</small>
                        <br>
                        <small style="color: #69C5A0"><strong>
                                {{ $medicine->manufacturer_laboratory }}</strong></small>
                    </td>
                    <td class="text-center">{{ $medicine->received_amount }}</td>
                    <td>{{ $medicine->expiration_date->format('Y-m-d') }}</td>
                    <td>
                        {{ $medicine->state }}</td>
                    <td>
                        {!! Form::open(['route' => ['medicines.destroy', $medicine->id], 'method' => 'delete', 'class'
                        => "eliminarMedicineForm"]) !!}
                        <div class='btn-group'>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <medicine-modal :medicine='@json($medicine ?? null)' :invima='@json($medicine->invima_registration->health_register ?? null)'></medicine-modal>
                                </div>
                                <a href="{{ route('medicines.edit', [$medicine->id]) }}" class='btn btn-default btn-xs px-2'>
                                    <i class="far fa-edit" style="color: #6c6d77"></i>
                                </a>
                                {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' =>
                                'submit',
                                'class' => 'btn btn-default btn-xs px-2']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-between mb-4">
            <!-- Muestra el número de página actual a la izquierda -->
            <div class="pagination-label">
                Página <strong>{{ $medicines->currentPage() }}</strong> de <strong>{{ $medicines->lastPage() }}</strong>
            </div>
            <!-- Muestra la paginación generada por Laravel a la derecha -->
            <div>
                {{ $medicines->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
            </div>
        </div>
    </div>
</div>

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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const eliminarUsuarioForms = document.querySelectorAll('.eliminarMedicineForm');
    
        eliminarUsuarioForms.forEach((form) => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Previene la acción por defecto del formulario
                const currentForm = this; // Obtén el formulario actual
    
                Swal.fire({
                    title: '¿Estás seguro de querer eliminar este registro?',
                    html: 'Esta acción eliminará permanentemente el registro del <strong>acta de entrega de medicamentos</strong><br><strong style= "color: red";>Esta acción no se puede deshacer.</strong>',
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