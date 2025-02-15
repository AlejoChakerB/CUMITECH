@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid" style="padding: 0 0">
        <div class=" d-flex justify-content-between mb-5" style="background-color: transparent; padding: 0 0;">
            <h3 class="card-title m-0" style="font-size: 35px; color: #2B3D63;">Cirugias</h3>
        </div>
        <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
            <div class="mb-2">
                @can('create_surgeries')
                <a class="btn btn-default buttom-left" data-bs-toggle="modal" data-bs-target="#exportModal"
                    title="Actualizar cirugias" id="syncButton">
                    <i data-feather="refresh-cw" stroke-width="1.5" width="20px" height="20px"
                        id="loadContractBtn"></i><span>Actualizar</span>
                </a>
                @endcan
                @can('calculate_cost')
                <a class="btn btn-default buttom-left-cost" data-bs-toggle="modal" data-bs-target="#CosttModal"
                    title="Calcular costos">
                    <i data-feather="dollar-sign" stroke-width="2" width="20px" height="20px"
                        id="loadContractBtn"></i><span>Calcular costos</span>
                </a>
                @endcan
            </div>

            <div class="d-flex flex-wrap justify-content-start">
                <form action="{{ route('surgeries.index') }}" method="GET" class="d-flex mr-2 mb-2">
                    <div class="input-group mr-2" style="max-width: 100px;">
                        <div class="input-group-prepend">
                            <label class="input-group-text border-right-0 view pr-1"
                                style="background-color: transparent;"><span><i
                                        class="fas fa-align-justify"></i></span></label>
                        </div>
                        <select class="custom-select border-left-0 input" id="perPageSelect" name="per_page"
                            class="form-select" onchange="this.form.submit()">
                            <option value="10" {{ $surgeries->perPage() == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $surgeries->perPage() == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $surgeries->perPage() == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $surgeries->perPage() == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div>
                    <div class="input-group flex-grow-1 mr-2">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-default border-right-0 pr-1" type="submit"
                                style="box-shadow: none; border-color: #CED4DA"><strong><span
                                        class="fas fa-search"></span></strong></button>
                        </div>
                        <input type="text" class="form-control border-left-0 input flex-grow-1" name="search"
                            placeholder="Buscar cirugia" style="outline: none; box-shadow: none">
                    </div>
                </form>

                <div class="mb-2">
                    @can('create_surgeries')
                    <a href="{{ route('surgeries.create') }}" class="btn btn-default" title="Agregar cirugia"
                        style="background-color: #2B3D63; color: white; position: relative;" id="btnAdd">
                        <div id="contentAdd" class="btn-content"><i class="fas fa-plus"></i> Añadir</div>
                    </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card shadow-none border-0 mt-3">
            <div class="card-body p-0">
                <div class="card-panel">
                    @include('surgeries.table')
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
<div class="modal fade" id="exportModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #28a745; color: white">
                <h5 class="modal-title" id="staticBackdropLabel">Actualizar cirugias</h5>
                <button type="button" class="btn-close btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('get.surgeries') }}" method="GET" style="margin-bottom: 0;">
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
<div class="modal fade" id="CosttModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #28a745; color: white">
                <h5 class="modal-title" id="exampleModalLabel">Calcular costos</h5>
                <button type="button" class="btn-close btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('costUnit.costSurgeries') }}" method="GET" style="margin-bottom: 0;">
                <div class="modal-body">
                    @csrf
                    <div class="form-group col-sm-8">
                        {!! Form::label('start_date', 'Fecha inicial:') !!}
                        {!! Form::text('start_date', null, ['class' => 'form-control','id'=>'start_datec']) !!}
                    </div>
                    <div class="form-group col-sm-8">
                        {!! Form::label('end_date', 'Fecha final:') !!}
                        {!! Form::text('end_date', null, ['class' => 'form-control','id'=>'end_datec']) !!}
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
<style>
    /* Buscar */
    .input:focus {
        border: 1px solid #CED4DA;
        outline: none;
    }

    .input-group:focus-within .btn {
        border: 1px solid #CED4DA !important;
    }

    /* Mostrar */

    .input-group:focus-within .view {
        border: 1px solid #CED4DA !important;
    }

    .buttom-left {
        background-color: transparent;
        color: #2B3D63;
        box-shadow: 0px 2px 4px rgba(43, 61, 99, 0.3);
        font-size: 15px;
    }

    .buttom-left:hover {
        box-shadow: 0px 4px 8px rgba(43, 61, 99, 0.2);
        /* Cambiar la sombra cuando se pasa el mouse sobre el botón */
    }

    .buttom-left span {
        margin-left: 10px;
    }

    .buttom-left-cost {
        background-color: #FFD04E;
        color: #2B3D63;
        box-shadow: 0px 2px 4px rgba(43, 61, 99, 0.3);
        font-size: 15px;
    }

    .buttom-left-cost:hover {
        background-color: #FFD011;
        box-shadow: 0px 4px 8px rgba(43, 61, 99, 0.2);
        /* Cambiar la sombra cuando se pasa el mouse sobre el botón */
    }

    .buttom-left-cost span {
        margin-left: 5px;
    }
</style>
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
        $('#start_datec').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
        $('#end_datec').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
        feather.replace();
    </script>
@endpush
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var loadarticlesBtn = document.getElementById('loadContractBtn');
        var syncButton = document.getElementById('syncButton');

        syncButton.addEventListener('click', function() {
            // Añade la clase 'loading' al botón cuando se hace clic
            loadarticlesBtn.classList.add('loading');

            // Simula la carga asincrónica
            setTimeout(function() {      
                loadarticlesBtn.classList.remove('loading');
            }, 8000); 
        });
    });
</script>
<style>
    /* Añade un estilo para la animación de carga */
    .loading {
        animation: spin 1s infinite linear;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }
</style>