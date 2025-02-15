<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="attendancesTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Empleado</th>
                <th>Día de trabajo</th>
                <th>Entrada - Salida</th>
                @canany(['show_attendances', 'update_attendances', 'destroy_attendances'])
                <th>Acciones</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td><strong>{{$attendance->id}}</strong></td>
                <td>
                    {{ $attendance->employe_id ? $attendance->employe->name : 'Sin ID'}}
                    <br>
                    <small style="color: #69C5A0"><strong>{{ $attendance->employe->work_position }}</strong></small>
                </td>
                <td style="vertical-align: middle">{{ $attendance->workday->format('Y-m-d') }}</td>
                <td style="vertical-align: middle">
                    <span class="badge text-black" style="background-color:#E0E0E0">{{ $attendance->aentry_time
                        }}</span>
                    - <span class="badge text-white" style="background-color:#FF8A65;">{{ $attendance->adeparture_time
                        }}</span>
                </td>
                <td>
                    <div class='btn-group'>
                        @can('show_attendances')
                        <a href="{{ route('attendances.show', [$attendance->id]) }}" 
                        class='btn btn-default btn-xs'>
                            <i class="far fa-eye" style="color: #13A4DA"></i>
                        </a>
                        @endcan
                        @can('update_attendances')
                        <a href="{{ route('attendances.edit', [$attendance->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit" style="color: #6c6d77"></i>
                        </a>
                        @endcan
                        @can('destroy_attendances')
                        {!! Form::open(['route' => ['attendances.destroy', $attendance->id], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' => 'submit',
                        'class' => 'btn
                        btn-default btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        {!! Form::close() !!}
                        @endcan
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between mb-4">
        <!-- Muestra el número de página actual a la izquierda -->
        <div class="pagination-label">
            Página <strong>{{ $attendances->currentPage() }}</strong> de <strong>{{ $attendances->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $attendances->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
        </div>
    </div>
</div>
<style>
    .pagination .page-item.active .page-link {
        background-color: #69C5A0;
        border-color: #69C5A0;
        color: white;
    }
</style>