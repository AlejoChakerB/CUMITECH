<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="imagingProductions-table">
        <thead>
            <tr>
                <th>Estudio</th>
                <th>Orden</th>
                <th>Cups</th>
                <th>Paciente</th>
                <th>Fecha</th>
                <th>Médico</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($imagingProductions as $imagingProduction)
            <tr>
                <td>{{ $imagingProduction->go_study }}</td>
                <td>{{ $imagingProduction->id_order }}</td>
                <td>{{ $imagingProduction->cups ? $imagingProduction->procedures->description : 'NULL' }}</td>
                <td>{{ $imagingProduction->name_patient }}
                <br>
                <small><strong style="color: #A2C61E">{{ $imagingProduction->dni_patient }}</strong></samll>
                </td>
                <td>{{ $imagingProduction->date }}
                <br>
                <small><strong style="color: #A2C61E">{{ $imagingProduction->hour }}</strong></small>
                </td>
                <td>{{ $imagingProduction->cod_medi ? $imagingProduction->doctors->full_name: 'NULL' }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['imagingProductions.destroy', $imagingProduction->id], 'method' =>
                    'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('imagingProductions.show', [$imagingProduction->id]) }}"
                            class='btn btn-default btn-xs'>
                            <i class="far fa-eye" style="color: #13A4DA"></i>
                        </a>
                        <a href="{{ route('imagingProductions.edit', [$imagingProduction->id]) }}"
                            class='btn btn-default btn-xs' style="color: #6c6d77">
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' => 'submit', 'class' => 'btn
                        btn-default btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between mb-1 mt-2" style="background-color: transparent">
        <!-- Muestra el número de página actual a la izquierda -->
        <div class="pagination-label">
            Página <strong>{{ $imagingProductions->currentPage() }}</strong> de <strong>{{ $imagingProductions->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $imagingProductions->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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

    .pagination .page-item.active .page-link {
        background-color: #14ABE3;
        border-color: #14ABE3;
        color: white;
    }

    th:nth-child(5), td:nth-child(5) {
        width: 10%; /* Ancho para la columna "Fecha" */
    }
</style>