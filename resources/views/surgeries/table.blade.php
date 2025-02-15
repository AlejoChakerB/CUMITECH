<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="surgeries-table">
        <thead>
            <tr>
                <th>Estudio</th>
                <th>Código</th>
                <th>Fecha</th>
                <th>Tiempo cirugia</th>
                <th>Médico</th>
                <th>Paciente</th>
                <th colspan="4">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surgeries as $surgery)
            <tr>
                <td>{{ $surgery->study_number }}
                <br>
                <small style="color: #A2C61E"><strong>{{ $surgery->category }}</strong></small>
                </td>
                <td>{{ $surgery->cod_surgical_act }}</td>
                <td>{{ $surgery->date_surgery }}</td>
                <td>{{ $surgery->start_time }} - {{ $surgery->end_time }}
                <br>
                <small style="color: #A2C61E"><strong>{{ $surgery->surgeryTime }} Minutos</strong></small>
                </td>
                <td>{{ $surgery->id_doctor ? $surgery->doctors->full_name : 'Sin ID' }}
                <br>
                <small style="color: #A2C61E""><strong>{{ $surgery->id_doctor ? $surgery->doctors->category_doctor : 'Sin ID' }}</strong></small></td>
                <td>{{ $surgery->patient }}
                <br>
                <small style="color: #A2C61E""><strong>{{ $surgery->operating_room }}</strong></small></td>
                </td>
                <td width="120">
                    {!! Form::open(['route' => ['surgeries.destroy', $surgery->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('calculate_cost')
                            <a href="{{ route('costUnit.calculate', [$surgery->id]) }}" class='btn btn-default btn-xs'>
                                <i class="fas fa-coins" style="color: #ffbf00"></i>
                            </a>
                        @endcan
                        @can('show_surgeries')
                            <a href="{{ route('surgeries.show', [$surgery->id]) }}" class='btn btn-default btn-xs'>
                                <i class="fas fa-eye" style="color: #13A4DA"></i>
                            </a>
                        @endcan
                        @can('update_surgeries')
                            <a href="{{ route('surgeries.edit', [$surgery->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-edit" style="color: #6c6d77"></i>
                            </a>
                        @endcan
                        @can('destroy_surgeries')
                            {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' => 'submit', 'class' => 'btn
                            btn-default btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
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
            Página <strong>{{ $surgeries->currentPage() }}</strong> de <strong>{{ $surgeries->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $surgeries->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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

    .pagination .page-item .page-link{
        color: #2B3D63;
    }
    .pagination .page-item.active .page-link {
        background-color: #2B3D63;
        border-color: #2B3D63;
        color: white;
    }
</style>