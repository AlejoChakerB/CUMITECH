<div class="table-responsive">
    <table class="table" id="logPatologies-table">
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
        @foreach($logPatologies as $logPatology)
            <tr>
                <td>{{ $logPatology->cups }}</td>
            <td>{{ $logPatology->old }}</td>
            <td>{{ $logPatology->new }}</td>
            <td>{{ $logPatology->observation }}</td>
            <td>{{ $logPatology->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['logPatologies.destroy', $logPatology->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('logPatologies.show', [$logPatology->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('logPatologies.edit', [$logPatology->id]) }}"
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
