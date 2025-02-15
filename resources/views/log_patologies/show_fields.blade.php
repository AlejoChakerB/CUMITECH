<!-- Cups Field -->
<div class="col-sm-12">
    {!! Form::label('cups', 'Cups:') !!}
    <p>{{ $logPatology->cups }}</p>
</div>

<!-- Old Field -->
<div class="col-sm-12">
    {!! Form::label('old', 'Old:') !!}
    <p>{{ $logPatology->old }}</p>
</div>

<!-- New Field -->
<div class="col-sm-12">
    {!! Form::label('new', 'New:') !!}
    <p>{{ $logPatology->new }}</p>
</div>

<!-- Observation Field -->
<div class="col-sm-12">
    {!! Form::label('observation', 'Observation:') !!}
    <p>{{ $logPatology->observation }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $logPatology->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $logPatology->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $logPatology->updated_at }}</p>
</div>

