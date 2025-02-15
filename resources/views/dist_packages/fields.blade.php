<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripción:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Digite descripción']) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value', 'Valor:') !!}
    {!! Form::number('value', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor']) !!}
</div>

<!-- Cod Package Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cod_package', 'Código de paquete:') !!}
    {!! Form::number('cod_package', null, ['class' => 'form-control', 'placeholder' => 'Digite el código del paquete']) !!}
</div>

<!-- Code Procedure Field -->
<div class="form-group col-sm-6">
    {!! Form::label('study', 'Estudio:') !!}
    {!! Form::number('study', null, ['class' => 'form-control', 'placeholder' => 'Digite el número de estudio']) !!}
</div>

<!-- Cod Procedure Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cod_surgical_act', 'N° Servicio:') !!}
    {!! Form::text('cod_surgical_act', null, ['class' => 'form-control', 'placeholder' => 'Digite el código de acto quirurgico']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('id_factu', 'ID Facturación:') !!}
    {!! Form::text('id_factu', null, ['class' => 'form-control', 'placeholder' => 'Digite el id de facturación']) !!}
</div>