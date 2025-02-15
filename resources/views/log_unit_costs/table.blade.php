<div class="table-responsive">
    <table class="table" id="logUnitCosts-table">
        <thead>
        <tr>
            <th>Cod Surgical Act</th>
        <th>Old</th>
        <th>New</th>
        <th>Observation</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($logUnitCosts as $logUnitCost)
            <tr>
                <td>{{ $logUnitCost->cod_surgical_act }}</td>
            <td>{{ $logUnitCost->old }}</td>
            <td>{{ $logUnitCost->new }}</td>
            <td>{{ $logUnitCost->observation }}</td>
            <td>{{ $logUnitCost->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['logUnitCosts.destroy', $logUnitCost->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('logUnitCosts.show', [$logUnitCost->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('logUnitCosts.edit', [$logUnitCost->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
