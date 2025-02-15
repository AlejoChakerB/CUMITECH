<div class="table-responsive" style="scrollbar-width: none">
    <table class="table table-hover shadow mb-3 rounded" id="imagingProductionMonths-table">
        <thead>
            <tr>
                <th>Procedimiento</th>
                <th>Enero</th>
                <th>Febrero</th>
                <th>Marzo</th>
                <th>Abril</th>
                <th>Mayo</th>
                <th>Junio</th>
                <th>Julio</th>
                <th>Agosto</th>
                <th>Septiembre</th>
                <th>Octubre</th>
                <th>Noviembre</th>
                <th>Diciembre</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($imagingProductionMonths as $imagingProductionMonth)
                <tr>
                    <td><strong>CUPS
                            {{ $imagingProductionMonth->cups ? $imagingProductionMonth->procedures->code : 'Sin ID' }}:</strong>
                        {{ $imagingProductionMonth->cups ? $imagingProductionMonth->procedures->description : 'Sin ID' }}
                        <br>
                        <small><strong style="color: #A2C61E">{{ $imagingProductionMonth->service }}</strong></small>
                    </td>
                    <td>{{ number_format($imagingProductionMonth->january, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionMonth->february, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionMonth->march, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionMonth->april, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionMonth->may, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionMonth->june, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionMonth->july, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionMonth->august, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionMonth->september, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionMonth->october, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionMonth->november, 0, ',', '.') }}</td>
                    <td>{{ number_format($imagingProductionMonth->december, 0, ',', '.') }}</td>
                    <td width="120">
                        {!! Form::open([
                            'route' => ['imagingProductionMonths.destroy', $imagingProductionMonth->id],
                            'method' => 'delete',
                        ]) !!}
                        <div class='btn-group'>
                            @can('show_imagingProductionMonths')
                                <a href="{{ route('imagingProductionMonths.show', [$imagingProductionMonth->id]) }}"
                                    class='btn btn-default btn-xs'>
                                    <i class="far fa-eye" style="color: #13A4DA"></i>
                                </a>
                            @endcan
                            @can('update_imagingProductionMonths')
                                <a href="{{ route('imagingProductionMonths.edit', [$imagingProductionMonth->id]) }}"
                                    class='btn btn-default btn-xs' title="Modificar">
                                    <i class="far fa-edit" style="color: #6c6d77"></i>
                                </a>
                            @endcan
                            @can('destroy_imagingProductionMonths')
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
<div class="d-flex justify-content-between mb-1 mt-2" style="background-color: transparent">
    <!-- Muestra el número de página actual a la izquierda -->
    <div class="pagination-label">
        Página <strong>{{ $imagingProductionMonths->currentPage() }}</strong> de
        <strong>{{ $imagingProductionMonths->lastPage() }}</strong>
    </div>
    <!-- Muestra la paginación generada por Laravel a la derecha -->
    <div>
        {{ $imagingProductionMonths->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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
