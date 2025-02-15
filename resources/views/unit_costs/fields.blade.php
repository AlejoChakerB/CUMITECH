<!-- Room Cost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('room_cost', 'Derecho de sala:') !!}
    {!! Form::number('room_cost', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => 'Digite el valor del derecho de sala']) !!}
</div>

<!-- Gas Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gas', 'Gas:') !!}
    {!! Form::number('gas', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => 'Digite el valor del gas']) !!}
</div>

<!-- Gas Field -->
<div class="form-group col-sm-6">
    {!! Form::label('consumables', 'Consumibles:') !!}
    {!! Form::number('consumables', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => 'Digite el valor de los consumibles']) !!}
</div>

<!-- Labour Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rented', 'Equipos rentados:') !!}
    {!! Form::number('rented', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor de los equipos rentados']) !!}
</div>

<!-- Basket Field -->
<div class="form-group col-sm-6">
    {!! Form::label('basket', 'Canasta:') !!}
    {!! Form::number('basket', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => 'Digite el valor de la canasta']) !!}
</div>

<!-- Medical Fees Field -->
<div class="form-group col-sm-6">
    {!! Form::label('medical_fees', 'Honorarios médico:') !!}
    {!! Form::number('medical_fees', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => 'Digite el valor de los honorarios médicos']) !!}
</div>

<!-- Medical Fees Field -->
<div class="form-group col-sm-6">
    {!! Form::label('medical_fees2', 'Honorarios médico 2:') !!}
    {!! Form::number('medical_fees2', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => 'Digite el valor de los honorarios del segundo médico']) !!}
</div>

<!-- Medical Fees Field -->
<div class="form-group col-sm-6">
    {!! Form::label('anest_fees', 'Honorarios anestesiologo:') !!}
    {!! Form::number('anest_fees', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => 'Digite el valor de los honorarios del anestesiologo']) !!}
</div>

<!-- Cod Surgical Act Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cod_surgical_act', 'Codigo acto quirurgico:') !!}
    {!! Form::select('cod_surgical_act', $surgical_acts, null, ['class' => 'form-control custom-select', 'placeholder' => 'Seleccione el acto quirurgico']) !!}
</div>