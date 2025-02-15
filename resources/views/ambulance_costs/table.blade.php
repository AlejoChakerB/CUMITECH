<div class="table-responsive">
    <table class="table" id="ambulanceCosts-table">
        <thead>
            <tr>
                <th>Cups</th>
                <th>Nombre</th>
                <th>Valor</th>
                <th>Recargo</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ambulanceCosts as $ambulanceCost)
                <tr>
                    <td>{{ $ambulanceCost->cups }}</td>
                    <td>{{ $ambulanceCost->name }}</td>
                    <td>{{ number_format($ambulanceCost->value, 0, ',', '.') }}</td>
                    <td>{{ number_format($ambulanceCost->recharge, 0, ',', '.') }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['ambulanceCosts.destroy', $ambulanceCost->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('update_ambulanceCosts')
                                <a href="{{ route('ambulanceCosts.edit', [$ambulanceCost->id]) }}"
                                    class='btn btn-default btn-xs' title="Modificar">
                                    <i class="far fa-edit" style="color: #6c6d77"></i>
                                </a>
                            @endcan
                            @can('destroy_ambulanceCosts')
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
        Página <strong>{{ $ambulanceCosts->currentPage() }}</strong> de
        <strong>{{ $ambulanceCosts->lastPage() }}</strong>
    </div>
    <!-- Muestra la paginación generada por Laravel a la derecha -->
    <div>
        {{ $ambulanceCosts->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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
