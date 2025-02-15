<!-- Service Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service', 'Servicio:') !!}
    {!! Form::select('service', [
        'ECOCARDIOGRAMA' => 'ECOCARDIOGRAMA',
        'ECOGRAFIA' => 'ECOGRAFIA',
        'MAMOGRAFIA' => 'MAMOGRAFIA',
        'TOMOGRAFIA COMPUTADA' => 'TOMOGRAFIA COMPUTADA',
        'RADIOGRAFIA COMPUTADA' => 'RADIOGRAFIA COMPUTADA',
        'RESONANCIA MAGNETICA' => 'RESONANCIA MAGNETICA'
    ],null, ['class' => 'form-control custom-select', 'placeholder' => 'Seleccione el servicio']) !!}
</div>

<!-- Permanent Overhead Field -->
<div class="form-group col-sm-6">
    {!! Form::label('permanent_overhead', 'Gastos Generales Fijos:') !!}
    {!! Form::number('permanent_overhead', null, ['class' => 'form-control', 'placeholder' => 'Digite los gastos generales fijos']) !!}
</div>

<!-- Variable Overhead Field -->
<div class="form-group col-sm-6">
    {!! Form::label('variable_overhead', 'Gastos generales variables:') !!}
    {!! Form::number('variable_overhead', null, ['class' => 'form-control', 'placeholder' => 'Digite los gastos generales variables']) !!}
</div>

<!-- Administrative Twolevel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('administrative_twoLevel', 'Gastos administrativos segundo nivel:') !!}
    {!! Form::number('administrative_twoLevel', null, ['class' => 'form-control', 'placeholder' => 'Digite los gastos administrativos segundo nivel']) !!}
</div>

<!-- Logistic Twolevel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('logistic_twoLevel', 'Gastos logisticos segundo nivel:') !!}
    {!! Form::number('logistic_twoLevel', null, ['class' => 'form-control', 'placeholder' => 'Digite los gastos logisticos segundo nivel']) !!}
</div>

<!-- Plant Labour Field -->
<div class="form-group col-sm-6">
    {!! Form::label('plant_labour', 'Mano de obra planta:') !!}
    {!! Form::number('plant_labour', null, ['class' => 'form-control', 'placeholder' => 'Digite el costo de la mano de obra planta']) !!}
</div>

<!-- Labour Field -->
<div class="form-group col-sm-6">
    {!! Form::label('supplies', 'Materiales:') !!}
    {!! Form::number('supplies', null, ['class' => 'form-control', 'placeholder' => 'Digite el costo de los materiales']) !!}
</div>

<!-- Employee Field -->
<div class="form-group col-sm-6">
    {!! Form::label('employee', 'Tecnico/Transcriptor:') !!}
    {!! Form::number('employee', null, ['class' => 'form-control', 'placeholder' => 'Digite el costo del tecnico/transcriptor']) !!}
</div>

<!-- Number Rooms Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number_rooms', 'Número de salas:') !!}
    {!! Form::number('number_rooms', null, ['class' => 'form-control', 'placeholder' => 'Digite el numero de salas']) !!}
</div>
