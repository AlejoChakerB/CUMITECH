<!-- Start Time Field -->
<div class="col-sm-12">
    {!! Form::label('start_time', 'Start Time:') !!}
    <p>{{ $surgery->start_time }}</p>
</div>

<!-- End Time Field -->
<div class="col-sm-12">
    {!! Form::label('end_time', 'End Time:') !!}
    <p>{{ $surgery->end_time }}</p>
</div>

<!-- Operating Room Field -->
<div class="col-sm-12">
    {!! Form::label('operating_room', 'Operating Room:') !!}
    <p>{{ $surgery->operating_room }}</p>
</div>

<!-- Cod Surgical Act Field -->
<div class="col-sm-12">
    {!! Form::label('cod_surgical_act', 'Cod Surgical Act:') !!}
    <p>{{ $surgery->cod_surgical_act }}</p>
</div>

<!-- Study Number Field -->
<div class="col-sm-12">
    {!! Form::label('study_number', 'Study Number:') !!}
    <p>{{ $surgery->study_number }}</p>
</div>

<!-- Patient Field -->
<div class="col-sm-12">
    {!! Form::label('patient', 'Patient:') !!}
    <p>{{ $surgery->patient }}</p>
</div>

<!-- Name Patient Field -->
<div class="col-sm-12">
    {!! Form::label('name_patient', 'Name Patient:') !!}
    <p>{{ $surgery->name_patient }}</p>
</div>

<!-- Id Doctor Field -->
<div class="col-sm-12">
    {!! Form::label('id_doctor', 'Id Doctor:') !!}
    <p>{{ $surgery->id_doctor }}</p>
</div>

<!-- Id Assistant Doctor Field -->
<div class="col-sm-12">
    {!! Form::label('id_assistant_doctor', 'Id Assistant Doctor:') !!}
    <p>{{ $surgery->id_assistant_doctor }}</p>
</div>

<!-- Id Anesthesiologist Field -->
<div class="col-sm-12">
    {!! Form::label('id_anesthesiologist', 'Id Anesthesiologist:') !!}
    <p>{{ $surgery->id_anesthesiologist }}</p>
</div>

<!-- Id Labours Field -->
<div class="col-sm-12">
    {!! Form::label('id_labours', 'Id Labours:') !!}
    <p>{{ $surgery->id_labours }}</p>
</div>

<!-- Id Procedures Field -->
<div class="col-sm-12">
    {!! Form::label('id_procedures', 'Id Procedures:') !!}
    <p>{{ $surgery->id_procedures }}</p>
</div>

<!-- Id Baskets Field -->
<div class="col-sm-12">
    {!! Form::label('id_baskets', 'Id Baskets:') !!}
    <p>{{ $surgery->id_baskets }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $surgery->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $surgery->updated_at }}</p>
</div>

