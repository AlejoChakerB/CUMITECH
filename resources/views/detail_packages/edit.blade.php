@extends('layouts.app')

@section('content')
    <section class="content-header">
        
    </section>

    <div class="content px-3">
        
        @include('adminlte-templates::common.errors')

        <div class="card">
            <div class="card-header">
                <strong>Editar detalle de paquete</strong>
            </div>
            {!! Form::model($detailPackage, ['route' => ['detailPackages.update', $detailPackage->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('detail_packages.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                <a href="{{ route('detailPackages.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
