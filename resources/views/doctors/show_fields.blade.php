<!-- Dni Field -->
<div class="col-sm-12">
    {!! Form::label('dni', 'Dni:') !!}
    <p>{{ $doctors->dni }}</p>
</div>

<!-- Full Name Field -->
<div class="col-sm-12">
    {!! Form::label('full_name', 'Full Name:') !!}
    <p>{{ $doctors->full_name }}</p>
</div>

<!-- Specialty Field -->
<div class="col-sm-12">
    {!! Form::label('specialty', 'Specialty:') !!}
    <p>{{ $doctors->specialty }}</p>
</div>

<!-- Id Rates Field -->
<div class="col-sm-12">
    {!! Form::label('id_rates', 'Id Rates:') !!}
    <p>{{ $doctors->id_rates }}</p>
</div>

<!-- Id Fees Field -->
<div class="col-sm-12">
    {!! Form::label('id_fees', 'Id Fees:') !!}
    <p>{{ $doctors->id_fees }}</p>
</div>

<!-- Id Fees Field -->
<div class="col-sm-12">
    {!! Form::label('payment', 'Pagos:') !!}
    <p>{{ $doctors->payment }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $doctors->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $doctors->updated_at }}</p>
</div>

