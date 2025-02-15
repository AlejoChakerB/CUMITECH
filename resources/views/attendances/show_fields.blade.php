<!-- Id Employe Field -->
<div class="col-sm-12">
    {!! Form::label('employe_id', 'Empleado:') !!}
    <p>{{ $attendance->employe_id ? $attendance->employe->name : 'Sin ID' }}</p>
</div>  

<!-- Workday Field -->
<div class="col-sm-12">
    {!! Form::label('workday', 'Dia de trabajo:') !!}
    <p>{{ $attendance->workday->format('Y-m-d') }}</p>
</div>

<!-- Entry Time Field -->
<div class="col-sm-12">
    {!! Form::label('aentry_time', 'Hora de entrada - hora de salida:') !!}
    <p>{{ $attendance->aentry_time }} - {{ $attendance->adeparture_time }}</p>
</div>

