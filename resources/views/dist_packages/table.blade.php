<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="distPackages-table">
        <thead>
            <tr>
                <th>Id facturación</th>
                <th>Estudio</th>
                <th>N° servicio</th>
                <th>Cod Paquete</th>
                <th>Descripcion</th>
                <th>Costo unitario</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($distPackages as $distPackage)
                <tr>
                    <td>{{ $distPackage->id_factu }}</td>
                    <td>{{ $distPackage->study }}</td>
                    <td>{{ $distPackage->cod_surgical_act }}</td>
                    <td>{{ $distPackage->cod_package }}</td>
                    <td>{{ $distPackage->description }}</td>
                    <td>{{ number_format($distPackage->value, 0, ',', '.') }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['distPackages.destroy', $distPackage->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('show_distPackages')
                            <a href="{{ route('distPackages.show', [$distPackage->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-eye" style="color: #13A4DA"></i>
                            </a>
                            @endcan
                            @can('update_distPackages')
                            <a href="{{ route('distPackages.edit', [$distPackage->id]) }}"
                                class='btn btn-default btn-xs'>
                                <i class="far fa-edit" style="color: #6c6d77"></i>
                            </a>
                            @endcan
                            @can('destroy_distPackages')
                            {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-default btn-xs',
                                'onclick' => "return confirm('Are you sure?')",
                            ]) !!}
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
            Página <strong>{{ $distPackages->currentPage() }}</strong> de
            <strong>{{ $distPackages->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $distPackages->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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
