<div class="table-responsive">
    <table class="table" id="patologies-table">
        <thead>
        <tr>
            <th>Servicio</th>
        <th>Cups</th>
        <th>Descripcion</th>
        <th>Valor</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($patologies as $patology)
            <tr>
                <td>{{ $patology->service }}</td>
            <td>{{ $patology->cups }}</td>
            <td>{{ $patology->description }}</td>
            <td>{{ number_format($patology->value, 0, ',', '.'); }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['patologies.destroy', $patology->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('show_patologies')
                        <a href="{{ route('patologies.show', [$patology->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye" style="color: #13A4DA"></i>
                        </a>
                        @endcan
                        @can('update_patologies')
                        <a href="{{ route('patologies.edit', [$patology->id]) }}"
                           class='btn btn-default btn-xs' title="Modificar">
                            <i class="far fa-edit" style="color: #6c6d77"></i>
                        </a>
                        @endcan
                        @can('destroy_patologies')    
                        {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-xs', 'onclick' => "return confirm('Are you sure?')", 'title' => 'Eliminar']) !!}
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
