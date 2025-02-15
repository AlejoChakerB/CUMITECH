<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="cextHourcosts-table">
        <thead>
        <tr>
            <th>Conceptos</th>
            <th>Valores</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cextHourcosts as $cextHourcost)
            <tr>
                <td>Gastos Generales Fijos</td>
                <td>{{ number_format($cextHourcost->permanent_overhead, 0, ',', '.'); }}</td>
            </tr>
            <tr>
                <td>Gastos Generales Variables</td>
                <td>{{ number_format($cextHourcost->variable_overhead, 0, ',', '.'); }}</td>
            </tr>
            <tr>
                <td>Gastos Administrativos Segundo Nivel</td>
                <td>{{ number_format($cextHourcost->administrative_twoLevel, 0, ',', '.'); }}</td>
            </tr>
            <tr>
                <td>Gastos logísticos Segundo Nivel</td>
                <td>{{ number_format($cextHourcost->logistic_twoLevel, 0, ',', '.'); }}</td>
            </tr>
            <tr>
                <td>Mano De Obra Planta</td>
                <td>{{ number_format($cextHourcost->plant_labour, 0, ',', '.'); }}</td>
            </tr>
            <tr>
                <td>Días producidos al mes</td>
                <td>{{ $cextHourcost->days_produced }}</td>
            </tr>
            <tr>
                <td>Horas producidas por día</td>
                <td>{{ $cextHourcost->hours_producedxday }}</td>
            </tr>
            <tr>
                <td>Horas producidas por mes</td>
                <td>{{ number_format($cextHourcost->hours_producedxmonth, 0, ',', '.'); }}</td>
            </tr>
            <tr>
                <td>Costo total</td>
                <td>{{ number_format($cextHourcost->total_cost, 0, ',', '.'); }}</td>
            </tr>
            <tr>
                <td>Costo de la sala</td>
                <td>{{ number_format($cextHourcost->room_valueTotal, 0, ',', '.'); }}</td>
            </tr>
            {{-- <tr>
                <td width="120">
                    {!! Form::open(['route' => ['cextHourcosts.destroy', $cextHourcost->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cextHourcosts.show', [$cextHourcost->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cextHourcosts.edit', [$cextHourcost->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr> --}}
        @endforeach
        </tbody>
    </table>
</div>
