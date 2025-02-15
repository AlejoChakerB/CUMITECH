<!-- Code Doctor Field -->
<div class="col-sm-12">
    {!! Form::label('code_doctor', 'Code Doctor:') !!}
    <p>{{ $doctorsChanges->code_doctor }}</p>
</div>

<!-- Old Field -->
<div class="col-sm-12">
    {!! Form::label('old', 'Old:') !!}
    <p>{{ $doctorsChanges->old }}</p>
</div>

<!-- New Field -->
<div class="col-sm-12">
    {!! Form::label('new', 'New:') !!}
    <p>{{ $doctorsChanges->new }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $doctorsChanges->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $doctorsChanges->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $doctorsChanges->updated_at }}</p>
</div>

