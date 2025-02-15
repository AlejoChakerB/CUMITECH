<!-- Id User Field -->
<div class="col-sm-12">
    {!! Form::label('id_user', 'Id User:') !!}
    <p>{{ $userEmployees->id_user }}</p>
</div>

<!-- Id Employees Field -->
<div class="col-sm-12">
    {!! Form::label('id_employees', 'Id Employees:') !!}
    <p>{{ $userEmployees->id_employees }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $userEmployees->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $userEmployees->updated_at }}</p>
</div>

