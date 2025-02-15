<div class="table-responsive" style="scrollbar-width: none">
    <table class="table table-hover shadow mb-3 rounded" id="unitCosts-table">
        <thead>
            <tr>
                <th>N servicio</th>
                <th>Derecho sala</th>
                <th>Gas</th>
                <th>Consumibles</th>
                <th>Canasta</th>
                <th>Equipos rentados</th>
                <th>Honorarios médico</th>
                <th>Honorarios médico2</th>
                <th>Honorarios anestesiologo</th>
                <th>Valor total</th>
                <th>Dist Paq</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($unitCosts as $unitCost)
            <tr>
                <td><strong>{{ $unitCost->cod_surgical_act }}</strong>
                <br>
                <small style="color: #A2C61E"><Strong>{{ $unitCost->category }}</Strong></small>
                </td>
                <td>{{ number_format($unitCost->room_cost, 0, ',', '.'); }}</td>
                <td>{{ number_format($unitCost->gas, 0, ',', '.'); }}</td>
                <td>{{ number_format($unitCost->consumables, 0, ',', '.'); }}</td>
                <td>{{ number_format($unitCost->basket, 0, ',', '.'); }}</td>
                <td>{{ number_format($unitCost->rented, 0, ',', '.'); }}</td>
                <td>{{ number_format($unitCost->medical_fees, 0, ',', '.'); }}</td>
                <td>{{ number_format($unitCost->medical_fees2 ?? 0, 0, ',', '.'); }}</td>
                <td>{{ number_format($unitCost->anest_fees ?? 0, 0, ',', '.'); }}</td>
                <td>{{ number_format($unitCost->total_value, 0, ',', '.'); }}</td>
                <td>{{ number_format($unitCost->dist_pack, 0, ',', '.'); }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['unitCosts.destroy', $unitCost->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('show_unitCosts')
                            <a href="{{ route('unitCosts.show', [$unitCost->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-eye" style="color: #13A4DA"></i>
                            </a>
                        @endcan
                        @can('update_unitCosts')
                            <a href="{{ route('unitCosts.edit', [$unitCost->id]) }}" class='btn btn-default btn-xs btn-edit'>
                                <i class="far fa-edit" style="color: #6c6d77"></i>
                            </a>
                        @endcan
                        @can('destroy_unitCosts')
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
            Página <strong>{{ $unitCosts->currentPage() }}</strong> de <strong>{{ $unitCosts->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $unitCosts->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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