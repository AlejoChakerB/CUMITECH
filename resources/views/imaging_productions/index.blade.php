@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid" style="padding: 0 0">
        <div class=" d-flex justify-content-between mb-5" style="background-color: transparent; padding: 0 0;">
            <h3 class="card-title m-0" style="font-size: 35px;">Produccion imagenologia</h3>
        </div>
        <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
            <div class="mb-2">
                <a data-bs-toggle="modal" data-bs-target="#importar" class="btn btn-default buttom-left"
                    title="Importar producción" id="syncButton">
                    <i data-feather="upload" stroke-width="1.5"></i><span>Importar</span>
                </a>
            </div>

            <div class="d-flex flex-wrap justify-content-start">
                <form action="{{ route('imagingProductions.index') }}" method="GET" class="d-flex mr-2 mb-2">
                    <div class="input-group mr-2" style="max-width: 100px;">
                        <div class="input-group-prepend">
                            <label class="input-group-text border-right-0 view pr-1"
                                style="background-color: transparent;"><span><i
                                        class="fas fa-align-justify"></i></span></label>
                        </div>
                        <select class="custom-select border-left-0 input" id="perPageSelect" name="per_page"
                            class="form-select" onchange="this.form.submit()">
                            <option value="10" {{ $imagingProductions->perPage() == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $imagingProductions->perPage() == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $imagingProductions->perPage() == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $imagingProductions->perPage() == 100 ? 'selected' : '' }}>100
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
                            placeholder="Buscar cups" style="outline: none; box-shadow: none">
                    </div>
                </form>

                <div class="mb-2">
                    @can('calculate_cost')
                    <a href="{{ route('imagingProductions.create') }}" class="btn btn-default" title="Agregar contracto"
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
                    @include('imaging_productions.table')
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
<div class="modal fade" id="importar" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #28a745; color: white">
                <h5 class="modal-title" id="staticBackdropLabel">Importar archivo excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('importImagingProductions') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01" data-browse="Buscar">Seleccionar un archivo...</label>
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
</style>
<script>
    feather.replace();
</script>
@endsection