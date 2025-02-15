<!-- Cups Field -->
<div class="col-sm-12">
    {!! Form::label('cups', 'Cups:') !!}
    <p>{{ $logAmbulanceCost->cups }}</p>
</div>

<!-- Old Field -->
<div class="col-sm-12">
    {!! Form::label('old', 'Old:') !!}
    <p>{{ $logAmbulanceCost->old }}</p>
</div>

<!-- New Field -->
<div class="col-sm-12">
    {!! Form::label('new', 'New:') !!}
    <p>{{ $logAmbulanceCost->new }}</p>
</div>

<!-- Observation Field -->
<div class="col-sm-12">
    {!! Form::label('observation', 'Observation:') !!}
    <p>{{ $logAmbulanceCost->observation }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $logAmbulanceCost->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $logAmbulanceCost->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $logAmbulanceCost->updated_at }}</p>
</div>

