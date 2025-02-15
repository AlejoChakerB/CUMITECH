<div class="table-responsive">
    <table class="table" id="logImagingProductionDetails-table">
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
        @foreach($logImagingProductionDetails as $logImagingProductionDetail)
            <tr>
                <td>{{ $logImagingProductionDetail->cups }}</td>
            <td>{{ $logImagingProductionDetail->old }}</td>
            <td>{{ $logImagingProductionDetail->new }}</td>
            <td>{{ $logImagingProductionDetail->observation }}</td>
            <td>{{ $logImagingProductionDetail->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['logImagingProductionDetails.destroy', $logImagingProductionDetail->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('logImagingProductionDetails.show', [$logImagingProductionDetail->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('logImagingProductionDetails.edit', [$logImagingProductionDetail->id]) }}"
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
