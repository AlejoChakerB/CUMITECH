@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid" style="padding: 0 0">
            <div class=" d-flex justify-content-between mb-5" style="background-color: transparent; padding: 0 0;">
                <h3 class="card-title m-0" style="font-size: 35px; color: #2B3D63">Costo hora consulta externa</h3>
            </div>
            <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                <div class="mb-2">
                    @can('create_cextHourcosts')
                        <a href="{{ route('cextHourcosts.create') }}" class="btn btn-default" title="Agregar contracto"
                            style="background-color: #2B3D63; color: white; position: relative;" id="btnAdd">
                            <div id="contentAdd" class="btn-content"><i class="fas fa-plus"></i> Añadir</div>
                        </a>
                    @endcan
                    @can('update_cextHourcosts')
                        <a href="{{ route('cextHourcosts.editHour') }}" class="btn btn-default buttom-edit"
                            title="Mirar reporte">
                            <i data-feather="edit" stroke-width="2" width="20px" height="20px"
                                id="loadContractBtn"></i><span>Modificar</span>
                        </a>
                    @endcan
                    @can('destroy_cextHourcosts')
                        <a href="" class="btn btn-default buttom-delete" title="Mirar reporte">
                            <i data-feather="trash-2" stroke-width="2" width="20px" height="20px"
                                id="loadContractBtn"></i><span>Eliminar</span>
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card shadow-none border-0 mt-3">
                <div class="card-body p-0">
                    <div class="card-panel">
                        @include('cext_hourcosts.table')
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

        .buttom-edit {
            background-color: #6C6D77;
            color: white;
            box-shadow: 0px 2px 4px rgba(43, 61, 99, 0.3);
            font-size: 15px;
        }

        .buttom-edit:hover {
            background-color: #595a66;
            color: white;
            box-shadow: 0px 4px 8px rgba(43, 61, 99, 0.2);
            /* Cambiar la sombra cuando se pasa el mouse sobre el botón */
        }

        .buttom-edit span {
            margin-left: 10px;
        }

        .buttom-delete {
            background-color: #E21B1B;
            color: white;
            box-shadow: 0px 2px 4px rgba(43, 61, 99, 0.3);
            font-size: 15px;
        }

        .buttom-delete:hover {
            background-color: #f52020;
            color: white;
            box-shadow: 0px 4px 8px rgba(43, 61, 99, 0.2);
            /* Cambiar la sombra cuando se pasa el mouse sobre el botón */
        }

        .buttom-delete span {
            margin-left: 10px;
        }
    </style>
    <script>
        feather.replace();
    </script>
@endsection
