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
            {!! Form::model($endowment, ['route' => ['endowments.update', $endowment->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('endowments.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success text-white']) !!}
                <a href="{{ route('endowments.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

            {!! Form::close() !!}
        </div>
        @include('layouts.alerts')
    </div>
@endsection
