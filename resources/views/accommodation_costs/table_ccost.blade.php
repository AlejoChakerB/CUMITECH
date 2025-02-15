<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="accommodationCosts-table">
        <thead>
        <tr>
            <th>Centro de costos</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($accommodationCosts as $accommodationCost)
            <tr>
                <td>{{ $accommodationCost->service }}</td>
                <td width="120">
                    <div class='btn-group'>
                        <a href="{{ route('accommodationCosts.showCostCenter', ['service' => $accommodationCost->service]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye" style="color: #13A4DA"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-between mb-4">
    <!-- Muestra el número de página actual a la izquierda -->
    <div class="pagination-label">
        Página <strong>{{ $accommodationCosts->currentPage() }}</strong> de <strong>{{ $accommodationCosts->lastPage() }}</strong>
    </div>
    <!-- Muestra la paginación generada por Laravel a la derecha -->
    <div>
        {{ $accommodationCosts->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
    </div>
</div>
<style>
    .pagination .page-item .page-link{
        color: #2B3D63;
    }
    .pagination .page-item.active .page-link {
        background-color: #2B3D63;
        border-color: #2B3D63;
        color: white;
    }
</style>
