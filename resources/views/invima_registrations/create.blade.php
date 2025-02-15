@extends('layouts.app')

@section('content')
    <section class="content-header">
        
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            <div class="card-header">
                <strong>Agregar registro invima</strong>
            </div>
            {!! Form::open(['route' => 'invimaRegistrations.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('invima_registrations.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                <a href="{{ route('invimaRegistrations.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
