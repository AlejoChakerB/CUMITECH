<!-- Position Field -->
<div class="form-group col-sm-6">
    {!! Form::label('position', 'Cargo:') !!}
    {!! Form::select('position', [
        'INSTRUMENTADOR QUIRURGICO' => 'INSTRUMENTADOR QUIRURGICO',
        'AUXILIAR DE ENFERMERIA' => 'AUXILIAR DE ENFERMERIA',
        'MÉDICO AYUDANTE' => 'MÉDICO AYUDANTE'
        ], null, ['class' => 'form-control custom-select', 'placeholder' => 'Seleccione el cargo']) !!}
</div>


<!-- Salary Field -->
<div class="form-group col-sm-6">
    {!! Form::label('salary', 'Salario:') !!}
    {!! Form::number('salary', null, ['class' => 'form-control']) !!}
</div>

<!-- Labor Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('labor_value', 'Valor por minuto:') !!}
    {!! Form::number('labor_value', null, ['class' => 'form-control']) !!}
</div>