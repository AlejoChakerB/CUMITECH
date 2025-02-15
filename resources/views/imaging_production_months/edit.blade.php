@extends('layouts.app')

@section('content')
    <section class="content-header">
        
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            <div class="card-header">
                <strong>Editar producción mensual</strong>
            </div>
            {!! Form::model($imagingProductionMonth, ['route' => ['imagingProductionMonths.update', $imagingProductionMonth->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('imaging_production_months.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                <a href="{{ route('imagingProductionMonths.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
