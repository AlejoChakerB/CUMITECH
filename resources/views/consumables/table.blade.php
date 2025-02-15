<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="consumables-table">
        <thead>
            <tr>
                <th>Articulo</th>
                <th>Cantidad presentacion</th>
                <th>Cantidad utilizada</th>
                <th>Nivel</th>
                <th>Ultimo costo</th>
                <th>Precio unitario</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consumables as $consumable)
            <tr>
                <td>{{ $consumable->id_article ? $consumable->articles->description : 'Sin ID'}}
                <br>
                <small><strong>{{ $consumable->id_article }}</strong></small>
                </td>
                <td>{{ $consumable->package_quantity }}</td>
                <td>{{ $consumable->consumable_quantity }}</td>
                <td>{{ $consumable->level }}</td>
                <td>{{ number_format($consumable->id_article ? $consumable->articles->last_cost : 'Sin ID', 0, ',', '.'); }}</td>
                <td>{{ number_format($consumable->unit_price, 0,',', '.'); }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['consumables.destroy', $consumable->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('update_consumables')
                            <a href="{{ route('consumables.edit', [$consumable->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-edit" style="color: #6c6d77"></i>
                            </a>
                        @endcan
                        @can('destroy_consumables')
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
            Página <strong>{{ $consumables->currentPage() }}</strong> de <strong>{{ $consumables->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $consumables->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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