<!-- Honorary Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('honorary_code', 'Código honorario:') !!}
    {!! Form::number('honorary_code', null, ['class' => 'form-control', 'placeholder' => 'Digite el código identificador']) !!}
</div>

<!-- Payment Manual Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_manual', 'Manual de pago:') !!}
    {!! Form::text('payment_manual', null, ['class' => 'form-control', 'placeholder' => 'Digite el manual de pago']) !!}
</div>

<!-- Fees Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fees_type', 'Tipo:') !!}
    {!! Form::select('fees_type', [
        "256" => "256",
        "312" => "312",
        "SOAT" => "SOAT",
        "INST" => "INST",
    ] ,null, ['class' => 'form-control custom-select', 'placeholder' => 'Seleccione el tipo']) !!}
</div>