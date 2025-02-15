<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="imagingProductionDetails-table">
        <thead>
            <tr>
                <th>CUPS</th>
                <th>Duracion</th>
                <th>Sala</th>
                <th>Tecnico/Transc</th>
                <th>Costo lectura</th>
                <th>Insumos</th>
                <th>Costo unitario</th>
                <th>Sedacion</th>
                <th>Contraste</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($imagingProductionDetails as $imagingProductionDetail)
                <tr>
                    <td>CUPS: {{ $imagingProductionDetail->cups }} -
                        {{ $imagingProductionDetail->cups ? $imagingProductionDetail->procedures->description : 'SIN ID' }}
                        <br>
                        <small><strong style="color: #A2C61E">{{ $imagingProductionDetail->service }} -
                                {{ $imagingProductionDetail->category }}</strong></small>
                    </td>
                    <td>{{ $imagingProductionDetail->duration }}</td>
                    <td>{{ number_format($imagingProductionDetail->room_cost, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionDetail->transcriber_cost, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionDetail->doctor_cost, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionDetail->supplies_cost, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionDetail->total_cost, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionDetail->sedation, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionDetail->contrast, 0, ',', '.') }}</td>
                    <td width="120">
                        {!! Form::open([
                            'route' => ['imagingProductionDetails.destroy', $imagingProductionDetail->id],
                            'method' => 'delete',
                        ]) !!}
                        <div class='btn-group'>
                            @can('show_imagingProductionDetails')
                                <a href="{{ route('imagingProductionDetails.show', [$imagingProductionDetail->id]) }}"
                                    class='btn btn-default btn-xs'>
                                    <i class="far fa-eye" style="color: #13A4DA"></i>
                                </a>
                            @endcan
                            @can('update_imagingProductionDetails')
                                <a href="{{ route('imagingProductionDetails.edit', [$imagingProductionDetail->id]) }}"
                                    class='btn btn-default btn-xs' title="Modificar">
                                    <i class="far fa-edit" style="color: #6c6d77"></i>
                                </a>
                            @endcan
                            @can('destroy_imagingProductionDetails')
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
        Página <strong>{{ $imagingProductionDetails->currentPage() }}</strong> de
        <strong>{{ $imagingProductionDetails->lastPage() }}</strong>
    </div>
    <!-- Muestra la paginación generada por Laravel a la derecha -->
    <div>
        {{ $imagingProductionDetails->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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
