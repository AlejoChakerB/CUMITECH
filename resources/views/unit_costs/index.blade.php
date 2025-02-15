@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid" style="padding: 0 0">
            <div class=" d-flex justify-content-between mb-5" style="background-color: transparent; padding: 0 0;">
                <h3 class="card-title m-0" style="font-size: 35px;">Costo unitario</h3>
            </div>
            <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                <div class="mb-2">
                    @can('reportbi_unitCost')
                    <a href="{{ route('unitCosts.report') }}" class="btn btn-default buttom-left-cost" title="Mirar reporte">
                        <i data-feather="bar-chart" stroke-width="2" width="20px" height="20px"
                            id="loadContractBtn"></i><span>Reporte PowerBi</span>
                    </a>
                    @endcan

                    @can('export_unitCost')
                    <a class="btn btn-default buttom-left-export" data-bs-toggle="modal" data-bs-target="#importar"
                        title="Importar tarifas">
                        <i data-feather="download" stroke-width="2" width="20px" height="20px"
                            id="loadContractBtn"></i><span>Exportar excel</span>
                    </a>
                    @endcan
                </div>

                <div class="d-flex flex-wrap justify-content-start">
                    <form action="{{ route('unitCosts.index') }}" method="GET" class="d-flex mr-2 mb-2">
                        <div class="input-group mr-2" style="max-width: 100px;">
                            <div class="input-group-prepend">
                                <label class="input-group-text border-right-0 view pr-1"
                                    style="background-color: transparent;"><span><i
                                            class="fas fa-align-justify"></i></span></label>
                            </div>
                            <select class="custom-select border-left-0 input" id="perPageSelect" name="per_page"
                                class="form-select" onchange="this.form.submit()">
                                <option value="10" {{ $unitCosts->perPage() == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $unitCosts->perPage() == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $unitCosts->perPage() == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $unitCosts->perPage() == 100 ? 'selected' : '' }}>100
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
                                placeholder="Buscar costo unitario" style="outline: none; box-shadow: none">
                        </div>
                    </form>

                    <div class="mb-2">
                        @can('calculate_cost')
                            <a href="{{ route('unitCosts.create') }}" class="btn btn-default" title="Agregar contracto"
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
                        @include('unit_costs.table')
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

        .buttom-left-cost {
            background-color: transparent;
            color: #2B3D63;
            box-shadow: 0px 2px 4px rgba(43, 61, 99, 0.3);
            font-size: 15px;
        }

        .buttom-left-cost:hover {
            box-shadow: 0px 4px 8px rgba(43, 61, 99, 0.2);
            /* Cambiar la sombra cuando se pasa el mouse sobre el botón */
        }

        .buttom-left-cost span {
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
    </style>
    <script>
        feather.replace();

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
                    url: '{{ route('search.searchSpecialty') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(doctors) {
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

        $(document).ready(function() {
            $('#code').select2({
                dropdownParent: $('#importar .modal-body'),
                placeholder: 'Seleccione una especialidad',
                allowClear: true,
                width: '100%',
                theme: 'bootstrap4',
                ajax: {
                    url: '{{ route('search.searchCupsSurgery') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(code) {
                                return {
                                    id: code.code,
                                    text: code.description
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

        $(document).ready(function(){

            $('#start_date').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: true,
                sideBySide: true
            });
            
            $('#end_date').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: true,
                sideBySide: true
            });
        });

    </script>
    <!-- Modal -->
    <div class="modal fade" id="importar" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #28a745; color: white">
                    <h5 class="modal-title" id="staticBackdropLabel">Importar archivo excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {!! Form::open(['route' => 'exportProcedure', 'id' => 'myForm']) !!}
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
                                'disabled',
                            ]) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('code', 'Cups:') !!}
                            {!! Form::select('code', [], null, [
                                'class' => 'form-control custom-select',
                                'id' => 'code',
                                'disabled',
                            ]) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('participe', 'Participacion:') !!}
                            {!! Form::select(
                                'participe',
                                [
                                    '0.0' => '0%',
                                    '0.25' => '25%',
                                    '0.50' => '50%',
                                    '0.75' => '75%',
                                    '1.0' => '100%',
                                ],
                                null,
                                [
                                    'class' => 'form-control custom-select',
                                    'id' => 'procedure',
                                    'placeholder' => 'Seleccione el % de participacion',
                                    'disabled',
                                ],
                            ) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('Liquidation', 'Liquidacion:') !!}
                            {!! Form::select(
                                'Liquidation',
                                [
                                    '0.0' => '0%',
                                    '0.25' => '25%',
                                    '0.50' => '50%',
                                    '0.75' => '75%',
                                    '1.0' => '100%',
                                ],
                                null,
                                [
                                    'class' => 'form-control custom-select',
                                    'id' => 'procedure',
                                    'placeholder' => 'Seleccione el % de liquidacion',
                                    'disabled',
                                ],
                            ) !!}
                        </div>

                        <!-- Start Date -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('start_date', 'Fecha inicial:') !!}
                            {!! Form::text('start_date', null, ['class' => 'form-control','id'=>'start_date', 'placeholder' => 'Seleccione la fecha inicial', 'disabled',]) !!}
                        </div>

                        <!-- End Date -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('end_date', 'Fecha final:') !!}
                            {!! Form::text('end_date', null, ['class' => 'form-control','id'=>'end_date', 'placeholder' => 'Seleccione la fecha final', 'disabled',]) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" style="color: white">Exportar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: white">Cancelar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
