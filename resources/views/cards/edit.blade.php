@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            <div class="card-header">
                <strong>Editar entrega</strong>
            </div>
            {!! Form::model($card, ['route' => ['cards.update', $card->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('cards.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Modificar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('cards.index') }}" class="btn btn-default">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
