@extends('layouts.app')

@section('content')
    <section class="content-header">
        
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            <div class="card-header">
                <strong>Editar calendario</strong>
            </div>
            {!! Form::model($calendar, ['route' => ['calendars.update', $calendar->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('calendars.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Modificar', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('calendars.index') }}" class="btn btn-default">Cancelar</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
