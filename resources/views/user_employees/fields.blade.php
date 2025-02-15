<!-- Id User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_user', 'Usuario:') !!}
    {!! Form::select('id_user', $users, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Id Employees Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_employees', 'Empleado:') !!}
    {!! Form::select('id_employees', $employees, null, ['class' => 'form-control custom-select']) !!}
</div>
