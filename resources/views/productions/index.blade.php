@extends('layouts.app')
@section('content')
    <div class="row mb-5">
        <div class="mb-12 mt-2" style="color: #2B3D63;">
            <h1>Producciones</h1>
        </div>
    </div>
    <div id="app">
        <production-menu :image-src='{{ json_encode(asset('/images/icons/cifras.png')) }}'
            :image-src2='{{ json_encode(asset('/images/icons/cifras2.png')) }}'
            :image-src3='{{ json_encode(asset('/images/icons/cifras3.png')) }}'
            :image-src4='{{ json_encode(asset('/images/icons/cifras4.png')) }}'
            :service-Route='{{ json_encode(route('accommodationCosts.service')) }}'
            :imaging-Route='{{ json_encode(asset('imagingProduction')) }}'
            :surgery-Route='{{ json_encode(asset('surgeryProduction')) }}'
            :urgency-Route='{{ json_encode(asset('urgencyProduction')) }}'
            :endoscopy.Route='{{ json_encode(asset('endoscopyProduction')) }}'
            :utriocumi.Route='{{ json_encode(asset('utriocumiProduction')) }}'
            :cext-Route='{{ json_encode(asset('cextProduction')) }}'></production-menu>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <style>
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

        //Select2 especialidad
        $(document).ready(function() {
            $('#cost_center').select2({
                dropdownParent: $('#export .modal-body'),
                placeholder: 'Seleccione una especialidad',
                allowClear: true,
                width: '100%',
                theme: 'bootstrap4',
                ajax: {
                    url: '{{ route('search.searchAccommodationCostCenter') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(costCenter) {
                                return {
                                    id: costCenter.cost_center,
                                    text: costCenter.cost_center
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

        //Select2 especialidad
        $(document).ready(function() {
            $('#service').select2({
                dropdownParent: $('#export .modal-body'),
                placeholder: 'Seleccione una especialidad',
                allowClear: true,
                width: '100%',
                theme: 'bootstrap4',
                ajax: {
                    url: '{{ route('search.searchAccommodationService') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(service) {
                                return {
                                    id: service.service,
                                    text: service.service
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
    </script>
@endsection
