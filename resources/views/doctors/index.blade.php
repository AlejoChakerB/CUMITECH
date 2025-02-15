@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid" style="padding: 0 0">
        <div class=" d-flex justify-content-between mb-4"
            style="background-color: transparent; padding: 0 0;">
            <h3 class="card-title m-0" style="font-size: 35px; color: #2B3D63;">Contratación médicos</h3>
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
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary elevation-1 box-dolar"><i class="fas fa-hashtag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text title-card">Médicos generales</span>
                        <span class="info-box-number title-body">
                            {{ number_format($gen, 0, ',', '.'); }}
                        </span>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary elevation-1 box-dolar"><i class="fas fa-hashtag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text title-card">Especialistas</span>
                        <span class="info-box-number title-body">
                            {{ number_format($esp, 0, ',', '.'); }}
                        </span>
                    </div>

                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
            <div class="mb-2">
                @can('create_doctors')
                <a class="btn btn-default buttom-left" data-bs-toggle="modal" data-bs-target="#prefactura"
                title="Hacer prefactura">
                    <i data-feather="download" stroke-width="1.5"></i><span>Calcular prefactura</span>
                </a>
                <a href="{{ route('get.doctors') }}" class="btn btn-default buttom-left" title="Actualizar médicos" id="syncButton">
                    <i data-feather="refresh-cw" stroke-width="1.5" width="20px" height="20px" id="loadDoctostBtn"></i><span>Sincronizar médicos</span>
                </a>
                @endcan
            </div>
        
            <div class="d-flex flex-wrap justify-content-start">
                <form action="{{ route('doctors.index') }}" method="GET" class="d-flex mr-2 mb-2">
                    <div class="input-group mr-2" style="max-width: 100px;">
                        <div class="input-group-prepend">
                            <label class="input-group-text border-right-0 view pr-1" style="background-color: transparent;"><span><i class="fas fa-align-justify"></i></span></label>
                        </div>
                        <select class="custom-select border-left-0 input" id="perPageSelect" name="per_page" class="form-select" onchange="this.form.submit()">
                            <option value="10" {{ $doctors->perPage() == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $doctors->perPage() == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $doctors->perPage() == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $doctors->perPage() == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div>
                    <div class="input-group flex-grow-1 mr-2">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-default border-right-0 pr-1" type="submit" style="box-shadow: none; border-color: #CED4DA"><strong><span class="fas fa-search"></span></strong></button>
                        </div>
                        <input type="text" class="form-control border-left-0 input flex-grow-1" name="search" placeholder="Buscar médico" style="outline: none; box-shadow: none">
                    </div>
                </form>
        
                <div class="mb-2">
                    @can('create_doctors')
                        <a href="{{ route('doctors.create') }}" class="btn btn-default" title="Agregar procedimiento" style="background-color: #2B3D63; color: white; position: relative;" id="btnAdd">
                            <div id="contentAdd" class="btn-content"><i class="fas fa-plus"></i> Añadir</div>
                        </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card shadow-none border-0 mt-3">
            <div class="card-body p-0">
                <div class="card-panel">
                    @include('doctors.table')
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
        var loadarticlesBtn = document.getElementById('loadDoctostBtn');
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
<div class="modal fade" id="prefactura" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-default" style="background-color: #28a745; color: white">
                <h5 class="modal-title" id="staticBackdropLabel"><strong>Datos prefactura</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'python']) !!}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            {!! Form::label('code_doctor', 'Médico:') !!}
                            {!! Form::select('code_doctor', [], null, ['class' => 'form-control custom-select',
                            'placeholder' => '','id' => 'doctor']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('start_date', 'Fecha inicial:') !!}
                            {!! Form::text('start_date', null, ['class' => 'form-control','id'=>'start_date']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('end_date', 'Fecha final:') !!}
                            {!! Form::text('end_date', null, ['class' => 'form-control','id'=>'end_date']) !!}
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    {!! Form::submit('Guardar', ['class' => 'btn btn-success', 'style' => 'color: white']) !!}
                    <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancelar</a>
                    <a href="https://cumi1-my.sharepoint.com/:f:/g/personal/analistadedatos_cumi_com_co/EoP_r8b9m1dMn-DTccYbIyIBA5JmzS9KPHXomN5jSsvF1w?e=CVRalb" target="_blank" class="btn btn-primary"><i class="fas fa-cloud"></i> Carpeta</a>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@push('page_scripts')
<script type="text/javascript">
    $(document).ready(function() {
            $('#doctor').select2({
                dropdownParent: $('#prefactura .modal-body'),
                placeholder: 'Seleccione un médico',
                allowClear: true,
                width: '100%',
                theme: 'bootstrap4',
                ajax: {
                    url: '{{ route('search.doctor') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(doctors) {
                                return {
                                    id: doctors.code,
                                    text: doctors.full_name
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

        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })

        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
</script>
@endpush
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

    .select2-container {
        z-index: 1060;
        /* o cualquier otro valor alto que esté por debajo del modal */
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


