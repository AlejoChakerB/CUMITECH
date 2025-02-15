<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="labours-table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Cargo</th>
                <th>Salario</th>
                <th>Valor minuto</th>
                <th colspan="2">Acciones</th>         
            </tr>
        </thead>
        <tbody>
            @foreach($labours as $labour)
            <tr>
                <td><strong>{{ $labour->Code }}</strong></td>
                <td>{{ $labour->position }}</td>
                <td>{{ number_format($labour->salary, 0, ',', '.'); }}</td>
                <td>{{ number_format($labour->labor_value, 0, ',', '.'); }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['labours.destroy', $labour->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('update_labour')
                            <a href="{{ route('labours.edit', [$labour->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-edit" style="color: #6c6d77"></i>
                            </a>
                        @endcan
                        @can('destroy_labour')
                            {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' => 'submit', 'class' => 'btn
                            btn-default btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>