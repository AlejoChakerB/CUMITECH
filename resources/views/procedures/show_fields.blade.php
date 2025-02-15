<!-- Procedure Code Field -->
<div class="col-sm-12">
    {!! Form::label('procedure_code', 'Procedure Code:') !!}
    <p>{{ $procedures->procedure_code }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $procedures->description }}</p>
</div>

<!-- Cups Field -->
<div class="col-sm-12">
    {!! Form::label('cups', 'Cups:') !!}
    <p>{{ $procedures->cups }}</p>
</div>

<!-- Uvr Field -->
<div class="col-sm-12">
    {!! Form::label('uvr', 'Uvr:') !!}
    <p>{{ $procedures->uvr }}</p>
</div>

<!-- Procedure Value Field -->
<div class="col-sm-12">
    {!! Form::label('procedure_value', 'Procedure Value:') !!}
    <p>{{ $procedures->procedure_value }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $procedures->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $procedures->updated_at }}</p>
</div>

