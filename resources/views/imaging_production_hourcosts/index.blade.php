@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid" style="padding: 0 0">
            <div class=" d-flex justify-content-between mb-5" style="background-color: transparent; padding: 0 0;">
                <h3 class="card-title m-0" style="font-size: 35px; color: #2B3D63;">Costo sala imagenes</h3>
            </div>
            <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                <div class="mb-2">
                    @can('reportbi_imaging')
                        <a href="" class="btn btn-default buttom-left" title="Mirar reporte">
                            <i data-feather="bar-chart" stroke-width="2" width="20px" height="20px"
                                id="loadContractBtn"></i><span>Reporte PowerBi</span>
                        </a>
                    @endcan
                </div>

                <div class="d-flex flex-wrap justify-content-start">
                    <form action="{{ route('imagingProductionHourcosts.index') }}" method="GET" class="d-flex mr-2 mb-2">
                        <div class="input-group mr-2" style="max-width: 100px;">
                            <div class="input-group-prepend">
                                <label class="input-group-text border-right-0 view pr-1"
                                    style="background-color: transparent;"><span><i
                                            class="fas fa-align-justify"></i></span></label>
                            </div>
                            <select class="custom-select border-left-0 input" id="perPageSelect" name="per_page"
                                class="form-select" onchange="this.form.submit()">
                                <option value="10" {{ $imagingProductionHourcosts->perPage() == 10 ? 'selected' : '' }}>
                                    10</option>
                                <option value="25" {{ $imagingProductionHourcosts->perPage() == 25 ? 'selected' : '' }}>
                                    25</option>
                                <option value="50" {{ $imagingProductionHourcosts->perPage() == 50 ? 'selected' : '' }}>
                                    50</option>
                                <option value="100"
                                    {{ $imagingProductionHourcosts->perPage() == 100 ? 'selected' : '' }}>100
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
                        @can('create_imagingProductionHourcosts')
                            <a href="{{ route('imagingProductionHourcosts.create') }}" class="btn btn-default"
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
                        @include('imaging_production_hourcosts.table')
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
    </style>
    <script>
        feather.replace();
    </script>
@endsection
