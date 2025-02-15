<!-- Group Field -->
<div class="form-group col-sm-6">
    {!! Form::label('group', 'Grupo:') !!}
    {!! Form::number('group', null, ['class' => 'form-control', 'placeholder' => 'Digite el grupo SOAT']) !!}
</div>

<!-- Surgeon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('surgeon', 'Cirujano:') !!}
    {!! Form::number('surgeon', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor del cirujano']) !!}
</div>

<!-- Anesthed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('anesthed', 'Anestesiologo:') !!}
    {!! Form::number('anesthed', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor del anestesiologo']) !!}
</div>

<!-- Assistant Field -->
<div class="form-group col-sm-6">
    {!! Form::label('assistant', 'Asistente:') !!}
    {!! Form::number('assistant', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor del asistente']) !!}
</div>

<!-- Room Field -->
<div class="form-group col-sm-6">
    {!! Form::label('room', 'Sala:') !!}
    {!! Form::number('room', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor de la sala']) !!}
</div>

<!-- Materials Field -->
<div class="form-group col-sm-6">
    {!! Form::label('materials', 'Materiales:') !!}
    {!! Form::number('materials', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor de los materiales']) !!}
</div>