<!-- Service Field -->
<div class="col-sm-12">
    {!! Form::label('service', 'Service:') !!}
    <p>{{ $patology->service }}</p>
</div>

<!-- Cups Field -->
<div class="col-sm-12">
    {!! Form::label('cups', 'Cups:') !!}
    <p>{{ $patology->cups }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $patology->description }}</p>
</div>

<!-- Value Field -->
<div class="col-sm-12">
    {!! Form::label('value', 'Value:') !!}
    <p>{{ $patology->value }}</p>
</div>

<!-- Observation Field -->
<div class="col-sm-12">
    {!! Form::label('observation', 'Observation:') !!}
    <p>{{ $patology->observation }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $patology->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $patology->updated_at }}</p>
</div>

