<!-- Service Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service', 'Servicio:') !!}
    {!! Form::select('service', [
        'ECOCARDIOGRAMA' => 'ECOCARDIOGRAMA',
        'ECOCARDIOGRAMA NORMAL' => 'ECOCARDIOGRAMA NORMAL',
        'ECOGRAFIA' => 'ECOGRAFIA',
        'ECOGRAFIA TRANSVAGINAL' => 'ECOGRAFIA TRANSVAGINAL',
        'ECOGRAFIA DE MAMA' => 'ECOGRAFIA DE MAMA',
        'ECOGRAFIA NORMAL' => 'ECOGRAFIA NORMAL',
        'MAMOGRAFIA' => 'MAMOGRAFIA',
        'TOMOGRAFIA - CONTRASTE' => 'TOMOGRAFIA - CONTRASTE',
        'TOMOGRAFIA - SEDACION' => 'TOMOGRAFIA - SEDACION',
        'RAYOS X' => 'RAYOS X',
        'RAYOS X - CONTRASTE' => 'RAYOS X - CONTRASTE',
        'RAYOS X - URETE' => 'RAYOS X - URETE',
        'RAYOS X - TORAX-COLUMNA' => 'RAYOS X - TORAX-COLUMNA',
        'RESONANCIA' => 'RESONANCIA',
        'RESONANCIA - SEDACION' => 'RESONANCIA - SEDACION',
        'RESONANCIA CONTRASTE OMNIPAQUE' => 'RESONANCIA CONTRASTE OMNIPAQUE',
        'RESONANCIA CONTRASTE OMNISCAN' => 'RESONANCIA CONTRASTE OMNISCAN',
        'RESONANCIA CONTRASTE PRIMOVIST' => 'RESONANCIA CONTRASTE PRIMOVIST',
    ],null, ['class' => 'form-control', 'placeholder' => 'seleccione el servicio']) !!}
</div>

<!-- Id Article Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_article', 'Articulo:') !!}
    {!! Form::select('id_article', $articles, null, ['class' => 'form-control', 'placeholder' => '', 'id' => 'article_id']) !!}
</div>

<!-- Quantity Used Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity_used', 'Cantidad utilizada:') !!}
    {!! Form::number('quantity_used', null, ['class' => 'form-control', 'placeholder' => 'Digite la cantidad de utilizada']) !!}
</div>

<!-- Amount Week Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount_week', 'Cantidad distribuida:') !!}
    {!! Form::number('amount_week', null, ['class' => 'form-control', 'placeholder' => 'Digite la cantidad de uso semanal']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#article_id').select2({
                placeholder: 'Seleccione un articulo',
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