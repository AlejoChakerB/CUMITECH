<!-- Percentage Uvr Field -->
<div class="form-group col-sm-6">
    {!! Form::label('percentage_parti', '% Participación:') !!}
    {!! Form::number('percentage_parti', null, ['class' => 'form-control', 'placeholder' => 'Digite el % de participación']) !!}
</div>

<!-- Time Procedure Field -->
<div class="form-group col-sm-6">
    {!! Form::label('time_procedure', 'Duración del procedimiento:') !!}
    {!! Form::text('time_procedure', null, ['class' => 'form-control', 'placeholder' => 'Digite la duracion del procedimiento']) !!}
</div>

<!-- Doctor Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('doctor_percentage', '%Liquidacion médico:') !!}
    {!! Form::number('doctor_percentage', null, ['class' => 'form-control', 'placeholder' => 'Digite el % de liquidación del médico']) !!}
</div>

<!-- Doctor Fees Field -->
<div class="form-group col-sm-6">
    {!! Form::label('doctor_fees', 'Honorarios médicos:') !!}
    {!! Form::number('doctor_fees', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => 'Digite los honorarios médicos']) !!}
</div>

<!-- Doctor Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('doctor2_percentage', '%Liquidacion médico 2:') !!}
    {!! Form::number('doctor2_percentage', null, ['class' => 'form-control', 'placeholder' => 'Digite % de liquidación del segundo médico']) !!}
</div>

<!-- Doctor Fees Field -->
<div class="form-group col-sm-6">
    {!! Form::label('doctor2_fees', 'Honorarios médico 2:') !!}
    {!! Form::number('doctor2_fees', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => 'Digite los honorarios del segundo médico']) !!}
</div>

<!-- Anest Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('anest_percentage', '%Liquidacion anestesiologo:') !!}
    {!! Form::number('anest_percentage', null, ['class' => 'form-control', 'placeholder' => 'Digite el % de liquidación del anestesiologo']) !!}
</div>

<!-- Anest Fees Field -->
<div class="form-group col-sm-6">
    {!! Form::label('anest_fees', 'Honorarios anestesiologo:') !!}
    {!! Form::number('anest_fees', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => 'Digite los honorarios del médico']) !!}
</div>

<!-- Valie Liquidated Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value_liquidated', 'Valor liquidado:') !!}
    {!! Form::number('value_liquidated', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor liquidado']) !!}
</div>

<!-- Total Uvr Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_liquidated', 'Total liquidado:') !!}
    {!! Form::number('total_liquidated', null, ['class' => 'form-control', 'placeholder' => 'Digite el total liquidado']) !!}
</div>

<!-- Room Cost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('room_cost', 'Derecho de sala:') !!}
    {!! Form::number('room_cost', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => 'Digite el valor del derecho de sala']) !!}
</div>

<!-- Gases Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gases', 'Gases:') !!}
    {!! Form::number('gases', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => 'Digite el valor del gas']) !!}
</div>

<!-- Time Procedure Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Categoria:') !!}
    {!! Form::text('category', null, ['class' => 'form-control', 'placeholder' => 'Digite la categoria']) !!}
</div>

<!-- Time Procedure Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_fact', 'Id facturado:') !!}
    {!! Form::number('id_fact', null, ['class' => 'form-control', 'placeholder' => 'Digite el id de facturación']) !!}
</div>

<!-- Time Procedure Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cod_package', 'Código paquete:') !!}
    {!! Form::number('cod_package', null, ['class' => 'form-control', 'placeholder' => 'Digite el código del paquete']) !!}
</div>

<!-- Time Procedure Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dist_package', 'Valor del paquete:') !!}
    {!! Form::number('dist_package', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor del paquete']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('cod_surgical_act', 'Código del acto quirurgico:') !!}
    {!! Form::select('cod_surgical_act', $surgical_acts, null, ['class' => 'form-control custom-select', 'placeholder' => 'Seleccione el código del acto quirurgico']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('code_procedure', 'Código del procedimiento:') !!}
    {!! Form::select('code_procedure', $procedures, null, ['class' => 'form-control custom-select', 'placeholder' => 'Seleccione el código del procedimiento']) !!}
</div>