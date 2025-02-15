<div class="table-responsive">
    <table class="table table-hover shadow mb-5 rounded" id="templatesTable">
        <thead>
            <tr>
                <th>Nombre plantilla</th>
                <th>Nombre comercial</th>
                <th>Invima Registrations Id</th>
                <th>Presentacion</th>
                <th>Vigencia registro</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicationTemplates as $medicationTemplate)
            <tr>
                <td>{{ $medicationTemplate->template_name }}</td>
                <td>
                    {{ $medicationTemplate->invima_registrations_id ?
                    $medicationTemplate->invima_registration->tradename : 'Sin ID' }}
                    <br>
                    <small style="color: #69C5A0"><Strong>{{ $medicationTemplate->invima_registrations_id ?
                            $medicationTemplate->invima_registration->generic_name : 'Sin ID' }}</Strong></small>
                </td>
                <td>
                    {{ $medicationTemplate->invima_registrations_id ?
                    $medicationTemplate->invima_registration->health_register : 'Sin ID'}}
                    <br>
                    @if($medicationTemplate->invima_registration->state_invima == 'Vigente')
                    <small style="color: #69C5A0"><strong>{{ $medicationTemplate->invima_registrations_id ?
                            $medicationTemplate->invima_registration->state_invima : 'Sin ID'}}</strong></small>
                    @elseif($medicationTemplate->invima_registration->state_invima == 'En tramite')
                    <small class="text-secondary"><strong>{{ $medicationTemplate->invima_registrations_id ?
                            $medicationTemplate->invima_registration->state_invima : 'Sin ID'}}</strong></small>
                    @elseif($medicationTemplate->invima_registration->state_invima == 'No vigente')
                    <small class="text-danger"><strong>{{ $medicationTemplate->invima_registrations_id ?
                            $medicationTemplate->invima_registration->state_invima : 'Sin ID'}}</strong></small>
                    @endif
                </td>
                <td>{{ $medicationTemplate->invima_registrations_id ?
                    $medicationTemplate->invima_registration->pharmaceutical_form : 'Sin ID'}}
                    <br>
                    <small style="color: #69C5A0"><strong>{{ $medicationTemplate->presentationt }}
                    - {{ $medicationTemplate->concentrationt }}</strong></small>
                </td>
                <td>{{ $medicationTemplate->invima_registrations_id ?
                    $medicationTemplate->invima_registration->validity_registration : 'Sin ID' }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['medicationTemplates.destroy', $medicationTemplate->id], 'method' =>
                    'delete', 'class' => "eliminarTemplateForm"]) !!}
                    <div class='btn-group'>
                        <a href="{{ route('medicationTemplates.show', [$medicationTemplate->id]) }}"
                            class='btn btn-default btn-xs'>
                            <i class="far fa-eye" style="color: #13A4DA"></i>
                        </a>
                        <a href="{{ route('medicationTemplates.edit', [$medicationTemplate->id]) }}"
                            class='btn btn-default btn-xs'>
                            <i class="far fa-edit" style="color: #6c6d77"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' => 'submit',
                        'class' => 'btn btn-default btn-xs']) !!}
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
            Página <strong>{{ $medicationTemplates->currentPage() }}</strong> de <strong>{{ $medicationTemplates->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $medicationTemplates->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const eliminarUsuarioForms = document.querySelectorAll('.eliminarTemplateForm');
    
        eliminarUsuarioForms.forEach((form) => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Previene la acción por defecto del formulario
                const currentForm = this; // Obtén el formulario actual
    
                Swal.fire({
                    title: '¿Estás seguro de querer eliminar este registro?',
                    html: 'Esta acción eliminará permanentemente la plantilla.<br><strong style= "color: red";>Esta acción no se puede deshacer.</strong>',
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