<!-- Year Field -->
<div class="form-group col-sm-6">
    {!! Form::label('year', 'Año:') !!}
    {!! Form::text('year', null, ['class' => 'form-control','id'=>'year', 'placeholder' => 'Seleccione el año:']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#year').datetimepicker({
            format: 'YYYY',
            useCurrent: true,
            viewMode: 'years',
            icons: {
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'far fa-calendar-check',
                clear: 'far fa-trash-alt',
                close: 'far fa-times-circle'
            }
        })
    </script>
@endpush

<!-- Month Field -->
<div class="form-group col-sm-6">
    {!! Form::label('month', 'Mes:') !!}
    {!! Form::select('month', [
        'Enero' => 'Enero',
        'Febrero' => 'Febrero',
        'Marzo' => 'Marzo',
        'Abril' => 'Abril',
        'Mayo' => 'Mayo',
        'Junio' => 'Junio',
        'Julio' => 'Julio',
        'Agosto' => 'Agosto',
        'Septiembre' => 'Septiembre',
        'Octubre' => 'Octubre',
        'Noviembre' => 'Noviembre',
        'Diciembre' => 'Diciembre',
    ], null, ['class' => 'form-control custom-select','id'=>'month', 'placeholder'=>'Seleccione el año']) !!}
</div>

<!-- Service Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cost_center', 'Centro de costos:') !!}
    {!! Form::select('cost_center', [
        'URGENCIAS' => 'URGENCIAS',
        'UCI' => 'UCI',
        'UCIM' => 'UCIM',
        'HOSPITALIZACION' => 'HOSPITALIZACION'
    ], null, ['class' => 'form-control', 'placeholder' => 'Digite el servicio:']) !!}
</div>

<!-- Service Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service', 'Servicio:') !!}
    {!! Form::select('service', [
        'URGENCIAS' => 'URGENCIAS',
        'UCI PISO 5' => 'UCI PISO 5',
        'UCI PISO 6' => 'UCI PISO 6',
        'PISO 8 UCI INTERMEDIO' => 'PISO 8 UCI INTERMEDIO',
        'HOSPITALIZACION PISO 7' => 'HOSPITALIZACION PISO 7',
        'HOSPITALIZACION PISO 8' => 'HOSPITALIZACION PISO 8',
        'HOSPITALIZACION PISO 9' => 'HOSPITALIZACION PISO 9',
        'HOSPITALIZACION PISO 10' => 'HOSPITALIZACION PISO 10',
        'HOSPITALIZACION PISO 11' => 'HOSPITALIZACION PISO 11',
        'UCI INTERMEDIO PISO 2 - T2' => 'UCI INTERMEDIO PISO 2 - T2',
        'HOSPITALIZACION PISO 3 - T2' => 'HOSPITALIZACION PISO 3 - T2',
        'HOSPITALIZACION PISO 4 - T2' => 'HOSPITALIZACION PISO 4 - T2'

    ], null, ['class' => 'form-control', 'placeholder' => 'Digite el servicio:']) !!}
</div>

<!-- Bedrooms Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bedrooms', 'Habitaciones:') !!}
    {!! Form::number('bedrooms', null, ['class' => 'form-control', 'placeholder' => 'Digite la cantidad de habitaciones:']) !!}
</div>

<!-- Beds Field -->
<div class="form-group col-sm-6">
    {!! Form::label('beds', 'Camas:') !!}
    {!! Form::number('beds', null, ['class' => 'form-control', 'placeholder' => 'Digite el servicio:']) !!}
</div>

<!-- Days Produced Field -->
<div class="form-group col-sm-6">
    {!! Form::label('days_produced', 'Días producidos:') !!}
    {!! Form::number('days_produced', null, ['class' => 'form-control', 'placeholder' => 'Digite la cantidad de días']) !!}
</div>

<!-- Permanent Overhead Field -->
<div class="form-group col-sm-6">
    {!! Form::label('permanent_overhead', 'Gastos generales fijos:') !!}
    {!! Form::number('permanent_overhead', null, ['class' => 'form-control', 'placeholder' => 'Digite los gastos generales fijos:']) !!}
</div>

<!-- Variable Overhead Field -->
<div class="form-group col-sm-6">
    {!! Form::label('variable_overhead', 'Gastos generales variables:') !!}
    {!! Form::number('variable_overhead', null, ['class' => 'form-control', 'placeholder' => 'Digite los gastos generales variables:']) !!}
</div>

<!-- Administrative Twolevel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('administrative_twoLevel', 'Gastos administrativos segundo nivel:') !!}
    {!! Form::number('administrative_twoLevel', null, ['class' => 'form-control', 'placeholder' => 'Digite los gastos administrativos segundo nivel:']) !!}
</div>

<!-- Logistic Twolevel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('logistic_twoLevel', 'Gastos logísticos segundo nivel:') !!}
    {!! Form::number('logistic_twoLevel', null, ['class' => 'form-control', 'placeholder' => 'Digite los gastos logisticos segundo nivel:']) !!}
</div>

<!-- Plant Labour Field -->
<div class="form-group col-sm-6">
    {!! Form::label('plant_labour', 'Mano obra planta:') !!}
    {!! Form::number('plant_labour', null, ['class' => 'form-control', 'placeholder' => 'Digite la mano obra planta:']) !!}
</div>

<!-- Labour Field -->
<div class="form-group col-sm-6">
    {!! Form::label('labour', 'Mano obra (contratada):') !!}
    {!! Form::number('labour', null, ['class' => 'form-control', 'placeholder' => 'Digite la mano obra contratada:']) !!}
</div>