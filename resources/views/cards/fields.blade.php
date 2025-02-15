<div class="form-group row">
    <!-- Employe Id Field -->
    <div class="form-group col-sm-5">
        {!! Form::label('employe_id', 'Empleado:') !!}
        <strong>
            {!! Form::select('employe_id', $employes, null, ['class' => 'form-control custom-select', 'placeholder' =>
            'Seleccione un empleado', 'id' => 'employe_id']) !!}
        </strong>
    </div>

    <!-- Delivery Date Card Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('delivery_date_card', 'Fecha entrega:') !!}
        {!! Form::text('delivery_date_card', $today, ['class' => 'form-control','id'=>'delivery_date_card']) !!}
    </div>
</div>

@push('page_scripts')
<script type="text/javascript">
    $('#delivery_date_card').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        });
    
        $(document).ready(function() {
            $('#employe_id').select2({
                placeholder: 'Seleccione un empleado',
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

<!-- Card Item Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('card_item', 'Tarjeta', ['class' => 'form-control']) !!}
</div>

<div id="app">
    <div class="form-group col-sm-7">
        <template>
            {!! Form::label('signature', 'Firma del empleado:') !!}
            <signature-pad :initial-signature='@json($signature ?? null)' ref="signaturePad"></signature-pad>
        </template>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>