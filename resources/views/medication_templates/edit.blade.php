@extends('layouts.app')

@section('content')
    <section class="content-header">
       
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            <div class="card-header">
                <strong>Editar plantilla</strong>
            </div>

            {!! Form::model($medicationTemplate, ['route' => ['medicationTemplates.update', $medicationTemplate->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('medication_templates.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                <a href="{{ route('medicationTemplates.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
