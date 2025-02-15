<!-- Stand Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stand', 'Stand:') !!}
    {!! Form::text('stand', null, ['class' => 'form-control']) !!}
</div>

<!-- State Field -->
<div class="form-group col-sm-6">
    {!! Form::label('state', 'State:') !!}
    {!! Form::text('state', null, ['class' => 'form-control']) !!}
</div>

<!-- Approved Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('approved_date', 'Approved Date:') !!}
    {!! Form::text('approved_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Id User Employees Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_user_employees', 'Id User Employees:') !!}
    {!! Form::select('id_user_employees', ], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Id Presenter Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_presenter', 'Id Presenter:') !!}
    {!! Form::select('id_presenter', ], null, ['class' => 'form-control custom-select']) !!}
</div>
