<!-- Art Code Field -->
<div class="col-sm-12">
    {!! Form::label('art_code', 'Art Code:') !!}
    <p>{{ $rentedEquipment->art_code }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $rentedEquipment->description }}</p>
</div>

<!-- Value Field -->
<div class="col-sm-12">
    {!! Form::label('value', 'Value:') !!}
    <p>{{ $rentedEquipment->value }}</p>
</div>

<!-- Specialty Field -->
<div class="col-sm-12">
    {!! Form::label('specialty', 'Specialty:') !!}
    <p>{{ $rentedEquipment->specialty }}</p>
</div>

<!-- Procedure Id Field -->
<div class="col-sm-12">
    {!! Form::label('procedure_id', 'Procedure Id:') !!}
    <p>{{ $rentedEquipment->procedure_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $rentedEquipment->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $rentedEquipment->updated_at }}</p>
</div>

