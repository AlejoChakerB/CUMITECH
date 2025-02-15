<!-- Item Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_code', 'Codigo:') !!}
    {!! Form::text('item_code', null, ['class' => 'form-control', 'placeholder' => 'Digite el código']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripcion:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Digite la descripcion']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Tipo:') !!}
    {!! Form::select('type', $type, null, ['class' => 'form-control', 'placeholder' => '','id' => 'type_id']) !!}
</div>

<!-- Average Cost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('average_cost', 'Costo promedio:') !!}
    {!! Form::number('average_cost', null, ['class' => 'form-control', 'placeholder' => 'Digite el costo promedio']) !!}
</div>

<!-- Last Cost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_cost', 'Ultimo costo:') !!}
    {!! Form::number('last_cost', null, ['class' => 'form-control', 'placeholder' => 'Digite el costo actual']) !!}
</div>

<!-- Usage Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usage_quantity', 'Cantidad reutilizable:') !!}
    {!! Form::number('usage_quantity', null, ['class' => 'form-control', 'placeholder' => 'Digite la cantidad que se reutiliza']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observation', 'Observacion:') !!}
    {!! Form::text('observation', null, ['class' => 'form-control', 'placeholder' => 'Digite la observacion']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#type_id').select2({
                placeholder: 'Seleccione el tipo de articulo',
                allowClear: true,
                width: '100%',
                theme: 'bootstrap4',
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    },
                    searching: function() {
                        return "Buscando...";
                    },
                }
            });
        });
    </script>
@endpush