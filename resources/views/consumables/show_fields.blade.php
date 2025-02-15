<!-- Consumable Quantity Field -->
<div class="col-sm-12">
    {!! Form::label('consumable_quantity', 'Consumable Quantity:') !!}
    <p>{{ $consumable->consumable_quantity }}</p>
</div>

<!-- Surgery Type Field -->
<div class="col-sm-12">
    {!! Form::label('surgery_type', 'Surgery Type:') !!}
    <p>{{ $consumable->surgery_type }}</p>
</div>

<!-- Id Article Field -->
<div class="col-sm-12">
    {!! Form::label('id_article', 'Id Article:') !!}
    <p>{{ $consumable->id_article }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $consumable->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $consumable->updated_at }}</p>
</div>

