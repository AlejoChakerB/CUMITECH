<div class="table-responsive">
    <table class="table" id="logDiferentialRates-table">
        <thead>
        <tr>
            <th>Id Drate</th>
        <th>Old</th>
        <th>Nuew</th>
        <th>Observation</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($logDiferentialRates as $logDiferentialRates)
            <tr>
                <td>{{ $logDiferentialRates->id_drate }}</td>
            <td>{{ $logDiferentialRates->old }}</td>
            <td>{{ $logDiferentialRates->nuew }}</td>
            <td>{{ $logDiferentialRates->observation }}</td>
            <td>{{ $logDiferentialRates->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['logDiferentialRates.destroy', $logDiferentialRates->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('logDiferentialRates.show', [$logDiferentialRates->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('logDiferentialRates.edit', [$logDiferentialRates->id]) }}"
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
