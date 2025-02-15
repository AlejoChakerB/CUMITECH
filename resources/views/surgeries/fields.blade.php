<!-- Date surgery Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_surgery', 'Fecha:') !!}
    {!! Form::text('date_surgery', null, ['class' => 'form-control', 'id'=>'date_surgery']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_surgery').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Start Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_time', 'Hora inicio:') !!}
    {!! Form::time('start_time', null, ['class' => 'form-control','id'=>'start_time', 'step' => '1']) !!}
</div>

<!-- End Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_time', 'Hora final:') !!}
    {!! Form::time('end_time', null, ['class' => 'form-control','id'=>'end_time', 'step' => '1']) !!}
</div>

<!-- Surgery Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('surgeryTime', 'Duracion (Minutos):') !!}
    {!! Form::number('surgeryTime', null, ['class' => 'form-control','id'=>'end_time']) !!}
</div>

<!-- Operating Room Field -->
<div class="form-group col-sm-6">
    {!! Form::label('operating_room', 'Quirofano:') !!}
    {!! Form::select('operating_room', [
    'QUIROFANO 1' => 'QUIROFANO 1',
    'QUIROFANO 2' => 'QUIROFANO 2',
    'QUIROFANO 3' => 'QUIROFANO 3',
    'QUIROFANO 4' => 'QUIROFANO 4',
    'QUIROFANO 5' => 'QUIROFANO 5',
    'SALA DE ENDOSCOPIAS' => 'SALA DE ENDOSCOPIAS',
    'SALA DE PROCEDIMIENTOS IMAGENOLOGIA' => 'SALA DE PROCEDIMIENTOS IMAGENOLOGIA',
    'SALA PROCEDIMIENTOS URGENCIAS' => 'SALA PROCEDIMIENTOS URGENCIAS'

    ], null, ['class' => 'form-control custom-select',
    'placeholder' => 'Seleccione el quirofano']) !!}
</div>


<!-- Cod Surgical Act Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cod_surgical_act', 'Código acto quirurgico:') !!}
    {!! Form::text('cod_surgical_act', null, ['class' => 'form-control']) !!}
</div>

<!-- Study Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('study_number', 'Número de estúdio:') !!}
    {!! Form::number('study_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Patient Field -->
<div class="form-group col-sm-6">
    {!! Form::label('patient', 'Paciente:') !!}
    {!! Form::text('patient', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Doctor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_doctor', 'Médico:') !!}
    {!! Form::select('id_doctor', $doctors, null, ['class' => 'form-control custom-select', 'placeholder' => 'seleccione
    el médico']) !!}
</div>

<!-- Id Doctor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_doctor2', 'Médico 2:') !!}
    {!! Form::select('id_doctor2', $doctors2, null, ['class' => 'form-control custom-select', 'placeholder' =>
    'seleccione el médico']) !!}
</div>

<!-- Id Anesthesiologist Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_anesthesiologist', 'Anestesiologo:') !!}
    {!! Form::select('id_anesthesiologist', $anesthesiologists, null, ['class' => 'form-control custom-select',
    'placeholder' => 'Seleccione el anestesiologo']) !!}
</div>