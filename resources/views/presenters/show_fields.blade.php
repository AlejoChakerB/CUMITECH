<!-- Stand Field -->
<div class="col-sm-12">
    {!! Form::label('stand', 'Stand:') !!}
    <p>{{ $presenter->stand }}</p>
</div>

<!-- Id Users Employees Field -->
<div class="col-sm-12">
    {!! Form::label('id_users_employees', 'Id Users Employees:') !!}
    <p>{{ $presenter->id_users_employees }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $presenter->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $presenter->updated_at }}</p>
</div>

