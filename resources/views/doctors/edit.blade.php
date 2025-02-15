@extends('layouts.app')

@section('content')
    <section class="content-header">
        
    </section>

    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        
        <div class="card">
            <div class="card-header">
                <strong>Editar médico</strong>
            </div>
            {!! Form::model($doctors, ['route' => ['doctors.update', $doctors->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('doctors.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success', 'style' => 'color: white;']) !!}
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
