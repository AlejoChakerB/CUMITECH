<!-- Code Doctor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code_doctor', 'Code Doctor:') !!}
    {!! Form::select('code_doctor', ], null, ['class' => 'form-control custom-select']) !!}
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

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', ], null, ['class' => 'form-control custom-select']) !!}
</div>
