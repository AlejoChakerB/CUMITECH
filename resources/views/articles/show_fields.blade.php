<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $articles->type }}</p>
</div>

<!-- Item Code Field -->
<div class="col-sm-12">
    {!! Form::label('item_code', 'Item Code:') !!}
    <p>{{ $articles->item_code }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $articles->description }}</p>
</div>

<!-- Average Cost Field -->
<div class="col-sm-12">
    {!! Form::label('average_cost', 'Average Cost:') !!}
    <p>{{ $articles->average_cost }}</p>
</div>

<!-- Last Cost Field -->
<div class="col-sm-12">
    {!! Form::label('last_cost', 'Last Cost:') !!}
    <p>{{ $articles->last_cost }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $articles->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $articles->updated_at }}</p>
</div>

