<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $generalCosts->description }}</p>
</div>

<!-- Value Field -->
<div class="col-sm-12">
    {!! Form::label('value', 'Value:') !!}
    <p>{{ $generalCosts->value }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $generalCosts->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $generalCosts->updated_at }}</p>
</div>

