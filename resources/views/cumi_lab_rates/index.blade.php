@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid" style="padding: 0 0">
            <div class=" d-flex justify-content-between mb-5" style="background-color: transparent; padding: 0 0;">
                <h3 class="card-title m-0" style="font-size: 35px; color: #2B3D63;">Costos CumiLab <span>{{ $yearOnly ?? '' }}
                </h3>
            </div>
            {{-- CARDS --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i data-feather="dollar-sign" stroke-width="3"
                                width="40px" height="40px" id="loadContractBtn"></i></span>
                        <div class="info-box-content" style="color: #2B3D63;">
                            <span class="info-box-text title-card">COSTO DIRECTO</span>
                            <span class="info-box-number title-body">
                                <small>$</small>
                                {{ number_format($cd, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i data-feather="dollar-sign" stroke-width="3"
                                width="40px" height="40px" id="loadContractBtn"></i></span>
                        <div class="info-box-content" style="color: #2B3D63;">
                            <span class="info-box-text title-card">SUMA ADMINYLOG</span>
                            <span class="info-box-number title-body">
                                <small>$</small>
                                {{ number_format($adminlog, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                <div class="mb-2">
                    @can('import_cumiLabRates')
                        <a data-bs-toggle="modal" data-bs-target="#importar" class="btn btn-default buttom-left"
                            title="Importar producción">
                            <i data-feather="upload" stroke-width="1.5"></i><span>Importar</span>
                        </a>
                    @endcan
                    @can('reportbi_cumiLabRates')
                        <a href="{{ route('cumi_lab_rates.report') }}" class="btn btn-default buttom-left"
                            title="Mirar reporte">
                            <i data-feather="bar-chart" stroke-width="2" width="20px" height="20px"
                                id="loadContractBtn"></i><span>Reporte PowerBi</span>
                        </a>
                    @endcan
                    @can('export_cumiLabRates')
                        <form action="{{ route('exportCumiLab') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-default buttom-left-export" title="Importar tarifas">
                                <i data-feather="download" stroke-width="2" width="20px" height="20px"
                                    id="loadContractBtn"></i>
                                <span>Exportar excel</span>
                            </button>
                        </form>
                    @endcan
                    @can('create_cumiLabRates')
                        <a href="{{ route('cumilab.calculateLab') }}" class="btn btn-default buttom-left-cost"
                            title="Calcular tarifas" id="syncButton">
                            <i data-feather="dollar-sign" stroke-width="2" width="20px" height="20px"
                                id="loadLabBtn"></i><span>Calcular costos</span>
                        </a>
                    @endcan
                    @can('end_cumiLabRates')
                        <a href="{{ route('cumilab.endPeriod') }}" class="btn btn-default buttom-left-period"
                            title="Calcular tarifas">
                            <i data-feather="chevrons-right" stroke-width="2" width="20px" height="20px"
                                id="loadContractBtn"></i><span>Finalizar periodo</span>
                        </a>
                    @endcan
                </div>

                <div class="d-flex flex-wrap justify-content-start">
                    <form action="{{ route('cumiLabRates.index') }}" method="GET" class="d-flex mr-2 mb-2">
                        <div class="input-group mr-2" style="max-width: 100px;">
                            <div class="input-group-prepend">
                                <label class="input-group-text border-right-0 view pr-1"
                                    style="background-color: transparent;"><span><i
                                            class="fas fa-align-justify"></i></span></label>
                            </div>
                            <select class="custom-select border-left-0 input" id="perPageSelect" name="per_page"
                                class="form-select" onchange="this.form.submit()">
                                <option value="10" {{ $cumiLabRates->perPage() == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $cumiLabRates->perPage() == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $cumiLabRates->perPage() == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $cumiLabRates->perPage() == 100 ? 'selected' : '' }}>100
                                </option>
                            </select>
                        </div>
                        <div class="input-group flex-grow-1 mr-2">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-default border-right-0 pr-1" type="submit"
                                    style="box-shadow: none; border-color: #CED4DA"><strong><span
                                            class="fas fa-search"></span></strong></button>
                            </div>
                            <input type="text" class="form-control border-left-0 input flex-grow-1" name="search"
                                placeholder="Buscar tarifa" style="outline: none; box-shadow: none">
                        </div>
                    </form>

                    <div class="mb-2">
                        @can('create_cumiLabRates')
                            <a href="{{ route('cumiLabRates.create') }}" class="btn btn-default" title="Agregar contracto"
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
                        @include('cumi_lab_rates.table')
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
    <div class="modal fade" id="importar" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #28a745; color: white">
                    <h5 class="modal-title" id="staticBackdropLabel">Importar archivo excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('importlab') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01"
                                    aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01" data-browse="Buscar">Seleccionar
                                    un archivo...</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" style="color: white">Cargar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
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

        .buttom-left-period {
            background-color: #512DA8;
            color: white;
            box-shadow: 0px 2px 4px rgba(43, 61, 99, 0.3);
            font-size: 15px;
        }

        .buttom-left-period:hover {
            background-color: #371e72;
            color: white;
            box-shadow: 0px 4px 8px rgba(43, 61, 99, 0.2);
            /* Cambiar la sombra cuando se pasa el mouse sobre el botón */
        }

        .buttom-left-period span {
            margin-left: 5px;
        }

        .buttom-left-export {
            background-color: #0E7840;
            color: white;
            box-shadow: 0px 2px 4px rgba(43, 61, 99, 0.3);
            font-size: 15px;
        }

        .buttom-left-export:hover {
            background-color: #209E62;
            color: white;
            box-shadow: 0px 4px 8px rgba(43, 61, 99, 0.2);
            /* Cambiar la sombra cuando se pasa el mouse sobre el botón */
        }

        .buttom-left-export span {
            margin-left: 5px;
        }

        .send {
            color: white;
            background-color: #69C5A0;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 30px;
            font-weight: bold;
        }
    </style>
    <script>
        feather.replace();
        document.addEventListener('DOMContentLoaded', function() {
            var loadarticlesBtn = document.getElementById('loadLabBtn');
            var syncButton = document.getElementById('syncButton');

            syncButton.addEventListener('click', function() {
                // Añade la clase 'loading' al botón cuando se hace clic
                loadarticlesBtn.classList.add('loading');

                // Simula la carga asincrónica
                setTimeout(function() {
                    loadarticlesBtn.classList.remove('loading');
                }, 4000);
            });
        });
    </script>
    <style>
        /* Añade un estilo para la animación de carga */
        .loading {
            animation: rotar 2s infinite linear;
        }

        @keyframes rotar {
            from {
                transform: rotateY(0deg);
            }

            to {
                transform: rotateY(360deg);
            }
        }
    </style>
@endsection
