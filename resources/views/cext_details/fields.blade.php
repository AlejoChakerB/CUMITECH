<!-- Specialty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('specialty', 'Especialidad:') !!}
    {!! Form::text('specialty', null, ['class' => 'form-control', 'placeholder' => 'Digite la especialidad']) !!}
</div>

<!-- Procedure Field -->
<div class="form-group col-sm-6">
    {!! Form::label('procedure', 'Procedimiento:') !!}
    {!! Form::select('procedure', $procedures, null, ['class' => 'form-control', 'placeholder' => 'Seleccione el procedimiento']) !!}
</div>

<!-- Room Cost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration', 'Duracion:') !!}
    {!! Form::number('duration', null, ['class' => 'form-control', 'placeholder' => 'Digite la duración']) !!}
</div>