<!-- Service Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service', 'Service:') !!}
    {!! Form::text('service', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Category:') !!}
    {!! Form::text('category', null, ['class' => 'form-control']) !!}
</div>

<!-- Sub Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sub_category', 'Sub Category:') !!}
    {!! Form::text('sub_category', null, ['class' => 'form-control']) !!}
</div>

<!-- Cups Field -->
<div class="form-group col-sm-6" id="items-field2">
    {!! Form::label('cups', 'Cups:') !!}
    {!! Form::text('cups', null, ['class' => 'form-control custom-select', 'id' => 'procedures']) !!}
</div>

<!-- Item Field -->
<div id="app">
    <div class="form-group col-sm-7">
        <template>
            {!! Form::label('items', 'Items:') !!}
            <cupsxitem-component :edit='@json($imagingProductionCupsxitems ?? null)'></cupsxitem-component>
        </template>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>