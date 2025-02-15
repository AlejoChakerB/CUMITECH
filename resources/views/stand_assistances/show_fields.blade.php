<!-- Stand Field -->
<div class="col-sm-12">
    {!! Form::label('stand', 'Stand:') !!}
    <p>{{ $standAssistance->stand }}</p>
</div>

<!-- State Field -->
<div class="col-sm-12">
    {!! Form::label('state', 'State:') !!}
    <p>{{ $standAssistance->state }}</p>
</div>

<!-- Approved Date Field -->
<div class="col-sm-12">
    {!! Form::label('approved_date', 'Approved Date:') !!}
    <p>{{ $standAssistance->approved_date }}</p>
</div>

<!-- Id User Employees Field -->
<div class="col-sm-12">
    {!! Form::label('id_user_employees', 'Id User Employees:') !!}
    <p>{{ $standAssistance->id_user_employees }}</p>
</div>

<!-- Id Presenter Field -->
<div class="col-sm-12">
    {!! Form::label('id_presenter', 'Id Presenter:') !!}
    <p>{{ $standAssistance->id_presenter }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $standAssistance->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $standAssistance->updated_at }}</p>
</div>

