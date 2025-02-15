<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="endowmentTable">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>N Servicio</th>
                <th>Procedimientos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($surgeries as $surgery)
            <tr>
                <td>{{ $surgery->date_surgery }}</td>
                <td>{{ $surgery->cod_surgical_act }}</td>
                <td><strong>{{ $surgery->msurgery_procedure->count() }}</strong></td>
                <td width="120">
                    <div class='btn-group'>
                        @can('view_costos')
                        <a href="{{ route('surgery.procedure', $surgery->cod_surgical_act) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye" style="color: #13A4DA"></i>
                        </a>
                        @endcan
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between mb-4">
        <!-- Muestra el número de página actual a la izquierda -->
        <div class="pagination-label">
            Página <strong>{{ $surgeries->currentPage() }}</strong> de <strong>{{ $surgeries->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $surgeries->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
        </div>
    </div>
</div>
<style>
    .pagination .page-item.active .page-link {
        background-color: #69C5A0;
        border-color: #69C5A0;
        color: white;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 10px; 
        margin-top: 10px;
        margin-right: 4px;
    }

    .dataTables_length select {
        border-radius: 10px; 
        margin-top: 10px;
    }
</style>