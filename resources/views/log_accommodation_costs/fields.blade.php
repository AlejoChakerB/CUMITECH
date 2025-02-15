<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    {!! Form::number('id', null, ['class' => 'form-control']) !!}
</div>

<!-- Old Field -->
<div class="form-group col-sm-6">
    {!! Form::label('old', 'Old:') !!}
    {!! Form::text('old', null, ['class' => 'form-control']) !!}
</div>

<!-- New Field -->
<div class="form-group col-sm-6">
    {!! Form::label('new', 'New:') !!}
    {!! Form::text('new', null, ['class' => 'form-control']) !!}
</div>

<!-- Observation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observation', 'Observation:') !!}
    {!! Form::text('observation', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>