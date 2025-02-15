<div class="table-responsive">
    <table class="table" id="logAccommodationCosts-table">
        <thead>
        <tr>
            <th>Id</th>
        <th>Old</th>
        <th>New</th>
        <th>Observation</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($logAccommodationCosts as $logAccommodationCost)
            <tr>
                <td>{{ $logAccommodationCost->id }}</td>
            <td>{{ $logAccommodationCost->old }}</td>
            <td>{{ $logAccommodationCost->new }}</td>
            <td>{{ $logAccommodationCost->observation }}</td>
            <td>{{ $logAccommodationCost->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['logAccommodationCosts.destroy', $logAccommodationCost->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('logAccommodationCosts.show', [$logAccommodationCost->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('logAccommodationCosts.edit', [$logAccommodationCost->id]) }}"
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
