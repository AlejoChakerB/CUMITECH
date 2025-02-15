<div class="table-responsive">
    <table class="table table-hover" id="control-table">
        <thead>
        <tr>
            <th>Empleado</th>
            <th>Calendario</th>
            <th>Día de trabajo</th>
            <th class="text-center">Llegada tarde</th>
            <th class="text-center">Salida temprano</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tablaAsistencias as $asistencia)
            <tr>
                <td>
                    {{ $asistencia['name'] }}
                    <br>
                    <small>{{ $asistencia['work_position'] }}</small>
                </td>
                <td class="align-middle">
                    <small>{{ $asistencia['start_date'] }} - {{ $asistencia['end_date'] }}</small>
                    <br>
                    <span class="badge bg-gray-dark">{{ $asistencia['entry_time'] }}</span> - 
                    <span class="badge bg-indigo">{{ $asistencia['departure_time'] }}</span>
                </td>
                <td class="align-middle">
                    <small>{{ $asistencia['workday'] }}</small>
                    <br>
                    <span class="badge bg-green">{{ $asistencia['aentry_time'] }}</span> -
                    <span class="badge bg-primary">{{ $asistencia['adeparture_time'] }}</span>
                </td>
                <td class="align-middle text-center">{{ $asistencia['entrada_tarde'] }}</td>
                <td class="align-middle text-center">{{ $asistencia['salida_temprana'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
