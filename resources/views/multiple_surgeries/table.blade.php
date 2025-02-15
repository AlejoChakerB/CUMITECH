<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="multipleSurgeries-table">
        <thead>
        <tr>
            <th>Código</th>
            <th>Estudio</th>
            <th>Fecha</th>
            <th>Tiempo cirugia</th>
            <th>Médico</th>
            <th colspan="4">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($multipleSurgeries as $multipleSurgery)
            <tr>
                <td>{{ $multipleSurgery->mcod_surgical_act }}</td>
                <td>{{ $multipleSurgery->mstudy_number }}</td>
                <td>{{ $multipleSurgery->mdate_surgery }}</td>
                <td>{{ $multipleSurgery->mstart_time }} - {{ $multipleSurgery->mend_time }}
                    <br>
                    <small style="color: #69C5A0"><strong>{{ $multipleSurgery->msurgery_time }} Minutos</strong></small>
                </td>
                <td>{{ $multipleSurgery->id_doctor }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['multipleSurgeries.destroy', $multipleSurgery->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="" class='btn btn-default btn-xs'>
                            <i class="fas fa-coins" style="color: #ffbf00"></i>
                        </a>
                        <a href="{{ route('multipleSurgeries.show', [$multipleSurgery->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye" style="color: #13A4DA"></i>
                        </a>
                        <a href="{{ route('multipleSurgeries.edit', [$multipleSurgery->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit" style="color: #6c6d77"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
