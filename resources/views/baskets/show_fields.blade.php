<!-- Item Quantity Field -->
<div class="col-sm-12">
    {!! Form::label('item_quantity', 'Item Quantity:') !!}
    <p>{{ $basket->item_quantity }}</p>
</div>

<!-- Reusable Field -->
<div class="col-sm-12">
    {!! Form::label('reusable', 'Reusable:') !!}
    <p>{{ $basket->reusable }}</p>
</div>

<!-- Basket Value Field -->
<div class="col-sm-12">
    {!! Form::label('basket_value', 'Basket Value:') !!}
    <p>{{ $basket->basket_value }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $basket->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $basket->updated_at }}</p>
</div>

