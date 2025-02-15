@extends('layouts.app')

@section('content')
    <section class="content-header">
            
    </section>
    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card mt-3">
            <div class="card-header">
                <strong>Registrar costo</strong>
            </div>
            {!! Form::open(['route' => 'generalCosts.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('general_costs.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                <a href="{{ route('generalCosts.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
