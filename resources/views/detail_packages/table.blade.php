<div class="table-responsive">
    <table class="table" id="detailPackages-table">
        <thead>
            <tr>
            <th>Id</th>
            <th>Estudio</th>
            <th>Tipo</th>
            <th>Unidad funcional</th>
            <th>Código servicio</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Valor</th>
            <th>Costo unitario</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($detailPackages as $detailPackage)
            <tr>
                <td>{{ $detailPackage->id_factu }}</td>
                <td>{{ $detailPackage->study }}</td>
                <td>{{ $detailPackage->description }}</td>
                <td>{{ $detailPackage->funcional_unit }}</td>
                <td>{{ $detailPackage->code_service }}</td>
                <td>{{ $detailPackage->description_service }}</td>
                <td>{{ $detailPackage->quanty }}</td>
                <td>{{ number_format($detailPackage->recorded_cost, 0, ',', '.'); }}</td>
                <td>{{ number_format($detailPackage->unit_cost, 0, ',', '.'); }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['detailPackages.destroy', $detailPackage->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('show_detailPackages')
                        <a href="{{ route('detailPackages.show', [$detailPackage->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye" style="color: #13A4DA"></i>
                        </a>
                        @endcan
                        @can('update_detailPackages')
                        <a href="{{ route('detailPackages.edit', [$detailPackage->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit" style="color: #6c6d77"></i>
                        </a>
                        @endcan
                        @can('destroy_detailPackages')
                        {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
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
            Página <strong>{{ $detailPackages->currentPage() }}</strong> de <strong>{{ $detailPackages->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $detailPackages->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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
