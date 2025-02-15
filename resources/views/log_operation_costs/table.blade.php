<div class="table-responsive">
    <table class="table table table-hover shadow mb-3 rounded" id="logOperationCosts-table">
        <thead>
            <tr>
                <th>Id factura</th>
                <th>N servicio</th>
                <th>Procedimiento</th>
                <th>%Participacion</th>
                <th>Tiempo</th>
                <th>Médico</th>
                <th>Médico2</th>
                <th>Anestesiologo</th>
                <th>Derecho sala</th>
                <th>Gases</th>
                <th>Valor liquidado</th>
                <th>Total liquidado</th>
                <th>Paquete</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logOperationCosts as $logOperationCost)
                <tr>
                    <td>{{ $logOperationCost->id_fact }}</td>
                    <td>{{ $logOperationCost->cod_surgical_act }}</td>
                    <td>{{ $logOperationCost->code_procedure ? $logOperationCost->procedures->description : 'Sin ID' }}
                        <br>
                        <strong style="color: #A2C61E">CUPS:
                            {{ $logOperationCost->code_procedure ? $logOperationCost->procedures->code : 'Sin ID' }}</strong>
                    </td>
                    <td>{{ $logOperationCost->percentage_parti * 100 }}%</td>
                    <td>{{ number_format($logOperationCost->time_procedure, 2) }}</td>
                    <td>{{ number_format($logOperationCost->doctor_fees, 0, ',', '.') }}
                        <br>
                        <small
                            style="color: #A2C61E"><strong>{{ $logOperationCost->doctor_percentage }}%</strong></small>
                    </td>
                    <td>{{ number_format($logOperationCost->doctor2_fees, 0, ',', '.') }}
                        <br>
                        <small
                            style="color: #A2C61E"><strong>{{ $logOperationCost->doctor2_percentage }}%</strong></small>
                    </td>
                    <td>{{ number_format($logOperationCost->anest_fees, 0, ',', '.') }}
                        <br>
                        <small
                            style="color: #A2C61E"><strong>{{ $logOperationCost->anest_percentage }}%</strong></small>
                    </td>
                    <td>{{ number_format($logOperationCost->room_cost, 0, ',', '.') }}</td>
                    <td>{{ number_format($logOperationCost->gases, 0, ',', '.') }}</td>
                    <td>{{ number_format($logOperationCost->value_liquidated, 0, ',', '.') }}</td>
                    <td>{{ number_format($logOperationCost->total_liquidated, 0, ',', '.') }}</td>
                    <td>{{ $logOperationCost->cod_package ?? 'NA' }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['logOperationCosts.destroy', $logOperationCost->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('show_logoperationcosts')
                                <a href="{{ route('logOperationCosts.show', [$logOperationCost->id]) }}"
                                    class='btn btn-default btn-xs'>
                                    <i class="far fa-eye" style="color: #13A4DA"></i>
                                </a>
                            @endcan
                            @can('update_logoperationcosts')
                                <a href="{{ route('logOperationCosts.edit', [$logOperationCost->id]) }}"
                                    class='btn btn-default btn-xs' style="color: #6c6d77">
                                    <i class="far fa-edit"></i>
                                </a>
                            @endcan
                            @can('destroy_logoperationcosts')
                                {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-default btn-xs',
                                    'onclick' => "return confirm('Are you sure?')",
                                ]) !!}
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
            Página <strong>{{ $logOperationCosts->currentPage() }}</strong> de
            <strong>{{ $logOperationCosts->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $logOperationCosts->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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
