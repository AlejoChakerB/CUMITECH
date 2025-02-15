<!-- Cups Field -->
<div class="col-sm-12">
    {!! Form::label('CUPS', 'Cups:') !!}
    <p>{{ $ambulanceCost->CUPS }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $ambulanceCost->name }}</p>
</div>

<!-- Value Field -->
<div class="col-sm-12">
    {!! Form::label('value', 'Value:') !!}
    <p>{{ $ambulanceCost->value }}</p>
</div>

<!-- Recharge Field -->
<div class="col-sm-12">
    {!! Form::label('recharge', 'Recharge:') !!}
    <p>{{ $ambulanceCost->recharge }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $ambulanceCost->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $ambulanceCost->updated_at }}</p>
</div>

