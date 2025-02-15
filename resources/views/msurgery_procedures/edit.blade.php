@extends('layouts.app')

@section('content')
    <section class="content-header">
        
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            <div class="card-header">
                <strong>Editar procedimiento de una cirugia</strong>
            </div>
            {!! Form::model($msurgeryProcedure, ['route' => ['msurgeryProcedures.update', $msurgeryProcedure->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('msurgery_procedures.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                <a href="{{ route('msurgeryProcedures.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
