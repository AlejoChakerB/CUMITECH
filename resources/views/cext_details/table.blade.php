<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="cextDetails-table">
        <thead>
            <tr>
                <th>Especialidad</th>
                <th>Procedimiento</th>
                <th>Duracion</th>
                <th>Costo sala</th>
                <th>Honorario médico</th>
                <th>Costo insumo</th>
                <th>Costo unitario</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cextDetails as $cextDetail)
                <tr>
                    <td><strong>{{ $cextDetail->specialty }}</strong></td>
                    <td>{{ $cextDetail->procedure ? $cextDetail->procedures->description : 'Sin ID' }}</td>
                    <td>{{ $cextDetail->duration }}</td>
                    <td>{{ number_format($cextDetail->room_cost, 0, ',', '.') }}</td>
                    <td>{{ number_format($cextDetail->medical_fees, 0, ',', '.') }}</td>
                    <td>{{ number_format($cextDetail->supplies_cost, 0, ',', '.') }}</td>
                    <td>{{ number_format($cextDetail->total_cost, 0, ',', '.') }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['cextDetails.destroy', $cextDetail->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('show_cextDetails')
                                <a href="{{ route('cextDetails.show', [$cextDetail->id]) }}" class='btn btn-default btn-xs' title="Modificar">
                                    <i class="far fa-eye" style="color: #13A4DA"></i>
                                </a>
                            @endcan
                            @can('update_cextDetails')
                                <a href="{{ route('cextDetails.edit', [$cextDetail->id]) }}" class='btn btn-default btn-xs'>
                                    <i class="far fa-edit" style="color: #6c6d77"></i>
                                </a>
                            @endcan
                            @can('destroy_cextDetails')
                                {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-default btn-xs',
                                    'onclick' => "return confirm('Are you sure?')",
                                    'title' => 'Eliminar'
                                ]) !!}
                            @endcan
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-between mb-4">
    <!-- Muestra el número de página actual a la izquierda -->
    <div class="pagination-label">
        Página <strong>{{ $cextDetails->currentPage() }}</strong> de <strong>{{ $cextDetails->lastPage() }}</strong>
    </div>
    <!-- Muestra la paginación generada por Laravel a la derecha -->
    <div>
        {{ $cextDetails->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
    </div>
</div>
<style>
    .pagination .page-item .page-link {
        color: #2B3D63;
    }

    .pagination .page-item.active .page-link {
        background-color: #2B3D63;
        border-color: #2B3D63;
        color: white;
    }
</style>
