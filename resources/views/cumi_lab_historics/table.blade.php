<div class="table-responsive">
    <table class="table" id="cumiLabHistorics-table">
        <thead>
        <tr>
            <th>Period</th>
        <th>January</th>
        <th>February</th>
        <th>March</th>
        <th>April</th>
        <th>May</th>
        <th>June</th>
        <th>July</th>
        <th>August</th>
        <th>September</th>
        <th>October</th>
        <th>November</th>
        <th>December</th>
        <th>Total Months</th>
        <th>Average Months</th>
        <th>Cumilab Rate</th>
        <th>Mutual Rate</th>
        <th>Pxq</th>
        <th>Part Percentage</th>
        <th>Adminlog</th>
        <th>Adminlog Percentage</th>
        <th>Cd</th>
        <th>Cd Percentage</th>
        <th>Total</th>
        <th>Cups</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cumiLabHistorics as $cumiLabHistoric)
            <tr>
                <td>{{ $cumiLabHistoric->period }}</td>
            <td>{{ $cumiLabHistoric->january }}</td>
            <td>{{ $cumiLabHistoric->february }}</td>
            <td>{{ $cumiLabHistoric->march }}</td>
            <td>{{ $cumiLabHistoric->april }}</td>
            <td>{{ $cumiLabHistoric->may }}</td>
            <td>{{ $cumiLabHistoric->june }}</td>
            <td>{{ $cumiLabHistoric->july }}</td>
            <td>{{ $cumiLabHistoric->august }}</td>
            <td>{{ $cumiLabHistoric->september }}</td>
            <td>{{ $cumiLabHistoric->october }}</td>
            <td>{{ $cumiLabHistoric->november }}</td>
            <td>{{ $cumiLabHistoric->december }}</td>
            <td>{{ $cumiLabHistoric->total_months }}</td>
            <td>{{ $cumiLabHistoric->average_months }}</td>
            <td>{{ $cumiLabHistoric->cumilab_rate }}</td>
            <td>{{ $cumiLabHistoric->mutual_rate }}</td>
            <td>{{ $cumiLabHistoric->pxq }}</td>
            <td>{{ $cumiLabHistoric->part_percentage }}</td>
            <td>{{ $cumiLabHistoric->adminlog }}</td>
            <td>{{ $cumiLabHistoric->adminlog_percentage }}</td>
            <td>{{ $cumiLabHistoric->cd }}</td>
            <td>{{ $cumiLabHistoric->cd_percentage }}</td>
            <td>{{ $cumiLabHistoric->total }}</td>
            <td>{{ $cumiLabHistoric->cups }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cumiLabHistorics.destroy', $cumiLabHistoric->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cumiLabHistorics.show', [$cumiLabHistoric->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cumiLabHistorics.edit', [$cumiLabHistoric->id]) }}"
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
