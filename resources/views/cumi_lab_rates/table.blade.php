<div class="table-responsive" style="scrollbar-width: none">
    <table class="table table-hover shadow mb-3 rounded" id="cumiLabRates-table">
        <thead>
            <tr>
                <th>CUPS</th>
                <th>Cantidad producida</th>
                <th>Promedio mes</th>
                <th>Tarifa CumiLab</th>
                <th>Tarifa Mutual</th>
                <th>PXQ</th>
                <th>%Partic</th>
                <th>Dist AdminYLog</th>
                <th>Dist Costo directo</th>
                <th>Costo unitario</th>
                <th>Observacion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cumiLabRates as $cumiLabRate)
                <tr>
                    <td><strong style="color: #A2C61E">CUPS: {{ $cumiLabRate->cups }} - </strong>
                        {{ $cumiLabRate->cups ? $cumiLabRate->procedures->description : 'SIN ID' }}
                    </td>
                    <td>{{ number_format($cumiLabRate->total_months, 0, ',', '.') }}</td>
                    <td>{{ number_format($cumiLabRate->average_months, 0, ',', '.') }}</td>
                    <td>{{ number_format($cumiLabRate->cumilab_rate, 0, ',', '.') }}</td>
                    <td>{{ number_format($cumiLabRate->mutual_rate, 0, ',', '.') }}</td>
                    <td>{{ number_format($cumiLabRate->pxq, 0, ',', '.') }}</td>
                    <td>{{ number_format($cumiLabRate->part_percentage, 2, ',', '.') }}</td>
                    <td>{{ number_format($cumiLabRate->adminlog_percentage, 0, ',', '.') }}</td>
                    <td>{{ number_format($cumiLabRate->cd_percentage, 0, ',', '.') }}</td>
                    <td>{{ number_format($cumiLabRate->total, 0, ',', '.') }}</td>
                    <td>{{ $cumiLabRate->observation }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['cumiLabRates.destroy', $cumiLabRate->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('show_cumiLabRates')
                                <a href="#" class='btn btn-default btn-xs' data-bs-toggle="modal"
                                    data-bs-target="#modalShowData" onclick="showData({{ $cumiLabRate->id }})">
                                    <i class="far fa-eye" style="color: #13A4DA"></i>
                                </a>
                            @endcan
                            @can('update_cumiLabRates')
                                <a href="{{ route('cumiLabRates.edit', [$cumiLabRate->id]) }}"
                                    class='btn btn-default btn-xs' title="Modificar">
                                    <i class="far fa-edit" style="color: #6c6d77"></i>
                                </a>
                            @endcan
                            @can('destroy_cumiLabRates')
                                {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-default btn-xs',
                                    'onclick' => "return confirm('Are you sure?')",
                                    'title' => 'Eliminar',
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
            Página <strong>{{ $cumiLabRates->currentPage() }}</strong> de
            <strong>{{ $cumiLabRates->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $cumiLabRates->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
        </div>
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
<script>
    function showData(id) {
        $.ajax({
            url: '/cumiLabRates/' + id,
            type: 'GET',
            success: function(data) {
                // Aquí puedes llenar los campos del modal con los datos de la fila
                $('#modalShowDataLabel').text('Datos de la fila ' + data.id);
                //Enero
                var january = parseFloat(data.january);
                var totalJanuary = january;
                $('#january').text(january);
                $('#totalJanuary').text(totalJanuary);
                //Febrero
                var february = parseFloat(data.february)
                var totalFebruary = totalJanuary + february
                $('#february').text(february);
                $('#totalFebruary').text(totalFebruary);
                //Marzo
                var march = parseFloat(data.march)
                var totalMarch = totalFebruary + march
                $('#march').text(march);
                $('#totalMarch').text(totalMarch);
                //Abril
                var april = parseFloat(data.april)
                var totalApril = totalMarch + april
                $('#april').text(april);
                $('#totalApril').text(totalApril);
                //Mayo
                var may = parseFloat(data.may)
                var totalMay = totalApril + may
                $('#may').text(may);
                $('#totalMay').text(totalMay);
                //Junio
                var june = parseFloat(data.june)
                var totalJune = totalMay + june
                $('#june').text(june);
                $('#totalJune').text(totalJune);
                //Julio
                var july = parseFloat(data.july)
                var totalJuly = totalJune + july
                $('#july').text(july);
                $('#totalJuly').text(totalJuly);
                //Agosto
                var august = parseFloat(data.august)
                var totalAugust = totalJuly + august
                $('#august').text(august);
                $('#totalAugust').text(totalAugust);
                //Septiembre
                var september = parseFloat(data.september)
                var totalSeptember = totalAugust + september
                $('#september').text(september);
                $('#totalSeptember').text(totalSeptember);
                //Octubre
                var october = parseFloat(data.october)
                var totalOctober = totalSeptember + october
                $('#october').text(october);
                $('#totalOctober').text(totalOctober);
                //Noviembre
                var november = parseFloat(data.november)
                var totalNovember = totalOctober + november
                $('#november').text(november);
                $('#totalNovember').text(totalNovember);
                //Diciembre
                var december = parseFloat(data.december)
                var totalDecember = totalNovember + december
                $('#december').text(december);
                $('#totalDecember').text(totalDecember);
            },
            error: function() {
                alert('Error al cargar los datos');
            }
        });
    }
</script>
<!-- Modal show-->
<div class="modal fade" id="modalShowData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h5 class="modal-title" id="staticBackdropLabel"><strong style="color: #14ABE6">Detalles mes</strong>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr style="color: #21800f">
                            <th scope="col">Mes</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Acumulado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" style="color: #14ABE6">Enero</th>
                            <td id="january"></td>
                            <td id="totalJanuary"></td>
                        </tr>
                        <tr>
                            <th scope="row" style="color: #14ABE6">Febrero</th>
                            <td id="february"></td>
                            <td id="totalFebruary"></td>
                        </tr>
                        <tr>
                            <th scope="row" style="color: #14ABE6">Marzo</th>
                            <td id="march"></td>
                            <td id="totalMarch"></td>
                        </tr>
                        <tr>
                            <th scope="row" style="color: #14ABE6">Abril</th>
                            <td id="april"></td>
                            <td id="totalApril"></td>
                        </tr>
                        <tr>
                            <th scope="row" style="color: #14ABE6">Mayo</th>
                            <td id="may"></td>
                            <td id="totalMay"></td>
                        </tr>
                        <tr>
                            <th scope="row" style="color: #14ABE6">Junio</th>
                            <td id="june"></td>
                            <td id="totalJune"></td>
                        </tr>
                        <tr>
                            <th scope="row" style="color: #14ABE6">Julio</th>
                            <td id="july"></td>
                            <td id="totalJuly"></td>
                        </tr>
                        <tr>
                            <th scope="row" style="color: #14ABE6">Agosto</th>
                            <td id="august"></td>
                            <td id="totalAugust"></td>
                        </tr>
                        <tr>
                            <th scope="row" style="color: #14ABE6">Septiembre</th>
                            <td id="september"></td>
                            <td id="totalSeptember"></td>
                        </tr>
                        <tr>
                            <th scope="row" style="color: #14ABE6">Octubre</th>
                            <td id="october"></td>
                            <td id="totalOctober"></td>
                        </tr>
                        <tr>
                            <th scope="row" style="color: #14ABE6">Noviembre</th>
                            <td id="november"></td>
                            <td id="totalNovember"></td>
                        </tr>
                        <tr>
                            <th scope="row" style="color: #14ABE6">Diciembre</th>
                            <td id="december"></td>
                            <td id="totalDecember"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
