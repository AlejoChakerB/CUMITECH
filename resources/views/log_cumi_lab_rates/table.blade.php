<div class="table-responsive">
    <table class="table" id="logCumiLabRates-table">
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
        @foreach($logCumiLabRates as $logCumiLabRate)
            <tr>
                <td>{{ $logCumiLabRate->cups }}</td>
            <td>{{ $logCumiLabRate->old }}</td>
            <td>{{ $logCumiLabRate->new }}</td>
            <td>{{ $logCumiLabRate->observation }}</td>
            <td>{{ $logCumiLabRate->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['logCumiLabRates.destroy', $logCumiLabRate->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('logCumiLabRates.show', [$logCumiLabRate->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('logCumiLabRates.edit', [$logCumiLabRate->id]) }}"
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
