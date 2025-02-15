@extends('layouts.app')

@section('content')
    <section class="content-header">
        
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($presenter, ['route' => ['presenters.update', $presenter->id], 'method' => 'patch']) !!}
            
            <div class="card-header">
                <strong>Registrar presentador</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    @include('presenters.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('presenters.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
