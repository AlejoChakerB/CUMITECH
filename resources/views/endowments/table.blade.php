<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="endowmentTable">
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Cargo</th>
                <th>Dotaciones entregadas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contracts as $contract)
            @if ($contract->employe->work_position != 'Pendiente')
            <tr>
                <td>
                    {{ $contract->employe->name }}
                    <br>
                    <small style="color: #69C5A0"><strong>{{ $contract->employe->dni }}</strong></small>
                <td>{{ $contract->employe->work_position }}</td>
                <td class="text-center"><strong>{{ $contract->endowment->count() }}</strong></td>
                <td width="120">
                    <div class='btn-group'>
                        @can('show_cards')
                        <a href="{{ route('endowment.employe', $contract->employe->id) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye" style="color: #13A4DA"></i>
                        </a>
                        @endcan
                    </div>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between mb-4">
        <!-- Muestra el número de página actual a la izquierda -->
        <div class="pagination-label">
            Página <strong>{{ $contracts->currentPage() }}</strong> de <strong>{{ $contracts->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $contracts->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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