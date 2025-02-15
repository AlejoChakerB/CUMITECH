@extends('layouts.app')

@section('content')
    <section class="content-header">
        
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            <div class="card-header">
                <strong>Editar costo servicio de imagenes</strong>
            </div>
            {!! Form::model($imagingProductionHourcost, ['route' => ['imagingProductionHourcosts.update', $imagingProductionHourcost->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('imaging_production_hourcosts.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                <a href="{{ route('imagingProductionHourcosts.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
