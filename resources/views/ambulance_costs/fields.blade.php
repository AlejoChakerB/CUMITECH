<!-- Cups Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cups', 'Cups:') !!}
    {!! Form::text('cups', null, ['class' => 'form-control', 'placeholder' => 'Digite el cups']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Digite el nombre del procedimiento']) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value', 'Valor:') !!}
    {!! Form::number('value', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor']) !!}
</div>

<!-- Recharge Field -->
<div class="form-group col-sm-6">
    {!! Form::label('recharge', 'Recargo:') !!}
    {!! Form::number('recharge', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor del recargo']) !!}
</div>