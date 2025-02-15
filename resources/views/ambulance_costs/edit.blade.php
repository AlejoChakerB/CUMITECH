@extends('layouts.app')

@section('content')
    <section class="content-header">
        
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            <div class="card-header">
                <strong>Editar costo de ambulancia</strong>
            </div>
            {!! Form::model($ambulanceCost, ['route' => ['ambulanceCosts.update', $ambulanceCost->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('ambulance_costs.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                <a href="{{ route('ambulanceCosts.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
