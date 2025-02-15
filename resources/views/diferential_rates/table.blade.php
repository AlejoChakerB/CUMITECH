<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="diferentialRates-table">
        <thead>
            <tr>
                <th>Médico</th>
                <th>Especialidad</th>
                <th>CUPS</th>
                <th>Procedimiento</th>
                <th>Valor 1</th>
                <th>Valor 2</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($diferentialRates as $diferentialRate)
            <tr>
                <td>{{ $diferentialRate->id_doctor ? $diferentialRate->doctors->full_name : 'Sin ID' }} 
                <br><small><strong style="color: #A2C61E">{{ $diferentialRate->id_doctor ? $diferentialRate->doctors->dni : 'Sin ID' }}</strong></small>
                </td>
                <td>{{ $diferentialRate->id_doctor ? $diferentialRate->doctors->specialty : 'Sin ID' }} </td>
                <td>{{ $diferentialRate->id_procedure ? $diferentialRate->procedures->code : 'Sin ID' }}</td>
                <td>
                    {{ $diferentialRate->id_procedure ? $diferentialRate->procedures->description : 'Sin ID' }} 
                    <small>
                        @php
                        $manualType = $diferentialRate->id_procedure ? $diferentialRate->procedures->manual_type : null;
                        @endphp
                        @if ($manualType == 256 || $manualType == 312)
                            <span class="badge text-white" style="background-color:#28A745;">ISS</span>
                        @elseif ($manualType == 'SOAT')
                            <span class="badge text-white" style="background-color:#00B0EB;">{{ $manualType }}</span>
                        @elseif ($manualType == 'INST')
                            <span class="badge text-white" style="background-color:#FA773E;">{{ $manualType }}</span>
                        @else
                            Sin ID
                        @endif
                    </small>
                    <br>
                    <small>
                        <strong style="color: #69C5A0">
                           
                        </strong>
                    </small>
                </td>
                <td>{{ number_format($diferentialRate->value1, 0, ',', '.'); }}</td>
                <td>{{ number_format($diferentialRate->value2, 0, ',', '.'); }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['diferentialRates.destroy', $diferentialRate->id], 'method' =>
                    'delete', 'class' => 'eliminarTFForm']) !!}
                    <div class='btn-group'>
                        @can('update_diferentialRates')
                            <a href="{{ route('diferentialRates.edit', [$diferentialRate->id]) }}"
                                class='btn btn-default btn-xs' title="Modificar">
                                <i class="far fa-edit" style="color: #6c6d77"></i>
                            </a>
                        @endcan
                        @can('destroy_diferentialRates')
                            {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' => 'submit', 'class' => 'btn
                            btn-default btn-xs', 'title' => 'Eliminar']) !!}
                        @endcan
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
            Página <strong>{{ $diferentialRates->currentPage() }}</strong> de <strong>{{ $diferentialRates->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $diferentialRates->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
        </div>
    </div>
    
    <div id="app">
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
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

    .pagination .page-item .page-link {
        color: #2B3D63;
    }

    .pagination .page-item.active .page-link {
        background-color: #2B3D63;
        border-color: #2B3D63;
        color: white;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const eliminarUsuarioForms = document.querySelectorAll('.eliminarTFForm');
    
        eliminarUsuarioForms.forEach((form) => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Previene la acción por defecto del formulario
                const currentForm = this; // Obtén el formulario actual
                
                Swal.fire({
                    title: '¿Estás seguro de querer eliminar este registro?',
                    html: 'Esta acción eliminará permanentemente el registro de la tarifa diferencial del médico.<br><strong style= "color: red";>Esta acción no se puede deshacer.</strong>',
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
                    }else{
                        Swal.fire({
                            title: 'Cancelado',
                            text: 'Operación cancelada',
                            icon: 'error',
                            timer: 6000 // Tiempo en milisegundos para que la alerta desaparezca automáticamente
                        });
                    }
                });
            });
        });
    });
</script>