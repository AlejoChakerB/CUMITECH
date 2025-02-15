@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-12">
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            <div class="card-header">
                <strong>Entrega de carnet</strong>
            </div>
            {!! Form::open(['route' => 'cards.store']) !!}

            <div class="card-body">
                <div class="row">
                    @include('cards.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success text-white']) !!}
                <a href="{{ route('cards.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
