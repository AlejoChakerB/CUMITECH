<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripción:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Digite la descripción']) !!}
</div>

<!-- Cod Uf Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cod_uf', 'Código unidad funcional:') !!}
    {!! Form::number('cod_uf', null, ['class' => 'form-control', 'placeholder' => 'Digite el código de la unidad funcional']) !!}
</div>

<!-- Funcional Unit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('funcional_unit', 'Unidad funcional:') !!}
    {!! Form::text('funcional_unit', null, ['class' => 'form-control', 'placeholder' => 'Digite la unidad funcional']) !!}
</div>

<!-- Code Service Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code_service', 'Código de servicio:') !!}
    {!! Form::text('code_service', null, ['class' => 'form-control', 'placeholder' => 'Digite el código del servicio']) !!}
</div>

<!-- Description Service Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description_service', 'Descripción del servicio:') !!}
    {!! Form::text('description_service', null, ['class' => 'form-control', 'placeholder' => 'Digite la descripción del servicio']) !!}
</div>

<!-- Id Factu Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_factu', 'Id facturación:') !!}
    {!! Form::number('id_factu', null, ['class' => 'form-control', 'placeholder' => 'Digite el id de facturación']) !!}
</div>

<!-- Quanty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quanty', 'Cantidad:') !!}
    {!! Form::number('quanty', null, ['class' => 'form-control', 'placeholder' => 'Digite la cantidad']) !!}
</div>

<!-- Recorded Cost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('recorded_cost', 'Costo:') !!}
    {!! Form::number('recorded_cost', null, ['class' => 'form-control', 'placeholder' => 'Digite el costo']) !!}
</div>

<!-- Unit Cost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unit_cost', 'Costo unitario:') !!}
    {!! Form::number('unit_cost', null, ['class' => 'form-control', 'placeholder' => 'Digite el costo unitario (Costo x Cantidad)']) !!}
</div>
