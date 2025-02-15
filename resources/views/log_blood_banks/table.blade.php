<div class="table-responsive">
    <table class="table" id="logBloodBanks-table">
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
        @foreach($logBloodBanks as $logBloodBank)
            <tr>
                <td>{{ $logBloodBank->cups }}</td>
            <td>{{ $logBloodBank->old }}</td>
            <td>{{ $logBloodBank->new }}</td>
            <td>{{ $logBloodBank->observation }}</td>
            <td>{{ $logBloodBank->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['logBloodBanks.destroy', $logBloodBank->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('logBloodBanks.show', [$logBloodBank->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('logBloodBanks.edit', [$logBloodBank->id]) }}"
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
