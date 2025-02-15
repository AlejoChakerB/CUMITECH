<!-- Item Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_quantity', 'Cantidad:') !!}
    {!! Form::number('item_quantity', null, ['class' => 'form-control', 'placeholder' => 'Digite la cantidad']) !!}
</div>

<!-- Reusable Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reusable', 'Reusable:') !!}
    {!! Form::select('reusable', ['0' => 'No', '1' => 'Si'], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Article Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_article', 'Articulo:') !!}
    <strong>
        {!! Form::select('id_article', $articles, null, ['class' => 'form-control custom-select', 'placeholder' => 'Seleccione un articulo' ,'id' => 'id_article']) !!}
    </strong>
</div>

<!-- Cod Surgical Act Field -->
<div class="form-group col-sm-6">
    {!! Form::label('surgical_act', 'Codigo acto quirurgico:') !!}
    {!! Form::select('surgical_act', $surgical_acts, null, ['class' => 'form-control custom-select', 'placeholder' => 'Seleccione un acto quirurgico']) !!}
</div>