<div class="table-responsive">
    <table class="table" id="doctorsChanges-table">
        <thead>
        <tr>
            <th>Fecha</th>
            <th>Code Doctor</th>
            <th>Old</th>
            <th>New</th>
            <th>Observation</th>
            <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($doctorsChanges as $doctorsChanges)
            <tr>
                <td>{{ $doctorsChanges->created_at }}</td>
                <td>{{ $doctorsChanges->code_doctor }}</td>
                <td>{{ $doctorsChanges->old }}</td>
                <td>{{ $doctorsChanges->new }}</td>
                <td>{{ $doctorsChanges->observation }}</td>
                <td>{{ $doctorsChanges->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['doctorsChanges.destroy', $doctorsChanges->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('doctorsChanges.show', [$doctorsChanges->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('doctorsChanges.edit', [$doctorsChanges->id]) }}"
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
