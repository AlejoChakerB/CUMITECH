@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Imaging Production Cupsxitems</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($imagingProductionCupsxitems, ['route' => ['imagingProductionCupsxitems.update', $imagingProductionCupsxitems->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('imaging_production_cupsxitems.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('imagingProductionCupsxitems.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
