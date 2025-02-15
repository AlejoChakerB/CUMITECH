<div class="table-responsive">
    <table class="table" id="logDetailsUnitCosts-table">
        <thead>
        <tr>
            <th>Id Operation Cost</th>
        <th>Old</th>
        <th>New</th>
        <th>Observation</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($logDetailsUnitCosts as $logDetailsUnitCost)
            <tr>
                <td>{{ $logDetailsUnitCost->id_operation_cost }}</td>
            <td>{{ $logDetailsUnitCost->old }}</td>
            <td>{{ $logDetailsUnitCost->new }}</td>
            <td>{{ $logDetailsUnitCost->observation }}</td>
            <td>{{ $logDetailsUnitCost->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['logDetailsUnitCosts.destroy', $logDetailsUnitCost->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('logDetailsUnitCosts.show', [$logDetailsUnitCost->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('logDetailsUnitCosts.edit', [$logDetailsUnitCost->id]) }}"
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
