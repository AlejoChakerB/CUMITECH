<!-- Id Procedure Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_doctor', 'Médico:') !!}
    {!! Form::select('id_doctor', $doctors, null, ['class' => 'form-control custom-select', 'placeholder' => '','id' => 'doctor']) !!}
</div>

<!-- Id Procedure Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_procedure', 'Procedimiento:') !!}
    {!! Form::select('id_procedure', $proc ?? [], null, ['class' => 'form-control custom-select','id' => 'procedure']) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value1', 'Valor 1:') !!}
    {!! Form::number('value1', null, ['class' => 'form-control', 'placeholder' => 'Digite un valor']) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value2', 'Valor 2:') !!}
    {!! Form::number('value2', null, ['class' => 'form-control', 'placeholder' => 'Digite un valor']) !!}
</div>

<!-- Rate Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observation_rates', 'Observacion:') !!}
    {!! Form::textarea('observation_rates', null, ['class' => 'form-control', 'placeholder' => 'Digite una observacion', 'style' => 'height:40px']) !!}
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
            $('#doctor').select2({
                placeholder: 'Seleccione un médico',
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