<!-- Service Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service', 'Servicio:') !!}
    {!! Form::select('service', [
        'ECOCARDIOGRAMA' => 'ECOCARDIOGRAMA',
        'ECOGRAFIA' => 'ECOGRAFIA',
        'MAMOGRAFIA' => 'MAMOGRAFIA',
        'TOMOGRAFIA' => 'TOMOGRAFIA',
        'RAYOS X' => 'RAYOS X',
        'RESONANCIA' => 'RESONANCIA'
    ],null, ['class' => 'form-control custom-select', 'placeholder' => 'Seleccione el servicio']) !!}
</div>

<!-- Service Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Categoria:') !!}
    {!! Form::select('category', [
        'ECOCARDIOGRAMA' => 'ECOCARDIOGRAMA',
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
    ],null, ['class' => 'form-control custom-select', 'placeholder' => 'Seleccione la categoria']) !!}
</div>

<!-- Cups Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cups', 'Cups:') !!}
    {!! Form::text('cups', null, ['class' => 'form-control', 'placeholder' => 'Seleccione el procedimiento']) !!}
</div>

<!-- Duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration', 'Duracion:') !!}
    {!! Form::number('duration', null, ['class' => 'form-control', 'placeholder' => 'Digite la duracion']) !!}
</div>

<!-- Transcriber Cost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('transcriber_cost', 'Costo del Tecnico/Transciptor:') !!}
    {!! Form::number('transcriber_cost', null, ['class' => 'form-control', 'placeholder' => 'Digite el costo del tecnico/transcriptor']) !!}
</div>

<!-- Supplies Cost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contrast', 'Contraste:') !!}
    {!! Form::number('contrast', 0, ['class' => 'form-control', 'placeholder' => 'Digite el costo del contraste']) !!}
</div>

<!-- Supplies Cost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sedation', 'Sedacion:') !!}
    {!! Form::number('sedation', 0, ['class' => 'form-control', 'placeholder' => 'Digite el costo de la sedacion']) !!}
</div>
