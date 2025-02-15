<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="proceduresHomologators-table">
        <thead>
        <tr>
            <th>Cups</th>
            <th>SOAT</th>
            <th>ISS</th>
            <th>Grupo</th>
            <th>Subgrupo</th>
            <th>UVR</th>
            <th>Honoarario Iss</th>
            <th>Anest Iss</th>
            <th>UVT</th>
            <th>Honorario Soat</th>
            <th>Anest Soat</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($proceduresHomologators as $proceduresHomologator)
            <tr>
                <td>{{ $proceduresHomologator->cups }}</td>
                <td>{{ $proceduresHomologator->description_soat }}
                    <br>
                    <strong style="color: #A2C61E">CUPS: {{ $proceduresHomologator->cups_soat }}</strong>
                </td>
                <td>{{ $proceduresHomologator->description_iss }}
                    <br>
                    <strong style="color: #A2C61E">CUPS: {{ $proceduresHomologator->cups_iss }}</strong>
                </td>
                <td>{{ $proceduresHomologator->group }}</td>
                <td>{{ $proceduresHomologator->subgroup }}</td>
                <td>{{ $proceduresHomologator->uvr }}</td>
                <td>{{ number_format($proceduresHomologator->honorary_iss, 0, ',', '.'); }}</td>
                <td>{{ number_format($proceduresHomologator->anest_iss, 0, ',', '.'); }}</td>
                <td>{{ $proceduresHomologator->uvt }}</td>
                <td>{{ number_format($proceduresHomologator->honorary_soat, 0, ',', '.'); }}</td>
                <td>{{ number_format($proceduresHomologator->anest_soat, 0, ',', '.'); }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['proceduresHomologators.destroy', $proceduresHomologator->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('proceduresHomologators.show', [$proceduresHomologator->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye" style="color: #13A4DA"></i>
                        </a>
                        <a href="{{ route('proceduresHomologators.edit', [$proceduresHomologator->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit" style="color: #6c6d77"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
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
            Página <strong>{{ $proceduresHomologators->currentPage() }}</strong> de <strong>{{ $proceduresHomologators->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $proceduresHomologators->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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
