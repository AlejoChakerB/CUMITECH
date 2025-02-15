<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="baskets-table">
        <thead>
            <tr>
                <th>Código cirugia</th>
                <th style="text-align: center">Cantidad articulos</th>
                <th>Costo</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($baskets as $basket)
            <tr>
                <td><strong>{{ $basket->surgical_act }}</strong></td>
                <td style="text-align: center">{{ $basket->total }}</td>
                <td>{{ number_format($basket->unit_cost, 0, ',', '.'); }}</td>
                <td width="180">
                    <div class='btn-group'>
                        <a href="{{ route('basket.showBasket',  $basket->surgical_act) }}" class="btn btn-default" title="Agregar contracto"
                            style="background-color: #2B3D63; color: white; position: relative;" id="btnAdd">
                            <div id="contentAdd" class="btn-content"><i class="fas fa-box-open"></i> Ver canasta</div>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between mb-4">
        <!-- Muestra el número de página actual a la izquierda -->
        <div class="pagination-label">
            Página <strong>{{ $baskets->currentPage() }}</strong> de <strong>{{ $baskets->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $baskets->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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