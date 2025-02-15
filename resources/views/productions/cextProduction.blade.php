@extends('layouts.app')

@section('content')
    <div>
        @can('export_productions_cext')
            <a class="btn btn-default buttom-left-export" data-bs-toggle="modal" data-bs-target="#export" title="Importar tarifas">
                <i data-feather="download" stroke-width="2" width="20px" height="20px" id="loadContractBtn"></i><span>Exportar
                    excel</span>
            </a>
        @endcan
        <div id="app">
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </div>
    <div class="mt-3">
        <iframe title="COSTOS ESTANCIAS" width="100%" height="900px"
            src="https://app.powerbi.com/view?r=eyJrIjoiZDA1M2M3NGEtNGJhMC00YTkzLTllZWYtNTYzOTg2Mzg1MzA5IiwidCI6Ijk4NGRkMTg1LWM4MDMtNGRhMS05NzRmLTcxZTQwYzc0ZWNjZCJ9"
            frameborder="0" allowFullScreen="true"></iframe>
    </div>

    <style>
        iframe {
            border-radius: 10px;
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

    <!-- Modal -->
    <div class="modal fade" id="export" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #28a745; color: white">
                    <h5 class="modal-title" id="staticBackdropLabel">Importar archivo excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {!! Form::open(['route' => 'exportAccomodation', 'id' => 'myForm']) !!}
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
                            {!! Form::label('cost_center', 'Centro de costos:') !!}
                            {!! Form::select('cost_center', [], null, [
                                'class' => 'form-control custom-select',
                                'id' => 'cost_center',
                                'placeholder' => 'Digite el centro de costos',
                                'disabled',
                            ]) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('service', 'Servicios:') !!}
                            {!! Form::select('service', [], null, [
                                'class' => 'form-control custom-select',
                                'id' => 'service',
                                'placeholder' => 'Digite el servicio',
                                'disabled',
                            ]) !!}
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
    <script>
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
    </script>
@endsection
