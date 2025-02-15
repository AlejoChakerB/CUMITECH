@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid" style="padding: 0 0">
        <div class=" d-flex justify-content-between mb-1"
            style="background-color: transparent; padding: 0 0;">
            <h3 class="card-title m-0" style="font-size: 35px; color: #2B3D63;">Tarifas diferenciales</h3>
        </div>
        {{-- CARDS --}}
        <div class="row">
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary elevation-1 box-dolar"><i class="fas fa-hashtag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text title-card">Cantidad total</span>
                        <span class="info-box-number title-body">
                            {{ number_format($total, 0, ',', '.'); }}
                        </span>
                    </div>

                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center flex-wrap mt-1">
            <div class="mb-2">
                @can('create_procedure')
                <a class="btn btn-default buttom-left" data-bs-toggle="modal" data-bs-target="#importar" title="Importar tarifas">
                    <i data-feather="upload" stroke-width="1.5"></i><span>Importar</span>
                </a>
                @endcan
            </div>
        
            <div class="d-flex flex-wrap justify-content-start">
                <form action="{{ route('diferentialRates.index') }}" method="GET" class="d-flex mr-2 mb-2">
                    <div class="input-group mr-2" style="max-width: 100px;">
                        <div class="input-group-prepend">
                            <label class="input-group-text border-right-0 view pr-1" style="background-color: transparent;"><span><i class="fas fa-align-justify"></i></span></label>
                        </div>
                        <select class="custom-select border-left-0 input" id="perPageSelect" name="per_page" class="form-select" onchange="this.form.submit()">
                            <option value="10" {{ $diferentialRates->perPage() == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $diferentialRates->perPage() == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $diferentialRates->perPage() == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $diferentialRates->perPage() == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div>
                    <div class="input-group flex-grow-1 mr-2">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-default border-right-0 pr-1" type="submit" style="box-shadow: none; border-color: #CED4DA"><strong><span class="fas fa-search"></span></strong></button>
                        </div>
                        <input type="text" class="form-control border-left-0 input flex-grow-1" name="search" placeholder="Buscar tarifa diferencial" style="outline: none; box-shadow: none">
                    </div>
                </form>
        
                <div class="mb-2">
                    @can('create_diferentialRates')
                        <a href="{{ route('diferentialRates.create') }}" class="btn btn-default" title="Agregar procedimiento" style="background-color: #2B3D63; color: white; position: relative;" id="btnAdd">
                            <div id="contentAdd" class="btn-content"><i class="fas fa-plus"></i> Añadir</div>
                        </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card shadow-none border-0 mt-3">
            <div class="card-body p-0">
                <div class="card-panel">
                    @include('diferential_rates.table')
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
    document.addEventListener('DOMContentLoaded', function() {
        var loadarticlesBtn = document.getElementById('loadProceduresBtn');
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
<!-- Modal -->
<div class="modal fade" id="importar" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #28a745; color: white">
                <h5 class="modal-title" id="staticBackdropLabel">Importar archivo excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
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
                    <a href="{{ route('download.rates') }}" class="btn btn-default buttom-left"
                    title="Calcular tarifas" id="syncButton">
                        <i class="fas fa-file-excel" style="color: green"></i><span>descargar plantilla</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
{{-- 
<!-- Modal -->
<div class="modal fade" id="importar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h5 class="modal-title" id="staticBackdropLabel"><strong>Importar archivo excel</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="file">
                    <!-- Resto de tus campos del formulario -->
                    <button type="submit" class="send">Cargar</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}
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



{{-- @extends('layouts.app')

@section('content')
<div class="content px-3 mt-2">
    <div class="container-fluid">
        <div class="card shadow-none border-0">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: white; padding: 0 0;">
                <h3 class="card-title m-0" style="color: #69C5A0; font-size: 25px;"><strong>Tarifas
                        diferenciales</strong></h3>
                <div class="ml-auto d-flex align-items-center gap-2">
                    @can('create_diferentialRates')
                    <a class="btn btn-default" data-bs-toggle="modal" data-bs-target="#importar" title="Importar tarifas">
                        <span class="fas fa-file-import" style="color: #69C5A0"></span>
                    </a>
                    <a href="{{ route('diferentialRates.create') }}" class="btn btn-default" title="Agregar empleado">
                        <span class="fas fa-plus" style="color: #69C5A0"></span>
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body p-0">
                <form action="{{ route('diferentialRates.index') }}" method="GET"
                    class="d-flex justify-content-between align-items-center">
                    <!-- Selector de registros por página (Mostrar) a la izquierda -->
                    <div class="form-group mb-3 mt-2">
                        <label for="perPageSelect" class="mr-2" style="color: #69C5A0">Mostrar:</label>
                        <select id="perPageSelect" name="per_page" class="form-select" style="border-radius: 20px"
                            onchange="this.form.submit()">
                            <option value="10" {{ $diferentialRates->perPage() == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $diferentialRates->perPage() == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $diferentialRates->perPage() == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $diferentialRates->perPage() == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div>

                    <!-- Botón de búsqueda (Buscar) a la derecha -->
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button class="btn btn-default" type="submit"
                                    style="border-radius: 20px; color: #69C5A0"><strong>Buscar</strong></button>
                            </div>
                            <input type="text" class="form-control" name="search" placeholder="Buscar empleado"
                                style="border-radius: 20px;">
                        </div>
                    </div>
                </form>

                <div class="card-panel">
                    @include('diferential_rates.table')
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
<div class="modal fade" id="importar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h5 class="modal-title" id="staticBackdropLabel"><strong>Importar archivo excel</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="file">
                    <!-- Resto de tus campos del formulario -->
                    <button type="submit" class="send">Cargar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .send{
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
@endsection

 --}}