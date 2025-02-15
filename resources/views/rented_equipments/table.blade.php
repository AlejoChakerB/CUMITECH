<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="rentedEquipments-table">
        <thead>
            <tr>
                <th>Especialidad</th>
                <th>CUPS</th>
                <th>Codigo</th>
                <th>Equipo</th>
                <th>Valor</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentedEquipments as $rentedEquipment)
                <tr>
                    <td>{{ $rentedEquipment->specialty }}</td>
                    <td>{{ $rentedEquipment->procedure_id }}</td>
                    <td>{{ $rentedEquipment->art_code }}</td>
                    <td>{{ $rentedEquipment->description }}</td>
                    <td>{{ number_format($rentedEquipment->value, 0, ',', '.') }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['rentedEquipments.destroy', $rentedEquipment->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('show_rentedEquipments')
                                <a href="{{ route('rentedEquipments.show', [$rentedEquipment->id]) }}"
                                    class='btn btn-default btn-xs'>
                                    <i class="far fa-eye" style="color: #13A4DA"></i>
                                </a>
                            @endcan
                            @can('update_rentedEquipments')
                                <a href="{{ route('rentedEquipments.edit', [$rentedEquipment->id]) }}"
                                    class='btn btn-default btn-xs'>
                                    <i class="far fa-edit" style="color: #6c6d77"></i>
                                </a>
                            @endcan
                            @can('destroy_rentedEquipments')
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
</div>
