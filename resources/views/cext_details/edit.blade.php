@extends('layouts.app')

@section('content')
    <section class="content-header">
        
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            <div class="card-header">
                <strong>Editar detalles CEXT</strong>
            </div>
            {!! Form::model($cextDetails, ['route' => ['cextDetails.update', $cextDetails->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('cext_details.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                <a href="{{ route('cextDetails.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
