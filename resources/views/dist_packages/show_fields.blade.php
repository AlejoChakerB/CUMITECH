<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $distPackage->description }}</p>
</div>

<!-- Value Field -->
<div class="col-sm-12">
    {!! Form::label('value', 'Value:') !!}
    <p>{{ $distPackage->value }}</p>
</div>

<!-- Cod Package Field -->
<div class="col-sm-12">
    {!! Form::label('cod_package', 'Cod Package:') !!}
    <p>{{ $distPackage->cod_package }}</p>
</div>

<!-- Code Procedure Field -->
<div class="col-sm-12">
    {!! Form::label('code_procedure', 'Code Procedure:') !!}
    <p>{{ $distPackage->code_procedure }}</p>
</div>

<!-- Cod Procedure Field -->
<div class="col-sm-12">
    {!! Form::label('cod_procedure', 'Cod Procedure:') !!}
    <p>{{ $distPackage->cod_procedure }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $distPackage->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $distPackage->updated_at }}</p>
</div>

