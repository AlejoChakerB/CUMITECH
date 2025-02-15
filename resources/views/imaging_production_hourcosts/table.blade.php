<div class="table-responsive" style="scrollbar-width: none">
    <table class="table table-hover shadow mb-3 rounded" id="imagingProductionHourcosts-table">
        <thead>
            <tr>
                <th>Servicio</th>
                <th>Gastos fijos</th>
                <th>Gastos variables</th>
                <th>Dist admin</th>
                <th>Dist logistic</th>
                <th>Mano obra planta</th>
                <th>Materiales</th>
                <th>Costo total</th>
                <th>Tecnico/Transc</th>
                <th>Valor sala</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($imagingProductionHourcosts as $imagingProductionHourcost)
                <tr>
                    <td>{{ $imagingProductionHourcost->service }}</td>
                    <td>{{ number_format($imagingProductionHourcost->permanent_overhead, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionHourcost->variable_overhead, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionHourcost->administrative_twoLevel, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionHourcost->logistic_twoLevel, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionHourcost->plant_labour, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionHourcost->supplies, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionHourcost->total_cost, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionHourcost->employee, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionHourcost->hour_value_room, 0, ',', '.') }}
                        <br>
                        <small><strong style="color: #A2C61E">N salas:
                                {{ $imagingProductionHourcost->number_rooms }}</strong></small>
                    </td>
                    <td width="120">
                        {!! Form::open([
                            'route' => ['imagingProductionHourcosts.destroy', $imagingProductionHourcost->id],
                            'method' => 'delete',
                        ]) !!}
                        <div class='btn-group'>
                            @can('show_imagingProductionHourcosts')
                                <a href="{{ route('imagingProductionHourcosts.show', [$imagingProductionHourcost->id]) }}"
                                    class='btn btn-default btn-xs'>
                                    <i class="far fa-eye" style="color: #13A4DA"></i>
                                </a>
                            @endcan
                            @can('update_imagingProductionHourcosts')
                                <a href="{{ route('imagingProductionHourcosts.edit', [$imagingProductionHourcost->id]) }}"
                                    class='btn btn-default btn-xs' title="Modificar">
                                    <i class="far fa-edit" style="color: #6c6d77"></i>
                                </a>
                            @endcan
                            @can('destroy_imagingProductionHourcosts')
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
        Página <strong>{{ $imagingProductionHourcosts->currentPage() }}</strong> de
        <strong>{{ $imagingProductionHourcosts->lastPage() }}</strong>
    </div>
    <!-- Muestra la paginación generada por Laravel a la derecha -->
    <div>
        {{ $imagingProductionHourcosts->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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
