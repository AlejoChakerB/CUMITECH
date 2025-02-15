
@push('page_scripts')
    <script type="text/javascript">
        $('#workday').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Entry time Field -->
<div class="form-group col-sm-5">
    {!! Form::label('aentry_time', 'Hora de entrada:') !!}
    {!! Form::time('aentry_time', null, ['class' => 'form-control', 'step' => '1']) !!}
</div>

<!-- Departure time Field -->
<div class="form-group col-sm-5">
    {!! Form::label('adeparture_time', 'Hora de salida:') !!}
    {!! Form::time('adeparture_time', null, ['class' => 'form-control', 'step' => '1']) !!}
</div>
<!-- Id Employe Field -->
<div class="form-group col-sm-5">
    {!! Form::label('employe_id', 'Empleado:') !!}
    {!! Form::select('employe_id', $employes, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Workday Field -->
<div class="form-group col-sm-5">
    {!! Form::label('workday', 'Fecha:') !!}
    {!! Form::text('workday', date('Y-m-d'), ['class' => 'form-control','id'=>'workday']) !!}
</div>