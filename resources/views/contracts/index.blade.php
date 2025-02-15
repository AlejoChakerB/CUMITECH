@extends('layouts.app')
@section('css')
<link href="{{ asset('css/table-cards.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content">
    <div class="container-fluid" style="padding: 0 0">
        <div class=" d-flex justify-content-between mb-5"
            style="background-color: transparent; padding: 0 0;">
            <h1 class="card-title m-0" style="font-size: 35px;">Contratos</h1>
        </div>
        <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
            <div class="mb-2">
                <a href="{{ route('get.contracts') }}" class="btn btn-default buttom-left" title="Actualizar contratos" id="syncButton">
                    <i data-feather="refresh-cw" stroke-width="1.5" width="20px" height="20px" id="loadContractBtn"></i><span>Sincronizar</span>
                </a>
            </div>
        
            <div class="d-flex flex-wrap justify-content-start">
                <form action="{{ route('contracts.index') }}" method="GET" class="d-flex mr-2 mb-2">
                    <div class="input-group mr-2" style="max-width: 100px;">
                        <div class="input-group-prepend">
                            <label class="input-group-text border-right-0 view pr-1" style="background-color: transparent;"><span><i class="fas fa-align-justify"></i></span></label>
                        </div>
                        <select class="custom-select border-left-0 input" id="perPageSelect" name="per_page" class="form-select" onchange="this.form.submit()">
                            <option value="10" {{ $contracts->perPage() == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $contracts->perPage() == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $contracts->perPage() == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $contracts->perPage() == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div>
                    <div class="input-group flex-grow-1 mr-2">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-default border-right-0 pr-1" type="submit" style="box-shadow: none; border-color: #CED4DA"><strong><span class="fas fa-search"></span></strong></button>
                        </div>
                        <input type="text" class="form-control border-left-0 input flex-grow-1" name="search" placeholder="Buscar empleado" style="outline: none; box-shadow: none">
                    </div>
                </form>
        
                <div class="mb-2">
                    @can('create_contracts')
                        <a href="{{ route('contracts.create') }}" class="btn btn-default" title="Agregar contracto" style="background-color: #2B3D63; color: white; position: relative;" id="btnAdd">
                            <div id="contentAdd" class="btn-content"><i class="fas fa-plus"></i> Añadir</div>
                        </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="border-0 mt-3">
            <div class="p-0">
                <div>
                    @include('contracts.table')
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mb-1 mt-2 footer-table">
            <!-- Muestra el número de página actual a la izquierda -->
            {{-- <div class="pagination-label">
                Página <strong>{{ $contracts->currentPage() }}</strong> de <strong>{{ $contracts->lastPage() }}</strong>
            </div> --}}
            <div></div>
            <!-- Muestra la paginación generada por Laravel a la derecha -->
            <div>
                {{ $contracts->appends(['search' => request('search'), 'per_page' => request('per_page')])->links() }}
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
</script>
@endsection
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