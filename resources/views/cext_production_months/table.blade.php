<div class="table-responsive" style="scrollbar-width: none">
    <table class="table table-hover shadow mb-3 rounded" id="cextProductionMonths-table">
        <thead>
            <tr>
                <th>Especialidad</th>
                <th>Enero</th>
                <th>Febrero</th>
                <th>Marzo</th>
                <th>Abril</th>
                <th>Mayo</th>
                <th>Junio</th>
                <th>Julio</th>
                <th>Agosto</th>
                <th>Septiembre</th>
                <th>Octubre</th>
                <th>Noviembre</th>
                <th>Diciembre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cextProductionMonths as $cextProductionMonth)
                <tr>
                    <td><strong>{{ $cextProductionMonth->specialty }}</strong></td>
                    <td>{{ number_format($cextProductionMonth->january, 0, ',', '.') }}</td>
                    <td>{{ number_format($cextProductionMonth->february, 0, ',', '.') }}</td>
                    <td>{{ number_format($cextProductionMonth->march, 0, ',', '.') }}</td>
                    <td>{{ number_format($cextProductionMonth->april, 0, ',', '.') }}</td>
                    <td>{{ number_format($cextProductionMonth->may, 0, ',', '.') }}</td>
                    <td>{{ number_format($cextProductionMonth->june, 0, ',', '.') }}</td>
                    <td>{{ number_format($cextProductionMonth->july, 0, ',', '.') }}</td>
                    <td>{{ number_format($cextProductionMonth->august, 0, ',', '.') }}</td>
                    <td>{{ number_format($cextProductionMonth->september, 0, ',', '.') }}</td>
                    <td>{{ number_format($cextProductionMonth->october, 0, ',', '.') }}</td>
                    <td>{{ number_format($cextProductionMonth->november, 0, ',', '.') }}</td>
                    <td>{{ number_format($cextProductionMonth->december, 0, ',', '.') }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['cextProductionMonths.destroy', $cextProductionMonth->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('show_cextProductionMonths')
                                <a href="{{ route('cextProductionMonths.show', [$cextProductionMonth->id]) }}"
                                    class='btn btn-default btn-xs'>
                                    <i class="far fa-eye" style="color: #13A4DA"></i>
                                </a>
                            @endcan
                            @can('update_cextProductionMonths')
                                <a href="{{ route('cextProductionMonths.edit', [$cextProductionMonth->id]) }}"
                                    class='btn btn-default btn-xs' title="Modificar">
                                    <i class="far fa-edit" style="color: #6c6d77"></i>
                                </a>
                            @endcan
                            @can('destroy_cextProductionMonths')
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
<div class="d-flex justify-content-between mb-1 mt-2" style="background-color: transparent">
    <!-- Muestra el número de página actual a la izquierda -->
    <div class="pagination-label">
        Página <strong>{{ $cextProductionMonths->currentPage() }}</strong> de
        <strong>{{ $cextProductionMonths->lastPage() }}</strong>
    </div>
    <!-- Muestra la paginación generada por Laravel a la derecha -->
    <div>
        {{ $cextProductionMonths->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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
{{-- <script>
    // Espera a que la página cargue
    document.addEventListener('DOMContentLoaded', function() {
        // Obtén todas las columnas
        var columns = document.querySelectorAll('#cextProductionMonths-table th');

        // Recorre cada columna
        for (var i = 0; i < columns.length; i++) {
            var column = columns[i];
            var columnId = column.id;

            // Verifica si todos los valores de la columna son 0
            var allZero = true;
            var rows = document.querySelectorAll('#cextProductionMonths-table td:nth-child(' + (i + 1) + ')');
            for (var j = 0; j < rows.length; j++) {
                if (parseFloat(rows[j].textContent.replace(',', '.')) !== 0) {
                    allZero = false;
                    break;
                }
            }

            // Si todos los valores son 0, oculta la columna
            if (allZero) {
                column.style.display = 'none';
                var columnCells = document.querySelectorAll('#cextProductionMonths-table td:nth-child(' + (i +
                    1) + ')');
                for (var k = 0; k < columnCells.length; k++) {
                    columnCells[k].style.display = 'none';
                }
            }
        }
    });
</script> --}}
