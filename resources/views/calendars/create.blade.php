@extends('layouts.app')

@section('content')
    <section class="content-header">
        
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            <div class="card-header">
                <strong>Registrar calendario</strong>
            </div>
            {!! Form::open(['route' => 'calendars.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('calendars.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Asignar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('calendars.index') }}" class="btn btn-default">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
