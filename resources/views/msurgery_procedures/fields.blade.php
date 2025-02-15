<!-- cod surgical act Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cod_surgical_act', 'N Servicio:') !!}
    {!! Form::select('cod_surgical_act', $surgeries ?? [], null, [
        'class' => 'form-control custom-select',
        'id' => 'surgery',
        'placeholder' => '',
    ]) !!}
</div>

<!-- code procedure Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code_procedure', 'Procedimiento:') !!}
    {!! Form::select('code_procedure', $proc ?? [], null, [
        'class' => 'form-control custom-select',
        'id' => 'procedure',
    ]) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Via:') !!}
    {!! Form::text('type', null, [
        'class' => 'form-control',
        'placeholder' => 'Digite si la via es unilateral o multiple',
    ]) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Cantidad:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control', 'placeholder' => 'Digite la cantidad']) !!}
</div>

<!-- observation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observation', 'Observacion:') !!}
    {!! Form::textarea('observation', null, [
        'class' => 'form-control custom-textArea',
        'placeholder' => 'Digite la observacion',
    ]) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#procedure').select2({
                placeholder: 'Seleccione el procedimiento',
                allowClear: true,
                width: '100%',
                theme: 'bootstrap4',
                ajax: {
                    url: '{{ route('search.procedures') }}',
                    dataType: 'json',
                    delay: 250, // Retraso en milisegundos para evitar múltiples solicitudes
                    data: function(params) {
                        console.log(params);
                        return {
                            q: params.term, // Término de búsqueda
                            page: params.page // Página solicitada
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.results, // Resultados de búsqueda
                            pagination: {
                                more: (params.page * 30) < data.total_count // Más páginas por cargar
                            }
                        };
                    },
                    cache: true
                },
                templateSelection: function(data) {
                    console.log(data);
                    return data.text;
                },
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
            $('#surgery').select2({
                placeholder: 'Seleccione un número de servicio',
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

<style>
    .custom-textArea
    {
        resize: none;
        field-sizing: content;
    }
</style>