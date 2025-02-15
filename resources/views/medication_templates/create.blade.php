@extends('layouts.app')

@section('content')
    <section class="content-header">
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            <div class="card-header">
                <strong>Crear plantilla</strong>
            </div>
            {!! Form::open(['route' => 'medicationTemplates.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('medication_templates.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success text-white']) !!}
                <a href="{{ route('medicationTemplates.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
