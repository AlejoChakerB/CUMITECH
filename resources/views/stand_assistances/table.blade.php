<div class="table-responsive">
    <table class="table" id="standAssistances-table">
        <thead>
            <tr>
                <th>Stand</th>
                <th>State</th>
                <th>Approved Date</th>
                <th>Id User Employees</th>
                <th>Id Presenter</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($standAssistances as $standAssistance)
                <tr>
                    <td>{{ $standAssistance->stand }}</td>
                    <td>{{ $standAssistance->state }}</td>
                    <td>{{ $standAssistance->approved_date }}</td>
                    <td>{{ $standAssistance->id_user_employees }}</td>
                    <td>{{ $standAssistance->id_presenter }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['standAssistances.destroy', $standAssistance->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('show_standAssistances')
                                <a href="{{ route('standAssistances.show', [$standAssistance->id]) }}"
                                    class='btn btn-default btn-xs'>
                                    <i class="far fa-eye"></i>
                                </a>
                            @endcan
                            @can('update_standAssistances')
                                <a href="{{ route('standAssistances.edit', [$standAssistance->id]) }}"
                                    class='btn btn-default btn-xs'>
                                    <i class="far fa-edit"></i>
                                </a>
                            @endcan
                            @can('destroy_standAssistances')
                                {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
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
