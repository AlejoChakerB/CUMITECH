@extends('layouts.app')

@section('content')
<div class="content px-3 mt-2">
    <div class="container-fluid">
        <div class="card shadow-none border-0">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: white; padding: 0 0;">
                <h3 class="card-title m-0" style="color: #69C5A0; font-size: 25px;"><strong>Cirugias</strong></h3>
                <div class="ml-auto d-flex align-items-center gap-2">
                    @can('create_employes')
                    <a href="{{ route('multiple_surgeries.create') }}" class="btn btn-default" title="Agregar empleado">
                        <span class="fas fa-user-plus" style="color: #69C5A0"></span>
                    </a>
                    <a class="btn btn-default" data-toggle="modal" data-target="#CosttModal" title="Calcular costos">
                        <span class="fas fa-coins" style="color: #ffbf00"></span>
                    </a>
                    <a class="btn btn-default" data-toggle="modal" data-target="#exportModal"
                        title="Actualizar cirugias">
                        <span class="fas fa-upload" style="color: #69C5A0"></span>
                    </a>
                    @endcan
                </div>
            </div>

            <div class="card-body p-0">
                <!-- Card -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-procedures"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Cirugias hoy</span>
                                <span class="info-box-number">10<small>%</small></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-plus"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Cirugias Mes</span>
                                <span class="info-box-number">41,410</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i
                                    class="fas fa-shopping-cart"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Cirugias año</span>
                                <span class="info-box-number">760</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">New Members</span>
                                <span class="info-box-number">2,000</span>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('multiple_surgeries.index') }}" method="GET"
                    class="d-flex justify-content-between align-items-center">
                    <!-- Selector de registros por página (Mostrar) a la izquierda -->
                    <div class="form-group mb-3">
                        <label for="perPageSelect" class="mr-2" style="color: #69C5A0">Mostrar:</label>
                        <select id="perPageSelect" name="per_page" class="form-select" style="border-radius: 20px"
                            onchange="this.form.submit()">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="1000">1000</option>
                        </select>
                    </div>

                    <!-- Botón de búsqueda (Buscar) a la derecha -->
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button class="btn btn-default" type="submit"
                                    style="border-radius: 20px; color: #69C5A0"><strong>Buscar</strong></button>
                            </div>
                            <input type="text" class="form-control" name="search" placeholder="Buscar cirugia"
                                style="border-radius: 20px;">
                        </div>
                    </div>
                </form>
                <div class="card-panel">
                    @include('multiple_surgeries.table')
                </div>
            </div>
        </div>
    </div>
    <div id="app">
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @include('layouts.alerts')
</div>
<!-- Modal -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seleccione el periodo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('get.msurgeries') }}" method="GET" style="margin-bottom: 0;">
                <div class="modal-body">
                    @csrf
                    <div class="form-group col-sm-8">
                        {!! Form::label('start_date', 'Fecha inicial:') !!}
                        {!! Form::text('start_date', null, ['class' => 'form-control','id'=>'start_date']) !!}
                    </div>
                    <div class="form-group col-sm-8">
                        {!! Form::label('end_date', 'Fecha final:') !!}
                        {!! Form::text('end_date', null, ['class' => 'form-control','id'=>'end_date']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style="color: white">Registrar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="color: white">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Cost -->
<div class="modal fade" id="CosttModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seleccione el periodo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="GET" style="margin-bottom: 0;">
                <div class="modal-body">
                    @csrf
                    <div class="form-group col-sm-8">
                        {!! Form::label('start_date', 'Fecha inicial:') !!}
                        {!! Form::text('start_date', null, ['class' => 'form-control','id'=>'start_date']) !!}
                    </div>
                    <div class="form-group col-sm-8">
                        {!! Form::label('end_date', 'Fecha final:') !!}
                        {!! Form::text('end_date', null, ['class' => 'form-control','id'=>'end_date']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style="color: white">Registrar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="color: white">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('page_scripts')
<script type="text/javascript">
    $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
</script>
@endpush
@endsection