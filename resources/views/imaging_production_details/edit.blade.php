@extends('layouts.app')

@section('content')
    <section class="content-header">
        
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            <div class="card-header">
                <strong>Editar procedimiento de imagenes</strong>
            </div>
            {!! Form::model($imagingProductionDetails, ['route' => ['imagingProductionDetails.update', $imagingProductionDetails->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('imaging_production_details.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                <a href="{{ route('imagingProductionDetails.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
