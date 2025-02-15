<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="imagingProductionSupplies-table">
        <thead>
            <tr>
                <th>Servicio</th>
                <th>Articulo</th>
                <th>Cantidad distribuida</th>
                <th>Cantidad utilizada</th>
                <th>Valor del articulo</th>
                <th>Precio unitario</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($imagingProductionSupplies as $imagingProductionSupplie)
                <tr>
                    <td>{{ $imagingProductionSupplie->service }}</td>
                    <td>{{ $imagingProductionSupplie->id_article ? $imagingProductionSupplie->articles->description : 'Sin ID' }}
                        <br>
                        <small
                            style="color: #A2C61E"><strong>{{ $imagingProductionSupplie->id_article ? $imagingProductionSupplie->articles->item_code : 'Sin ID' }}</strong></small>
                    </td>
                    <td>{{ number_format($imagingProductionSupplie->amount_week, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionSupplie->quantity_used, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionSupplie->id_article ? $imagingProductionSupplie->articles->last_cost : 0, 0, ',', '.') }}
                    </td>
                    <td>{{ number_format($imagingProductionSupplie->unit_price, 0, ',', '.') }}</td>
                    <td width="120">
                        {!! Form::open([
                            'route' => ['imagingProductionSupplies.destroy', $imagingProductionSupplie->id],
                            'method' => 'delete',
                        ]) !!}
                        <div class='btn-group'>
                            @can('update_imagingProductionSupplies')
                                <a href="{{ route('imagingProductionSupplies.edit', [$imagingProductionSupplie->id]) }}"
                                    class='btn btn-default btn-xs' title="Modificar">
                                    <i class="far fa-edit" style="color: #6c6d77"></i>
                                </a>
                            @endcan
                            @can('destroy_imagingProductionSupplies')
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
        Página <strong>{{ $imagingProductionSupplies->currentPage() }}</strong> de
        <strong>{{ $imagingProductionSupplies->lastPage() }}</strong>
    </div>
    <!-- Muestra la paginación generada por Laravel a la derecha -->
    <div>
        {{ $imagingProductionSupplies->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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
