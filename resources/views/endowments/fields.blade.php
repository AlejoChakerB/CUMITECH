<div class="form-group row">
    <!-- Contract id Field -->
    <div class="form-group col-sm-5">
        {!! Form::label('contract_id', 'Empleado:') !!}
        <strong>
            {!! Form::select('contract_id', $contracts, null, ['class' => 'form-control
            custom-select', 'placeholder' => 'Seleccione un empleado', 'id' => 'contract_id']) !!}
        </strong>
    </div>
    <!-- Deliver Date Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('deliver_date', 'Fecha entrega:') !!}
        {!! Form::text('deliver_date', $today, ['class' => 'form-control','id'=>'deliver_date']) !!}
    </div>
    <!-- Period -->
    <div class="form-group col-sm-3">
        {!! Form::label('Period', 'Periodo:') !!}
        {!! Form::select('period', [
        'Abril' => 'Abril',
        'Agosto' => 'Agosto',
        'Diciembre' => 'Diciembre'
        ], null, ['class' => 'form-control
        custom-select', 'placeholder' => 'Seleccione un periodo']) !!}
    </div>
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#deliver_date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })

        $(document).ready(function() {
            $('#contract_id').select2({
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

<!-- Item Field -->
<div id="app">
        <div class="form-group col-sm-3">
            {!! Form::label('Item', 'Item:') !!}
            <input-component :selected-items='@json($selectedItems ?? [])'></input-component>
        </div>
        
    <div class="form-group col-sm-7">
        <template>
            {!! Form::label('signature', 'Firma del empleado:') !!}
            <signature-pad :initial-signature='@json($signature ?? null)' ref="signaturePad"></signature-pad>
        </template>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>