<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Código:') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Digite el código']) !!}
</div>

<!-- Dni Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dni', 'Dni:') !!}
    {!! Form::text('dni', null, ['class' => 'form-control', 'placeholder' => 'Digte la identificación']) !!}
</div>

<!-- Category Doctor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_doctor', 'Categoria:') !!}
    {!! Form::select('category_doctor', [
        'Medico Especialista' => 'Medico Especialista',
        'Medico General' => 'Medico General'
    ], null, ['class' => 'form-control custom-select text-secondary', 'placeholder' => 'Seleccione la categoria']) !!}
</div>

<!-- Full Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('full_name', 'Nombre:') !!}
    {!! Form::text('full_name', null, ['class' => 'form-control', 'placeholder' => 'Digite el nombre']) !!}
</div>

<!-- Specialty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('specialty', 'Especialidad:') !!}
    {!! Form::select('specialty', $especiality,  null, ['class' => 'form-control', 'placeholder' => '', 'id' => 'specialty']) !!}
</div>

<!-- Payment Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_type', 'Tipo pago:') !!}
    {!! Form::select('payment_type', [
        'evento' => 'evento',
        'nomina' => 'nomina'
    ], null, ['class' => 'form-control custom-select text-secondary', 'placeholder' => 'Seleccione un tipo de pago']) !!}
</div>

<!-- Id Fees Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_fees', 'Honorario médico:') !!}
    {!! Form::select('id_fees', $fees, null, ['class' => 'form-control custom-select', 'placeholder' => '', 'id' => 'honorary']) !!}
</div>

<!-- Payments -->
<div id="app">
    {!! Form::label('Item', 'Seleccione los tipos de pagos:') !!}
    <div class="form-group col-sm-6" style="border: 2px solid rgb(223, 220, 220); border-radius:13px;">
        <payment-component :selected-items='@json($selectedItems ?? [])'></payment-component>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>

@push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#specialty').select2({
                placeholder: 'Seleccione una especialidad',
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

        $(document).ready(function() {
            $('#honorary').select2({
                placeholder: 'Seleccione un honorario',
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