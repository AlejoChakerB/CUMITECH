<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Código:') !!}
    {!! Form::number('code', null, ['class' => 'form-control', 'placeholder' => 'Digite el código identificador']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('service', 'Servicio:') !!}
    {!! Form::text('service', null, ['class' => 'form-control', 'placeholder' => 'Digite el servicio']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripcion:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Digite una descripción']) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value', 'Valor:') !!}
    {!! Form::number('value', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor']) !!}
</div>