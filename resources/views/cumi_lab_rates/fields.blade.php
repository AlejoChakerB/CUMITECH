<!-- Id Procedure Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cups', 'Procedimiento:') !!}
    {!! Form::select('cups', $proc ?? [], null, ['class' => 'form-control custom-select','id' => 'procedure']) !!}
</div>

<!-- Period Field -->
<div class="form-group col-sm-6">
    {!! Form::label('period', 'Periodo:') !!}
    {!! Form::text('period', null, ['class' => 'form-control','id'=>'period']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#period').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- January Field -->
<div class="form-group col-sm-6">
    {!! Form::label('january', 'Enero:') !!}
    {!! Form::number('january', null, ['class' => 'form-control']) !!}
</div>

<!-- February Field -->
<div class="form-group col-sm-6">
    {!! Form::label('february', 'Febrero:') !!}
    {!! Form::number('february', null, ['class' => 'form-control']) !!}
</div>

<!-- March Field -->
<div class="form-group col-sm-6">
    {!! Form::label('march', 'Marzo:') !!}
    {!! Form::number('march', null, ['class' => 'form-control']) !!}
</div>

<!-- April Field -->
<div class="form-group col-sm-6">
    {!! Form::label('april', 'Abril:') !!}
    {!! Form::number('april', null, ['class' => 'form-control']) !!}
</div>

<!-- April Field -->
<div class="form-group col-sm-6">
    {!! Form::label('may', 'Mayo:') !!}
    {!! Form::number('may', null, ['class' => 'form-control']) !!}
</div>

<!-- June Field -->
<div class="form-group col-sm-6">
    {!! Form::label('june', 'Junio:') !!}
    {!! Form::number('june', null, ['class' => 'form-control']) !!}
</div>

<!-- July Field -->
<div class="form-group col-sm-6">
    {!! Form::label('july', 'Julio:') !!}
    {!! Form::number('july', null, ['class' => 'form-control']) !!}
</div>

<!-- August Field -->
<div class="form-group col-sm-6">
    {!! Form::label('august', 'Agosto:') !!}
    {!! Form::number('august', null, ['class' => 'form-control']) !!}
</div>

<!-- October Field -->
<div class="form-group col-sm-6">
    {!! Form::label('september', 'Septiembre:') !!}
    {!! Form::number('september', null, ['class' => 'form-control']) !!}
</div>

<!-- October Field -->
<div class="form-group col-sm-6">
    {!! Form::label('october', 'Octubre:') !!}
    {!! Form::number('october', null, ['class' => 'form-control']) !!}
</div>

<!-- November Field -->
<div class="form-group col-sm-6">
    {!! Form::label('november', 'Noviembre:') !!}
    {!! Form::number('november', null, ['class' => 'form-control']) !!}
</div>

<!-- December Field -->
<div class="form-group col-sm-6">
    {!! Form::label('december', 'Diciembre:') !!}
    {!! Form::number('december', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Months Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_months', 'Total mes:') !!}
    {!! Form::number('total_months', null, ['class' => 'form-control']) !!}
</div>

<!-- Average Months Field -->
<div class="form-group col-sm-6">
    {!! Form::label('average_months', 'Promedio mes:') !!}
    {!! Form::number('average_months', null, ['class' => 'form-control']) !!}
</div>

<!-- Cumilab Rate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cumilab_rate', 'Tarifa Cumilab:') !!}
    {!! Form::number('cumilab_rate', null, ['class' => 'form-control']) !!}
</div>

<!-- Mutual Rate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mutual_rate', 'Tarifa Mutual:') !!}
    {!! Form::number('mutual_rate', null, ['class' => 'form-control']) !!}
</div>

<!-- Pxq Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pxq', 'PXQ:') !!}
    {!! Form::number('pxq', null, ['class' => 'form-control']) !!}
</div>

<!-- Part Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('part_percentage', '% Participación:') !!}
    {!! Form::number('part_percentage', null, ['class' => 'form-control']) !!}
</div>

<!-- Adminlog Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('adminlog_percentage', '% Admin y logistica:') !!}
    {!! Form::number('adminlog_percentage', null, ['class' => 'form-control']) !!}
</div>

<!-- Cd Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cd_percentage', '% CD:') !!}
    {!! Form::number('cd_percentage', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total', 'Total:') !!}
    {!! Form::number('total', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('observation', 'Observacion:') !!}
    {!! Form::text('observation', null, ['class' => 'form-control']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#procedure').select2({
                placeholder: '',
                allowClear: true,
                width: '100%',
                theme: 'bootstrap4',
                ajax: {
                    url: '{{ route('code.procedures') }}',
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
    </script>
@endpush