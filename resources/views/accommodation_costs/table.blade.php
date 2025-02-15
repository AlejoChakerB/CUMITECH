<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="accommodationCosts-table">
        <thead>
            <tr>
                <th>Mes</th>
                <th>Gastos fijos</th>
                <th>Gastos variables</th>
                <th>Dist admin</th>
                <th>Dist logistic</th>
                <th>Mano obra planta/Cont</th>
                <th>Costo total</th>
                <th>Costo día estancia</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accommodationCosts as $accommodationCost)
                <tr>
                    <td>{{ $accommodationCost->month }}</td>
                    <td>{{ number_format($accommodationCost->permanent_overhead, 0, ',', '.') }}</td>
                    <td>{{ number_format($accommodationCost->variable_overhead, 0, ',', '.') }}</td>
                    <td>{{ number_format($accommodationCost->administrative_twoLevel, 0, ',', '.') }}</td>
                    <td>{{ number_format($accommodationCost->logistic_twoLevel, 0, ',', '.') }}</td>
                    <td>{{ number_format($accommodationCost->plant_labour + $accommodationCost->labour, 0, ',', '.') }}</td>
                    <td>{{ number_format($accommodationCost->total_cost, 0, ',', '.') }}</td>
                    <td>{{ number_format($accommodationCost->dayAccommodation_cost, 0, ',', '.') }}</td>
                    <td width="120">
                        <div class='btn-group'>
                            @can('show_accommodationCosts')
                                <a href="{{ route('accommodationCosts.show', [$accommodationCost->id]) }}"
                                    class='btn btn-default btn-xs'>
                                    <i class="far fa-eye" style="color: #13A4DA"></i>
                                </a>
                            @endcan
                            @can('update_accommodationCosts')
                                <a href="{{ route('accommodationCosts.edit', [$accommodationCost->id]) }}"
                                    class='btn btn-default btn-xs'>
                                    <i class="far fa-edit" style="color: #6c6d77"></i>
                                </a>
                            @endcan
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
        Página <strong>{{ $accommodationCosts->currentPage() }}</strong> de
        <strong>{{ $accommodationCosts->lastPage() }}</strong>
    </div>
    <!-- Muestra la paginación generada por Laravel a la derecha -->
    <div>
        {{ $accommodationCosts->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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
