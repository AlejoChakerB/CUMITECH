<!-- code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Código:') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Digite el código']) !!}
</div>

<!-- manual_type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('manual_type', 'Tipo de manual:') !!}
    {!! Form::select('manual_type', [
        "256" => "ISS",
        "312" => "ISS 312",
        "SOAT" => "SOAT",
        "ins" => "INSTITUCIONAL",
        "INF" => "INFORMATIVO"
    ] ,null, ['class' => 'form-control custom-select', 'placeholder' => 'Seleccione un tipo de manual']) !!}
</div>

<!-- Cups Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cups', 'Cups:') !!}
    {!! Form::text('cups', null, ['class' => 'form-control', 'placeholder' => 'Digite el CUPS']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripcion:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Digite la descripcion']) !!}
</div>

<!-- Uvr Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Categoria:') !!}
    {!! Form::text('category', null, ['class' => 'form-control', 'placeholder' => 'Digite la categoria']) !!}
</div>

<!-- Uvr Field -->
<div class="form-group col-sm-6">
    {!! Form::label('uvr', 'UVR:') !!}
    {!! Form::number('uvr', null, ['class' => 'form-control', 'placeholder' => 'Digite la cantidad de UVR']) !!}
</div>

<!-- Uvr Field -->
<div class="form-group col-sm-6">
    {!! Form::label('uvt', 'UVT:') !!}
    {!! Form::number('uvt', null, ['class' => 'form-control', 'placeholder' => 'Digite la cantidad de UVT']) !!}
</div>

<!-- Procedure Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('procedure_value', 'Valor:') !!}
    {!! Form::number('procedure_value', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor']) !!}
</div>