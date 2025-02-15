<div class="table-responsive" style="scrollbar-width: none">
    <table class="table table-hover shadow mb-3 rounded" id="bloodBankMonths-table">
        <thead>
            <tr>
                <th>Cups</th>
                <th>Procedimiento</th>
                <th>Total producido</th>
                <th>Promedio mes</th>
                <th>Facturacion promedio</th>
                <th>%Part</th>
                <th>Honorario</th>
                <th>Dist log</th>
                <th>Dist Adm</th>
                <th>Costo total</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bloodBankMonths as $bloodBankMonth)
                <tr>
                    <td>{{ $bloodBankMonth->cups }}</td>
                    <td>{{ $bloodBankMonth->cups ? $bloodBankMonth->procedures->description : 'SIN ID' }}</td>
                    <td>{{ number_format($bloodBankMonth->total_months, 0, ',', '.') }}</td>
                    <td>{{ number_format($bloodBankMonth->average_months, 0, ',', '.') }}</td>
                    <td>{{ number_format($bloodBankMonth->average_value, 0, ',', '.') }}</td>
                    <td>{{ number_format($bloodBankMonth->participe, 0, ',', '.') }}%</td>
                    <td>{{ number_format($bloodBankMonth->honorary_bs, 0, ',', '.') }}</td>
                    <td>{{ number_format($bloodBankMonth->log, 0, ',', '.') }}</td>
                    <td>{{ number_format($bloodBankMonth->admin, 0, ',', '.') }}</td>
                    <td>{{ number_format($bloodBankMonth->total_cost, 0, ',', '.') }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['bloodBankMonths.destroy', $bloodBankMonth->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('show_bloodBankMonths')
                                <a href="{{ route('bloodBankMonths.show', [$bloodBankMonth->id]) }}"
                                    class='btn btn-default btn-xs'>
                                    <i class="far fa-eye" style="color: #13A4DA"></i>
                                </a>
                            @endcan
                            @can('update_bloodBankMonths')
                                <a href="{{ route('bloodBankMonths.edit', [$bloodBankMonth->id]) }}"
                                    class='btn btn-default btn-xs' title="Modificar">
                                    <i class="far fa-edit" style="color: #6c6d77"></i>
                                </a>
                            @endcan
                            @can('destroy_bloodBankMonths')
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
        Página <strong>{{ $bloodBankMonths->currentPage() }}</strong> de
        <strong>{{ $bloodBankMonths->lastPage() }}</strong>
    </div>
    <!-- Muestra la paginación generada por Laravel a la derecha -->
    <div>
        {{ $bloodBankMonths->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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
