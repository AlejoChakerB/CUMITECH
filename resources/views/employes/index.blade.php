@extends('layouts.app')

@section('content')
<div class="content px-3 mt-2">
    <div class="container-fluid">
        <div class="card shadow-none border-0">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: white; padding: 0 0;">
                <h3 class="card-title m-0" style="color: #69C5A0; font-size: 25px;"><strong>Empleados
                        disponibles</strong></h3>
                <div class="ml-auto d-flex align-items-center gap-2">
                    @can('create_employes')
                    <a href="{{ route('employes.create') }}" class="btn btn-default" title="Agregar empleado">
                        <span class="fas fa-user-plus" style="color: #69C5A0"></span>
                    </a>
                    <a data-bs-toggle="modal" data-bs-target="#importar" class="btn btn-default" title="Importar empleado">
                        <span class="fas fa-file-import" style="color: #69C5A0"></span>
                    </a>
                    <a href="{{ route('get.employee') }}" id="loadEmployesBtn" class="btn btn-default" title="Actualizar empleados">
                        <span class="fas fa-sync-alt" style="color: #69C5A0"></span>
                    </a>
                    <a href="{{ route('update.employee') }}" id="loadDisableBtn" class="btn btn-default" title="Deshabilitar empleados">
                        <span class="fas fa-ban" style="color: #da1b1b"></span>
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body p-0">
                <form action="{{ route('employes.index') }}" method="GET"
                    class="d-flex justify-content-between align-items-center">
                    <!-- Selector de registros por página (Mostrar) a la izquierda -->
                    <div class="form-group mb-3 mt-2">
                        <label for="perPageSelect" class="mr-2" style="color: #69C5A0">Mostrar:</label>
                        <select id="perPageSelect" name="per_page" class="form-select" style="border-radius: 20px"
                            onchange="this.form.submit()">
                            <option value="10" {{ $employes->perPage() == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $employes->perPage() == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $employes->perPage() == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $employes->perPage() == 100 ? 'selected' : '' }}>100</option>
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
                    @include('employes.table')
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
        <form action="{{ route('importEmployees') }}" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="inputGroupFile01"
                            aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01" data-browse="Buscar">Seleccionar un
                            archivo...</label>
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
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var loadarticlesBtn = document.getElementById('loadEmployesBtn');

        loadarticlesBtn.addEventListener('click', function() {
            // Añade la clase 'loading' al botón cuando se hace clic
            loadarticlesBtn.classList.add('loading');

            // Simula la carga asincrónica
            setTimeout(function() {
                
                loadarticlesBtn.classList.remove('loading');
            }, 2000); 
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var loadarticlesBtn = document.getElementById('loadDisableBtn');

        loadarticlesBtn.addEventListener('click', function() {
            // Añade la clase 'loading' al botón cuando se hace clic
            loadarticlesBtn.classList.add('loading');

            // Simula la carga asincrónica
            setTimeout(function() {
                
                loadarticlesBtn.classList.remove('loading');
            }, 2000); 
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

    .fade-out {
        animation: fadeOut 0.5s forwards;
    }

    .translate-right {
        animation: translateRight 0.5s forwards;
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }

    @keyframes translateRight {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(50px); /* Cambia la distancia según necesites */
        }
    }
</style>