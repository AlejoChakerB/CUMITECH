<!-- Health Register Field -->
<div class="col-sm-12">
    {!! Form::label('health_register', 'Health Register:') !!}
    <p>{{ $invimaRegistration->health_register }}</p>
</div>

<!-- Validity Registration Field -->
<div class="col-sm-12">
    {!! Form::label('validity_registration', 'Validity Registration:') !!}
    <p>{{ $invimaRegistration->validity_registration }}</p>
</div>

<!-- Laboratory Manufacturer Field -->
<div class="col-sm-12">
    {!! Form::label('laboratory_manufacturer', 'Laboratory Manufacturer:') !!}
    <p>{{ $invimaRegistration->laboratory_manufacturer }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $invimaRegistration->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $invimaRegistration->updated_at }}</p>
</div>

