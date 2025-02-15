@extends('layouts.app')

@section('content')
    <section class="content-header">
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'presenters.store']) !!}
            <div class="card-header">
                <strong>Registrar presentador</strong>
            </div>
            <div class="card-body">

                <div class="row">
                    @include('presenters.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                <a href="{{ route('presenters.index') }}" class="btn btn-second">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
