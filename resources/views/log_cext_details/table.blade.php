<div class="table-responsive">
    <table class="table" id="logCextDetails-table">
        <thead>
        <tr>
            <th>Id Cextdetail</th>
        <th>Old</th>
        <th>New</th>
        <th>Observation</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($logCextDetails as $logCextDetails)
            <tr>
                <td>{{ $logCextDetails->id_cextDetail }}</td>
            <td>{{ $logCextDetails->old }}</td>
            <td>{{ $logCextDetails->new }}</td>
            <td>{{ $logCextDetails->observation }}</td>
            <td>{{ $logCextDetails->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['logCextDetails.destroy', $logCextDetails->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('logCextDetails.show', [$logCextDetails->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('logCextDetails.edit', [$logCextDetails->id]) }}"
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
