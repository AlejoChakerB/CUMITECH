<!-- Honorary Code Field -->
<div class="col-sm-12">
    {!! Form::label('honorary_code', 'Honorary Code:') !!}
    <p>{{ $medicalFees->honorary_code }}</p>
</div>

<!-- Payment Manual Field -->
<div class="col-sm-12">
    {!! Form::label('payment_manual', 'Payment Manual:') !!}
    <p>{{ $medicalFees->payment_manual }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $medicalFees->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $medicalFees->updated_at }}</p>
</div>

