<!-- Cups Field -->
<div class="col-sm-12">
    {!! Form::label('cups', 'Cups:') !!}
    <p>{{ $logBloodBank->cups }}</p>
</div>

<!-- Old Field -->
<div class="col-sm-12">
    {!! Form::label('old', 'Old:') !!}
    <p>{{ $logBloodBank->old }}</p>
</div>

<!-- New Field -->
<div class="col-sm-12">
    {!! Form::label('new', 'New:') !!}
    <p>{{ $logBloodBank->new }}</p>
</div>

<!-- Observation Field -->
<div class="col-sm-12">
    {!! Form::label('observation', 'Observation:') !!}
    <p>{{ $logBloodBank->observation }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $logBloodBank->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $logBloodBank->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $logBloodBank->updated_at }}</p>
</div>

