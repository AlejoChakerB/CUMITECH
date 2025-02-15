@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Sin asistencia</h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">

    @include('flash::message')

    <div class="clearfix"></div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover" id="control-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Hora de entrada</th>
                            <th>Hora de salida</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->employe->name }}</td>
                            <td>{{ $attendance->workday }}</td>
                            <td>{{ $attendance->aentry_time }}</td>
                            <td>{{ $attendance->adeparture_time }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                <div class="float-right">

                </div>
            </div>
        </div>

    </div>
</div>
@endsection