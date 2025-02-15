@extends('layouts.app')

@section('content')
    <section class="content-header">
        
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            <div class="card-header">
                <strong>Editar datos de estancia</strong>
            </div>
            {!! Form::model($accommodationCost, ['route' => ['accommodationCosts.update', $accommodationCost->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('accommodation_costs.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                <a href="{{ route('accommodationCosts.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
