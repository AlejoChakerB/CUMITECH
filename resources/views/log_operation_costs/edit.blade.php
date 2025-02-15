@extends('layouts.app')

@section('content')
    <section class="content-header">
        
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            <div class="card-header">
                <strong>Editar detalle del costo unitario</strong>
            </div>
            {!! Form::model($logOperationCost, ['route' => ['logOperationCosts.update', $logOperationCost->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('log_operation_costs.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                <a href="{{ route('logOperationCosts.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
