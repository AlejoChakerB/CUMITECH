@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid" style="padding: 0 0">
            <div class=" d-flex justify-content-between mb-4" style="background-color: transparent; padding: 0 0;">
                <h3 class="card-title m-0" style="font-size: 35px; color: #2B3D63;">Costos imagenes
                    <span>{{ $yearOnly ?? '' }}
                </h3>
            </div>
            {{-- CARDS --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-gray elevation-1"><i class="fas fa-file-medical"
                                id="loadContractBtn"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text title-card">Sala ecografia</span>
                            <span class="info-box-number title-body">
                                <small>$</small>
                                {{ number_format($ecogafry, 2, ',', '.') }}
                            </span>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-red elevation-1"><i class="fas fa-heartbeat"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text title-card">Sala ecocardiograma</span>
                            <span class="info-box-number title-body">
                                <small>$</small>
                                {{ number_format($ecocar, 2, ',', '.') }}
                            </span>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-pink elevation-1"><i class="fas fa-ribbon"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text title-card">Sala mamografia</span>
                            <span class="info-box-number title-body">
                                <small>$</small>
                                {{ number_format($mamo, 2, ',', '.') }}
                            </span>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-prescription"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text title-card">Sala rayos x</span>
                            <span class="info-box-number title-body">
                                <small>$</small>
                                {{ number_format($rayx, 2, ',', '.') }}
                            </span>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-blue elevation-1"><i class="fas fa-x-ray"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text title-card">Sala resonancia</span>
                            <span class="info-box-number title-body">
                                <small>$</small>
                                {{ number_format($reso, 2, ',', '.') }}
                            </span>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-brain"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text title-card">Sala tomografia</span>
                            <span class="info-box-number title-body">
                                <small>$</small>
                                {{ number_format($tomo, 2, ',', '.') }}
                            </span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                <div class="mb-2">
                    @can('reportbi_imaging')
                        <a href="{{ route('imaging_production_details.report') }}" class="btn btn-default buttom-left"
                            title="Mirar reporte">
                            <i data-feather="bar-chart" stroke-width="2" width="20px" height="20px"
                                id="loadContractBtn"></i><span>Reporte PowerBi</span>
                        </a>
                    @endcan
                    @can('import_imaging')
                        <a class="btn btn-default buttom-left" data-bs-toggle="modal" data-bs-target="#importar"
                            title="Importar">
                            <i data-feather="upload" stroke-width="1.5"></i><span>Importar</span>
                        </a>
                    @endcan
                    @can('export_imaging')
                        <a class="btn btn-default buttom-left-export" data-bs-toggle="modal" data-bs-target="#exportar"
                            title="Importar tarifas">
                            <i data-feather="download" stroke-width="2" width="20px" height="20px"
                                id="loadContractBtn"></i><span>Exportar excel</span>
                        </a>
                    @endcan
                    @can('create_imagingProductionDetails')
                        <a href="{{ route('imagingProductionDetails.calculate') }}" class="btn btn-default buttom-left-cost"
                            title="Calcular tarifas" id="syncButton">
                            <i data-feather="dollar-sign" stroke-width="2" width="20px" height="20px"
                                id="loadContractBtn"></i><span>Calcular costos</span>
                        </a>
                    @endcan
                </div>

                <div class="d-flex flex-wrap justify-content-start">
                    <form action="{{ route('imagingProductionDetails.index') }}" method="GET" class="d-flex mr-2 mb-2">
                        <div class="input-group mr-2" style="max-width: 100px;">
                            <div class="input-group-prepend">
                                <label class="input-group-text border-right-0 view pr-1"
                                    style="background-color: transparent;"><span><i
                                            class="fas fa-align-justify"></i></span></label>
                            </div>
                            <select class="custom-select border-left-0 input" id="perPageSelect" name="per_page"
                                class="form-select" onchange="this.form.submit()">
                                <option value="10" {{ $imagingProductionDetails->perPage() == 10 ? 'selected' : '' }}>
                                    10
                                </option>
                                <option value="25" {{ $imagingProductionDetails->perPage() == 25 ? 'selected' : '' }}>
                                    25
                                </option>
                                <option value="50" {{ $imagingProductionDetails->perPage() == 50 ? 'selected' : '' }}>
                                    50
                                </option>
                                <option value="100"
                                    {{ $imagingProductionDetails->perPage() == 100 ? 'selected' : '' }}>
                                    100
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
                                placeholder="Buscar servicio" style="outline: none; box-shadow: none">
                        </div>
                    </form>

                    <div class="mb-2">
                        @can('create_imagingProductionDetails')
                            <a href="{{ route('imagingProductionDetails.create') }}" class="btn btn-default"
                                title="Agregar contracto" style="background-color: #2B3D63; color: white; position: relative;"
                                id="btnAdd">
                                <div id="contentAdd" class="btn-content"><i class="fas fa-plus"></i> Añadir</div>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card shadow-none border-0 mt-3">
                <div class="card-body p-0">
                    <div class="card-panel">
                        @include('imaging_production_details.table')
                    </div>
                </div>
            </div>
        </div>
        <div id="app">
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        @include('layouts.alerts')
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

        .title-card {
            color: #2B3D63;
        }

        .title-body {
            color: #2B3D63;
        }
    </style>
    <script>
        feather.replace();
        document.addEventListener('DOMContentLoaded', function() {
            var loadarticlesBtn = document.getElementById('loadContractBtn');
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

        document.addEventListener('DOMContentLoaded', function() {
            // Seleccionar los elementos de los radio buttons
            const disableFieldsRadio = document.getElementById('disableFields');
            const enableFieldsRadio = document.getElementById('enableFields');
            // Seleccionar todos los campos del formulario que queremos habilitar/deshabilitar
            const formFields = document.querySelectorAll('#myForm .form-control');

            // Función para habilitar/deshabilitar los campos
            function toggleFields(disable) {
                formFields.forEach(field => {
                    field.disabled = disable;
                });
            }

            // Event listeners para los radio buttons
            disableFieldsRadio.addEventListener('change', function() {
                if (this.checked) {
                    toggleFields(true);
                }
            });

            enableFieldsRadio.addEventListener('change', function() {
                if (this.checked) {
                    toggleFields(false);
                }
            });
        });

        //Select2 especialidad
        $(document).ready(function() {
            $('#service').select2({
                dropdownParent: $('#exportar .modal-body'),
                placeholder: 'Seleccione una especialidad',
                allowClear: true,
                width: '100%',
                theme: 'bootstrap4',
                ajax: {
                    url: '{{ route('search.searchService') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(serviceImage) {
                                return {
                                    id: serviceImage.service,
                                    text: serviceImage.service
                                };
                            })
                        };
                    },
                    cache: true
                },
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    },
                    searching: function() {
                        return "Buscando...";
                    },
                }
            });
        });

        //Select2 especialidad
        $(document).ready(function() {
            $('#category').select2({
                dropdownParent: $('#exportar .modal-body'),
                placeholder: 'Seleccione una especialidad',
                allowClear: true,
                width: '100%',
                theme: 'bootstrap4',
                ajax: {
                    url: '{{ route('search.searchCategory') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(categoryImage) {
                                return {
                                    id: categoryImage.category,
                                    text: categoryImage.category
                                };
                            })
                        };
                    },
                    cache: true
                },
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    },
                    searching: function() {
                        return "Buscando...";
                    },
                }
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
    <!-- Modal -->
    <div class="modal fade" id="importar" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #28a745; color: white">
                    <h5 class="modal-title" id="staticBackdropLabel">Importar archivo excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('importImagingdetail') }}" method="post" enctype="multipart/form-data">
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
                        <a href="{{ route('download.imagingDetail') }}" class="btn btn-default buttom-left"
                            title="Calcular tarifas" id="syncButton">
                            <i class="fas fa-file-excel" style="color: green"></i><span>descargar plantilla</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exportar" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #28a745; color: white">
                    <h5 class="modal-title" id="staticBackdropLabel">Importar archivo excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {!! Form::open(['route' => 'exportImaging', 'id' => 'myForm']) !!}
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="form-group">
                            <label>Opciones:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="custom-control-input custom-control-input-success" type="radio"
                                    name="options" id="disableFields" value="All" checked>
                                <label class="custom-control-label" for="disableFields">Exportar todo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="custom-control-input custom-control-input-success" type="radio"
                                    name="options" id="enableFields" value="Filters">
                                <label class="custom-control-label" for="enableFields">Exportar filtros</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('service', 'Servicio:') !!}
                            {!! Form::select('service', [], null, [
                                'class' => 'form-control custom-select',
                                'id' => 'service',
                                'placeholder' => 'Seleccione el servicio',
                                'disabled',
                            ]) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('category', 'Categoria:') !!}
                            {!! Form::select('category', [], null, [
                                'class' => 'form-control custom-select',
                                'id' => 'category',
                                'placeholder' => 'Seleccione la categoria',
                                'disabled',
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style="color: white">Exportar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="color: white">Cancelar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
