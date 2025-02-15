<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="procedures-table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Cups</th>
                <th>Descripcion</th>
                <th>UVR/Grupo</th>
                <th>Valor</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($procedures as $procedure)
            <tr>
                <td>{{ $procedure->code }}</td>
                <td>{{ $procedure->cups }}</td>
                <td>
                    {{ $procedure->description }} 
                    <small>
                        @if($procedure->manual_type == 256)
                            <span class="badge text-white" style="background-color:#28A745;">ISS</span>
                        @elseif ($procedure->manual_type == "SOAT")
                            <span class="badge text-white" style="background-color:#00B0EB;">{{ $procedure->manual_type }}</span>
                        @elseif ($procedure->manual_type == "312")
                            <span class="badge text-white" style="background-color:#28A745;">ISS {{ $procedure->manual_type }}</span>
                        @else
                            <span class="badge text-white" style="background-color:#da1b1b;">{{ $procedure->manual_type }}</span>
                        @endif
                    </small> 
                <br>
                <small style="color: #A2C61E"><strong>{{ $procedure->category }}</strong></small>
                </td>
                <td>{{ $procedure->uvr }}</td>
                <td>{{ number_format($procedure->value, 0, ',', '.'); }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['procedures.destroy', $procedure->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('update_procedure')
                            <a href="{{ route('procedures.edit', [$procedure->id]) }}" class='btn btn-default btn-xs' title="Modificar">
                                <i class="far fa-edit" style="color: #6c6d77"></i>
                            </a>
                        @endcan
                        @can('destroy_procedure')
                            {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' => 'submit',
                            'class' => 'btn
                            btn-default btn-xs', 'onclick' => "return confirm('Are you sure?')", 'title' => 'Eliminar']) !!}
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
            Página <strong>{{ $procedures->currentPage() }}</strong> de <strong>{{ $procedures->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $procedures->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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

    .pagination .page-item .page-link {
        color: #2B3D63;
    }

    .pagination .page-item.active .page-link {
        background-color: #2B3D63;
        border-color: #2B3D63;
        color: white;
    }
</style>