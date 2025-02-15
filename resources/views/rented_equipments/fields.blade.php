<!-- Specialty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('specialty', 'Especialidad:') !!}
    {!! Form::text('specialty', null, ['class' => 'form-control', 'placeholder' => 'Digite la especialidad asociada']) !!}
</div>

<!-- Art Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('art_code', 'Codigo ART:') !!}
    {!! Form::text('art_code', null, ['class' => 'form-control', 'placeholder' => 'Digite el código ART']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripcion:') !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Digite la descripción']) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value', 'Valor:') !!}
    {!! Form::number('value', null, ['class' => 'form-control', 'placeholder' => 'Digite el valor del alquiler']) !!}
</div>

<!-- Procedure Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('procedure_id', 'Procedimiento:') !!}
    {!! Form::select('procedure_id', [], null, ['class' => 'form-control custom-select', 'id' => 'procedure_id']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#procedure_id').select2({
                placeholder: 'Seleccione un procedimiento',
                allowClear: true,
                width: '100%',
                theme: 'bootstrap4',
                ajax: {
                    url: '{{ route('cups.procedures') }}',
                    dataType: 'json',
                    delay: 250, // Retraso en milisegundos para evitar múltiples solicitudes
                    data: function(params) {
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