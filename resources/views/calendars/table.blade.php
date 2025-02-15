<div class="table-responsive">
    <table class="table table-hover shadow mb-3 rounded" id="calendarsTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Empleado</th>
                <th>Calendario laboral</th>
                <th style="text-align: center">Horario laboral</th>
                <th>Piso</th>
                @canany(['show_calendars', 'update_calendars', 'destroy_calendars'])
                <th>Acciones</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach($calendars as $calendar)
            <tr>
                <td><strong>{{$calendar->id}}</strong></td>
                <td>
                    {{ $calendar->employe_id ? $calendar->employe->name : 'Sin ID' }}
                    <br>
                    <small style="color: #69C5A0"><strong>{{ $calendar->employe->work_position }}</strong></small>
                </td>
                <td style="vertical-align: middle">
                    <small>{{ $calendar->start_date->format('Y-m-d') }} - {{ $calendar->end_date->format('Y-m-d')
                        }}</small>
                </td>
                <td style="text-align: center">
                    <span class="badge text-black" style="background-color:#E0E0E0">{{ $calendar->entry_time }}</span>
                    <br><span class="badge text-white" style="background-color:#FF8A65;">{{ $calendar->departure_time
                        }}</span>
                </td>
                <td style="vertical-align: middle">{{ $calendar->floor }}</td>

                <td>
                    <div class='btn-group'>
                        @can('show_calendars')
                        <a href="{{ route('calendars.show', [$calendar->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye" style="color: #13A4DA"></i>
                        </a>
                        @endcan
                        @can('update_calendars')
                        <a href="{{ route('calendars.edit', [$calendar->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit" style="color: #6c6d77"></i>
                        </a>
                        @endcan
                        @can('destroy_calendars')
                        {!! Form::open(['route' => ['calendars.destroy', $calendar->id], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' => 'submit',
                        'class' => 'btn btn-default btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
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
            Página <strong>{{ $calendars->currentPage() }}</strong> de <strong>{{ $calendars->lastPage() }}</strong>
        </div>
        <!-- Muestra la paginación generada por Laravel a la derecha -->
        <div>
            {{ $calendars->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
        </div>
    </div>
</div>

<style>
    .custom-title {
        color: #14ABE3;
        /* Cambia el color del título a rojo */
    }

    .custom-icon::before {
        color: #cf33ff;
        /* Cambia el color del icono a rojo */
    }

    .pagination .page-item.active .page-link {
        background-color: #69C5A0;
        border-color: #69C5A0;
        color: white;
    }
</style>