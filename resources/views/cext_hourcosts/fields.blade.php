<!-- Permanent Overhead Field -->
<div class="form-group col-sm-6">
    {!! Form::label('permanent_overhead', 'Gastos generales fijos:') !!}
    {!! Form::number('permanent_overhead', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor de los gastos generales fijos']) !!}
</div>

<!-- Variable Overhead Field -->
<div class="form-group col-sm-6">
    {!! Form::label('variable_overhead', 'Gastos generales variables:') !!}
    {!! Form::number('variable_overhead', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor de los gastos generales variables']) !!}
</div>

<!-- Administrative Twolevel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('administrative_twoLevel', 'Gastos administrativos segundo nivel:') !!}
    {!! Form::number('administrative_twoLevel', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor de los gastos administrativos']) !!}
</div>

<!-- Logistic Twolevel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('logistic_twoLevel', 'Gastos logísticos segundo nivel:') !!}
    {!! Form::number('logistic_twoLevel', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor de los gastos logisticos']) !!}
</div>

<!-- Plant Labour Field -->
<div class="form-group col-sm-6">
    {!! Form::label('plant_labour', 'Mano de obra planta:') !!}
    {!! Form::number('plant_labour', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor de la mano de obra planta']) !!}
</div>

<!-- Labour Field -->
<div class="form-group col-sm-6">
    {!! Form::label('labour', 'Mano de obra:') !!}
    {!! Form::number('labour', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor de la mano de obra']) !!}
</div>

<!-- Days Produced Field -->
<div class="form-group col-sm-6">
    {!! Form::label('days_produced', 'Días produccion mes:') !!}
    {!! Form::number('days_produced', null, ['class' => 'form-control', 'placeholder' => 'Digite la cantidad de días producidos mensual']) !!}
</div>

<!-- Hours Producedxday Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hours_producedxday', 'Horas producidas x día:') !!}
    {!! Form::number('hours_producedxday', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => 'Digite las horas producidas x día']) !!}
</div>

<!-- Hours Producedxmonth Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hours_producedxmonth', 'Horas producidas mes:') !!}
    {!! Form::number('hours_producedxmonth', null, ['class' => 'form-control', 'placeholder' => 'Digite las horas producidas mes']) !!}
</div>

<!-- Hours Producedxmonth Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number_room', 'Cantidad de habitaciones:') !!}
    {!! Form::number('number_room', null, ['class' => 'form-control', 'placeholder' => 'Digite la cantidad de habitaciones']) !!}
</div>