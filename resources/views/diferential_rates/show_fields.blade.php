<!-- Rate Code Field -->
<div class="col-sm-12">
    {!! Form::label('rate_code', 'Rate Code:') !!}
    <p>{{ $diferentialRates->rate_code }}</p>
</div>

<!-- Rate Description Field -->
<div class="col-sm-12">
    {!! Form::label('rate_description', 'Rate Description:') !!}
    <p>{{ $diferentialRates->rate_description }}</p>
</div>

<!-- Value Field -->
<div class="col-sm-12">
    {!! Form::label('value', 'Value:') !!}
    <p>{{ $diferentialRates->value }}</p>
</div>

<!-- Id Procedure Field -->
<div class="col-sm-12">
    {!! Form::label('id_procedure', 'Id Procedure:') !!}
    <p>{{ $diferentialRates->id_procedure }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $diferentialRates->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $diferentialRates->updated_at }}</p>
</div>

