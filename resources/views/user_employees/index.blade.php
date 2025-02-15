@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid" style="padding: 0 0">
        <div class=" d-flex justify-content-between mb-5"
            style="background-color: transparent; padding: 0 0;">
            <h3 class="card-title m-0" style="font-size: 35px; color: #2B3D63;">Usuarios - empleados</h3>
        </div>
        {{-- CARDS --}}
        {{--
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
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-hashtag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text title-card">Cantidad ISS</span>
                        <span class="info-box-number title-body">
                            {{ number_format($ISS, 0, ',', '.'); }}
                        </span>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-hashtag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text title-card">Cantidad SOAT</span>
                        <span class="info-box-number title-body">
                            {{ number_format($SOAT, 0, ',', '.'); }}
                        </span>
                    </div>
                </div>
            </div>
            --}}
        </div>
        <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
            <div class="mb-2">
                @can('create_userEmployees')
                    <a href="{{ route('get.createUsers') }}" class="btn btn-default buttom-left" title="Sincronizar procedimientos" id="syncButton">
                        <i data-feather="refresh-cw" stroke-width="1.5" width="20px" height="20px" id="loadProceduresBtn"></i><span>Sincronizar</span>
                    </a>
                @endcan
            </div>
        
            <div class="d-flex flex-wrap justify-content-start">
                <form action="{{ route('userEmployees.index') }}" method="GET" class="d-flex mr-2 mb-2">
                    <div class="input-group mr-2" style="max-width: 100px;">
                        <div class="input-group-prepend">
                            <label class="input-group-text border-right-0 view pr-1" style="background-color: transparent;"><span><i class="fas fa-align-justify"></i></span></label>
                        </div>
                        <select class="custom-select border-left-0 input" id="perPageSelect" name="per_page" class="form-select" onchange="this.form.submit()">
                            <option value="10" >10</option>
                            <option value="25" >25</option>
                            <option value="50" >50</option>
                            <option value="100" >100</option>
                            <option value="1000" >1000</option>
                        </select>
                    </div>
                    <div class="input-group flex-grow-1 mr-2">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-default border-right-0 pr-1" type="submit" style="box-shadow: none; border-color: #CED4DA"><strong><span class="fas fa-search"></span></strong></button>
                        </div>
                        <input type="text" class="form-control border-left-0 input flex-grow-1" name="search" placeholder="Buscar usuario" style="outline: none; box-shadow: none">
                    </div>
                </form>
        
                <div class="mb-2">
                    @can('create_userEmployees')
                        <a href="{{ route('userEmployees.create') }}" class="btn btn-default" title="Agregar procedimiento" style="background-color: #2B3D63; color: white; position: relative;" id="btnAdd">
                            <div id="contentAdd" class="btn-content"><i class="fas fa-plus"></i> Añadir</div>
                        </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card shadow-none border-0 mt-3">
            <div class="card-body p-0">
                <div class="card-panel">
                    @include('user_employees.table')
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
