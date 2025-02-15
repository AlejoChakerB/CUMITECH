<!-- Stand Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stand', 'Stand:') !!}
    {!! Form::select('stand', [
        'Biomedico' => 'Biomedico',
        'calidad' => 'Calidad',
        'comunicaciones' => 'Comunicaciones',
        'control_infecciones' => 'Control infecciones',
        'coorgeneral_enfer' => 'Coordinacion general de enfermeria',
        'farmacia' => 'Farmacia',
        'gestion_riesgo_sarlaft' => 'Gestión de riesgo SARLAFT',
        'gestion_ambiental' => 'Gestión ambiental',
        'humanizacion' => 'Humanizacion',
        'Mantenimiento' => 'Mantenimiento',
        'seg_paciente' => 'Seguridad del paciente',
        'sst_th' => 'Seguridad y salud en el trabajo',
        'Sistemas' => 'Sistemas',
        'Siau' => 'siau',
        'vigilancia_epidemiologica' => 'Vigilancia epidemiologica'
    ], null, ['class' => 'form-control custom-select', 'placeholder' => '', 'id' => 'stand_id']) !!}
</div>


<!-- Id Users Employees Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_users_employees', 'Empleado:') !!}
    {!! Form::select('id_users_employees', $userEmploye, null, ['class' => 'form-control custom-select', 'placeholder' => '', 'id' => 'employe_id']) !!}
</div>

<script>
    $(document).ready(function() {
            $('#employe_id').select2({
                placeholder: 'Seleccione un empleado',
                allowClear: true,
                width: '100%',
                theme: 'bootstrap4',
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

        $(document).ready(function() {
            $('#stand_id').select2({
                placeholder: 'Seleccione un stand',
                allowClear: true,
                width: '100%',
                theme: 'bootstrap4',
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