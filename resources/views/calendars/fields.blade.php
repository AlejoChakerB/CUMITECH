<!-- start date Field -->
<div class="form-group col-sm-5">
    {!! Form::label('start_date', 'Fecha de inicio:') !!}
    {!! Form::text('start_date', null, ['class' => 'form-control','id'=>'start_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- end date Field -->
<div class="form-group col-sm-5">
    {!! Form::label('end_date', 'Fecha de fin:') !!}
    {!! Form::text('end_date', null, ['class' => 'form-control','id'=>'end_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Entry time Field -->
<div class="form-group col-sm-5">
    {!! Form::label('entry_time', 'Hora de entrada:') !!}
    {!! Form::time('entry_time', null, ['class' => 'form-control', 'step' => '1']) !!}
</div>

<!-- Departure time Field -->
<div class="form-group col-sm-5">
    {!! Form::label('departure_time', 'Hora de salida:') !!}
    {!! Form::time('departure_time', null, ['class' => 'form-control', 'step' => '1']) !!}
</div>

<!-- Floor Field -->
<div class="form-group col-sm-5">
    {!! Form::label('floor', 'Piso:') !!}
    {!! Form::select('floor', 
        [
            'Piso 1' => 'Piso 1', 
            'Piso 2' => 'Piso 2', 
            'Piso 3' => 'Piso 3',
            'Piso 4' => 'Piso 4',
            'Piso 5' => 'Piso 5',
            'Piso 6' => 'Piso 6',
            'Piso 7' => 'Piso 7',
            'Piso 8' => 'Piso 8',
            'Piso 9' => 'Piso 9',
            'Piso 10' => 'Piso 10',
            'Piso 11' => 'Piso 11'
        ], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Id Employe Field -->
<div class="form-group col-sm-5">
    {!! Form::label('employe_id', 'Nombre del empleado:') !!}
    {!! Form::select('employe_id', $employes, null, ['class' => 'form-control custom-select']) !!}
</div>
