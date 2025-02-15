<div class="table-responsive">
    <table class="table" id="logAmbulanceCosts-table">
        <thead>
        <tr>
            <th>Cups</th>
        <th>Old</th>
        <th>New</th>
        <th>Observation</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($logAmbulanceCosts as $logAmbulanceCost)
            <tr>
                <td>{{ $logAmbulanceCost->cups }}</td>
            <td>{{ $logAmbulanceCost->old }}</td>
            <td>{{ $logAmbulanceCost->new }}</td>
            <td>{{ $logAmbulanceCost->observation }}</td>
            <td>{{ $logAmbulanceCost->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['logAmbulanceCosts.destroy', $logAmbulanceCost->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('logAmbulanceCosts.show', [$logAmbulanceCost->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('logAmbulanceCosts.edit', [$logAmbulanceCost->id]) }}"
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
