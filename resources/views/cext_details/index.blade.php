@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid" style="padding: 0 0">
            <div class=" d-flex justify-content-between mb-4" style="background-color: transparent; padding: 0 0;">
                <h3 class="card-title m-0" style="font-size: 35px; color: #2B3D63;">Costos consulta externa
                    <span>{{ $yearOnly ?? '' }}
                </h3>
            </div>
            {{-- CARDS --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1 box-dolar"><i data-feather="dollar-sign"
                                stroke-width="3" width="40px" height="40px" class="dollar"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text title-card">Costo por hora</span>
                            <span class="info-box-number title-body">
                                <small>$</small>
                                {{ number_format($hourCost->room_valueTotal, 0, ',', '.') }}
                            </span>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1 door"><i class="fas fa-door-closed"
                                id="door"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text title-card door">Número de salas</span>
                            <span class="info-box-number title-body">
                                {{ $hourCost->number_room }}
                            </span>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="far fa-calendar-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text title-card">Días producidos</span>
                            <span class="info-box-number title-body">
                                {{ $hourCost->days_produced }}
                            </span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                <div class="mb-2">
                    @can('reportbi_cextDetails')
                        <a href="{{ route('cext_details.report') }}" class="btn btn-default buttom-left" title="Mirar reporte">
                            <i data-feather="bar-chart" stroke-width="2" width="20px" height="20px"
                                id="loadContractBtn"></i><span>Reporte PowerBi</span>
                        </a>
                    @endcan
                    @can('create_cextDetails')
                        <a href="{{ route('cext.calculate') }}" class="btn btn-default buttom-left-cost" title="Calcular costos"
                            id="syncButton">
                            <i data-feather="dollar-sign" stroke-width="2" width="20px" height="20px"
                                id="loadContractBtn"></i><span>Calcular costos</span>
                        </a>
                    @endcan
                    @can('exporti_cextDetails')
                        <a class="btn btn-default buttom-left-export" data-bs-toggle="modal" data-bs-target="#importar"
                            title="Importar tarifas">
                            <i data-feather="download" stroke-width="2" width="20px" height="20px"
                                id="loadContractBtn"></i><span>Exportar excel</span>
                        </a>
                    @endcan
                </div>

                <div class="d-flex flex-wrap justify-content-start">
                    <form action="{{ route('cextDetails.index') }}" method="GET" class="d-flex mr-2 mb-2">
                        <div class="input-group mr-2" style="max-width: 100px;">
                            <div class="input-group-prepend">
                                <label class="input-group-text border-right-0 view pr-1"
                                    style="background-color: transparent;"><span><i
                                            class="fas fa-align-justify"></i></span></label>
                            </div>
                            <select class="custom-select border-left-0 input" id="perPageSelect" name="per_page"
                                class="form-select" onchange="this.form.submit()">
                                <option value="10" {{ $cextDetails->perPage() == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $cextDetails->perPage() == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $cextDetails->perPage() == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $cextDetails->perPage() == 100 ? 'selected' : '' }}>100
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
                                placeholder="Buscar especialidad" style="outline: none; box-shadow: none">
                        </div>
                    </form>

                    <div class="mb-2">
                        @can('create_cextDetails')
                            <a href="{{ route('cextDetails.create') }}" class="btn btn-default" title="Agregar contracto"
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
                        @include('cext_details.table')
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

        .dollar:hover {
            animation: rotar 2s infinite linear;
        }

        .door:hover #door:before {
            content: "\f52b";
            transition: content 0.3s ease;
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
            $('#specialty').select2({
                dropdownParent: $('#importar .modal-body'),
                placeholder: 'Seleccione una especialidad',
                allowClear: true,
                width: '100%',
                theme: 'bootstrap4',
                ajax: {
                    url: '{{ route('search.searchCextSpecialty') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(doctors) {
                                console.log(doctors);
                                return {
                                    id: doctors.specialty,
                                    text: doctors.specialty
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #28a745; color: white">
                    <h5 class="modal-title" id="staticBackdropLabel">Importar archivo excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {!! Form::open(['route' => 'exportCext', 'id' => 'myForm']) !!}
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
                            {!! Form::label('specialty', 'Especialidad:') !!}
                            {!! Form::select('specialty', [], null, [
                                'class' => 'form-control custom-select',
                                'id' => 'specialty',
                                'placeholder' => 'Seleccione una especialidad',
                                'disabled',
                            ]) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('duration', 'Duracion (Min):') !!}
                            {!! Form::select(
                                'duration',
                                [
                                    '0' => '0',
                                    '25' => '25',
                                    '50' => '50',
                                    '75' => '75',
                                    '100' => '100',
                                ],
                                null,
                                [
                                    'class' => 'form-control custom-select',
                                    'id' => 'procedure',
                                    'placeholder' => 'Seleccione la duracion minima',
                                    'disabled',
                                ],
                            ) !!}
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
