<!-- Employe Id Field -->
<div class="form-group col-sm-5">
    {!! Form::label('dni', 'Identificacion:') !!}
    {!! Form::text('dni', null, ['class' => 'form-control', 'placeholder' => 'Digite la identificación']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-5">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Digite el nombre']) !!}
</div>

<!-- Work Position Field -->
<div class="form-group col-sm-5">
    {!! Form::label('work_position', 'Cargo:') !!}
    {!! Form::select('work_position', 
        [
            'ADMINISTRADORA DE OBRA TORRE 2' => 'ADMINISTRADORA DE OBRA TORRE 2',
            'ANALISTA DE DATOS' => 'ANALISTA DE DATOS',
            'ASISTENTE CONTABLE' => 'ASISTENTE CONTABLE',
            'ASISTENTE CONTABLE TORRE 2' => 'ASISTENTE CONTABLE TORRE 2',
            'AUDITOR MEDICO' => 'AUDITOR MEDICO',
            'AUXILIAR ADMINISTRATIVO GENERAL' => 'AUXILIAR ADMINISTRATIVO GENERAL',
            'AUXILIAR BIOMEDICO' => 'AUXILIAR BIOMEDICO',
            'AUXILIAR CLINICO' => 'AUXILIAR CLINICO',
            'AUXILIAR DE ADMISIONES' => 'AUXILIAR DE ADMISIONES',
            'AUXILIAR DE AUTORIZACIONES' => 'AUXILIAR DE AUTORIZACIONES',
            'AUXILIAR DE COMPRAS Y SUMINISTROS' => 'AUXILIAR DE COMPRAS Y SUMINISTROS',
            'AUXILIAR DE CUENTAS MEDICAS' => 'AUXILIAR DE CUENTAS MEDICAS',
            'AUXILIAR DE ENFERMERIA' => 'AUXILIAR DE ENFERMERIA',
            'AUXILIAR DE FACTURACION' => 'AUXILIAR DE FACTURACION',
            'AUXILIAR DE FARMACIA' => 'AUXILIAR DE FARMACIA',
            'AUXILIAR DE GESTION DOCUMENTAL' => 'AUXILIAR DE GESTION DOCUMENTAL',
            'AUXILIAR DE MANTENIMIENTO E INFRAESTRUCTURA - ELECTRICISTA' => 'AUXILIAR DE MANTENIMIENTO E INFRAESTRUCTURA - ELECTRICISTA',
            'AUXILIAR DE RADICACION' => 'AUXILIAR DE RADICACION',
            'AUXILIAR DE ROPA INTRAHOSPITALARIA' => 'AUXILIAR DE ROPA INTRAHOSPITALARIA',
            'AUXILIAR DE SERVICIOS GENERALES' => 'AUXILIAR DE SERVICIOS GENERALES',
            'AUXILIAR DE SISTEMAS' => 'AUXILIAR DE SISTEMAS',
            'AUXILIAR DE TALENTO HUMANO' => 'AUXILIAR DE TALENTO HUMANO',
            'AUXILIAR MANTENIMIENTO E INFRAESTRUCTURA' => 'AUXILIAR MANTENIMIENTO E INFRAESTRUCTURA',
            'COMUNICADORA ORGANIZACIONAL' => 'COMUNICADORA ORGANIZACIONAL',
            'CONTADOR' => 'CONTADOR',
            'COORDINADOR DE CALIDAD' => 'COORDINADOR DE CALIDAD',
            'COORDINADOR DE CIRUGIA' => 'COORDINADOR DE CIRUGIA',
            'COORDINADOR DE CONSULTA EXTERNA' => 'COORDINADOR DE CONSULTA EXTERNA',
            'COORDINADORA DE COMPRAS TORRE 2' => 'COORDINADORA DE COMPRAS TORRE 2',
            'COORDINADOR DE FACTURACION' => 'COORDINADOR DE FACTURACION',
            'COORDINADOR DE HOSPITALIZACION' => 'COORDINADOR DE HOSPITALIZACION',
            'COORDINADOR DE IMAGENOLOGIA' => 'COORDINADOR DE IMAGENOLOGIA',
            'COORDINADOR DE INFRAESTRUCTURA Y MANTENIMIENTO' => 'COORDINADOR DE INFRAESTRUCTURA Y MANTENIMIENTO',
            'COORDINADOR DE SISTEMA' => 'COORDINADOR DE SISTEMA',
            'COORDINADOR DE URGENCIAS' => 'COORDINADOR DE URGENCIAS',
            'COORDINADOR GENERAL DE ENFERMERÍA' => 'COORDINADOR GENERAL DE ENFERMERÍA',
            'COORDINADOR UCI' => 'COORDINADOR UCI',
            'COORDINADORA SIAU' => 'COORDINADORA SIAU',
            'DIRECTOR SERVICIOS FARMACEUTICOS' => 'DIRECTOR SERVICIOS FARMACEUTICOS',
            'DIRECTORA ADMINISTRATIVA Y FINANCIERA' => 'DIRECTORA ADMINISTRATIVA Y FINANCIERA',
            'DIRECTORA DE GESTION HUMANA' => 'DIRECTORA DE GESTION HUMANA',
            'ENFERMERA AUDITORA DE CUENTAS MEDICAS' => 'ENFERMERA AUDITORA DE CUENTAS MEDICAS',
            'ENFERMERA LÍDER DE CIRUGÍA' => 'ENFERMERA LÍDER DE CIRUGÍA',
            'ENFERMERO (A) JEFE' => 'ENFERMERO (A) JEFE',
            'ENFERMERO LÍDER DE URGENCIAS' => 'ENFERMERO LÍDER DE URGENCIAS',
            'FISIOTERAPEUTA' => 'FISIOTERAPEUTA',
            'FISIOTERAPEUTA REHABILITADORA CARDIACA' => 'FISIOTERAPEUTA REHABILITADORA CARDIACA',
            'GERENTE GENERAL' => 'GERENTE GENERAL',
            'GERENTE MEDICO' => 'GERENTE MEDICO',
            'GESTOR QUIRURGICO' => 'GESTOR QUIRURGICO',
            'INGENIERA DE PROCESOS/CIRUGIA' => 'INGENIERA DE PROCESOS/CIRUGIA',
            'INGENIERO BIOMEDICO' => 'INGENIERO BIOMEDICO',
            'INGENIERO DE PROCESOS' => 'INGENIERO DE PROCESOS',
            'INGENIERO DE SOPORTE' => 'INGENIERO DE SOPORTE',
            'INSTRUMENTADOR QUIRURGICO' => 'INSTRUMENTADOR QUIRURGICO',
            'INSTRUMENTADOR QUIRURGICO LÍDER DE CENTRAL DE ESTERILIZACIÓN' => 'INSTRUMENTADOR QUIRURGICO LÍDER DE CENTRAL DE ESTERILIZACIÓN',
            'LIDER DE CONVENIOS ESPECIALES' => 'LIDER DE CONVENIOS ESPECIALES',
            'MEDICO ESPECIALISTA' => 'MEDICO ESPECIALISTA',
            'MEDICO ESPECIALISTA INTERNISTA' => 'MEDICO ESPECIALISTA INTERNISTA',
            'MEDICO ESPECIALISTA UROLOGÍA' => 'MEDICO ESPECIALISTA UROLOGÍA',
            'MEDICO GENERAL' => 'MEDICO GENERAL',
            'MEDICO RURAL' => 'MEDICO RURAL',
            'NUTRICIONISTA' => 'NUTRICIONISTA',
            'ORIENTADOR' => 'ORIENTADOR',
            'PROFESIONAL DE CARTERA' => 'PROFESIONAL DE CARTERA',
            'PROFESIONAL DE COSTOS Y PRESUPUETOS' => 'PROFESIONAL DE COSTOS Y PRESUPUETOS',
            'PROFESIONAL DE GESTIÓN  RIESGO Y CONTROL INTERNO' => 'PROFESIONAL DE GESTIÓN  RIESGO Y CONTROL INTERNO',
            'PROFESIONAL DE NOMINA' => 'PROFESIONAL DE NOMINA',
            'PROFESIONAL DE SALUD Y SEGURIDAD EN EL TRABAJO' => 'PROFESIONAL DE SALUD Y SEGURIDAD EN EL TRABAJO',
            'PROFESIONAL EN COMPRAS Y SUMINISTROS' => 'PROFESIONAL EN COMPRAS Y SUMINISTROS',
            'PROFESIONAL LOGISTICA' => 'PROFESIONAL LOGISTICA',
            'PSICÓLOGO CLINICO' => 'PSICÓLOGO CLINICO',
            'PSICÓLOGO ORGANIZACIONAL' => 'PSICÓLOGO ORGANIZACIONAL',
            'QUIMICO FARMACEUTICO' => 'QUIMICO FARMACEUTICO',
            'QUIMICO FARMACEUTICO - CLINICO' => 'QUIMICO FARMACEUTICO - CLINICO',
            'REFERENTE DE SEGURIDAD DEL PACIENTE' => 'REFERENTE DE SEGURIDAD DEL PACIENTE',
            'REGENTE DE FARMACIA' => 'REGENTE DE FARMACIA',
            'SECRETARIO GENERAL' => 'SECRETARIO GENERAL',
            'SUPERVISOR TECNICO EN REFRIGERACION' => 'SUPERVISOR TECNICO EN REFRIGERACION',
            'TECNICO EN IMÁGENES DIAGNOSTICA' => 'TECNICO EN IMÁGENES DIAGNOSTICA',
            'TECNICO EN REFRIGERACIÓN' => 'TECNICO EN REFRIGERACIÓN',
            'TECNOLOGO DE IMAGENES DIAGNOSTICAS' => 'TECNOLOGO DE IMAGENES DIAGNOSTICAS',
            'TESORERO/CARTERA' => 'TESORERO/CARTERA',
            'TRABAJADORA SOCIAL' => 'TRABAJADORA SOCIAL',
            'TRANSCRIPTORA' => 'TRANSCRIPTORA'
        ], null, ['class' => 'form-control custom-select', 'placeholder' => 'Seleccione un cargo' ,'id' => 'work_position']) !!}
</div>

<!-- Unit Field -->
<div class="form-group col-sm-5">
    {!! Form::label('unit', 'Unidad:') !!}
    {!! Form::select('unit', 
        [
            'Administrativo' => 'Administrativo', 
            'Administrativo asistencial' => 'Administrativo asistencial', 
            'Asistencial' => 'Asistencial',
            'Otros' => 'Otros'
        ], null, ['class' => 'form-control custom-select text-secondary', 'placeholder' => 'Seleccione la unidad']) !!}
</div>

<!-- Cost center Field -->
<div class="form-group col-sm-5">
    {!! Form::label('cost_center', 'Centro de costo:') !!}
    {!! Form::select('cost_center', 
        [
            'ADMINISTRACION' => 'ADMINISTRACION',
            'AYUDAS DIAGNOSTICAS' => 'AYUDAS DIAGNOSTICAS',
            'CIRUGIA' =>  'CIRUGIA',
            'FARMACIA'  => 'FARMACIA',
            'CONSULTA EXTERNA'  => 'CONSULTA EXTERNA',
            'HEMODINAMIA ' => 'HEMODINAMIA ',
            'HOSPITALIZACION' => 'HOSPITALIZACION',
            'UCI' => 'UCI',
            'URGENCIAS' => 'URGENCIAS',
            'VARIOS' => 'VARIOS'
        ], null, ['class' => 'form-control custom-select text-secondary', 'placeholder' => 'Seleccione el centro de costo']) !!}
</div>

<!-- Cost center Field -->
<div class="form-group col-sm-5">
    {!! Form::label('service', 'Servicio:') !!}
    {!! Form::select('service', 
        [
            'ADMINISTRACION' => 'ADMINISTRACION',
            'ADMISION Y FACTURACION' => 'ADMISION Y FACTURACION',
            'ASAMBLEA GENERAL Y JUNTA DIRECTIVA' => 'ASAMBLEA GENERAL Y JUNTA DIRECTIVA',      
            'ASEO' => 'ASEO',
            'CALIDAD' => 'CALIDAD',
            'CENTRAL DE ESTERILIZACION' => 'CENTRAL DE ESTERILIZACION',
            'CIRUGIA' => 'CIRUGIA',
            'COMPRAS' => 'COMPRAS',            
            'CONSULTA EXTERNA' => 'CONSULTA EXTERNA',                        
            'CONTABILIDAD' => 'CONTABILIDAD',
            'CONTRATACION' => 'CONTRATACION',                       
            'COSTO Y PRESUPUESTO' => 'COSTO Y PRESUPUESTO',                     
            'ECOCARDIOGRAMA' => 'ECOCARDIOGRAMA',                
            'ECOGRAFIA' => 'ECOGRAFIA',                     
            'ENDOSCOPIAS' => 'ENDOSCOPIAS',                          
            'FARMACIA' => 'FARMACIA',                        
            'FINANZAS' => 'FINANZAS',
            'HEMODINAMIA' => 'HEMODINAMIA',                           
            'HOSPITALIZACION PISO 10' => 'HOSPITALIZACION PISO 10',     
            'HOSPITALIZACION PISO 11' => 'HOSPITALIZACION PISO 11',
            'HOSPITALIZACION PISO 7' => 'HOSPITALIZACION PISO 7',            
            'HOSPITALIZACION PISO 8' => 'HOSPITALIZACION PISO 8',             
            'HOSPITALIZACION PISO 9' => 'HOSPITALIZACION PISO 9',
            'HOSPITALIZACION PISO 3 T2' => 'HOSPITALIZACION PISO 3 T2',
            'HOSPITALIZACION PISO 4 T2' => 'HOSPITALIZACION PISO 4 T2',           
            'MAMOGRAFIAS' => 'MAMOGRAFIAS',             
            'MANTENIMIENTO (BIOMEDICO)' => 'MANTENIMIENTO (BIOMEDICO)',   
            'MANTENIMIENTO (INFRAESTRUCTURA)' => 'MANTENIMIENTO (INFRAESTRUCTURA)',   
            'PISO 8 UCI INTERMEDIO' => 'PISO 8 UCI INTERMEDIO',
            'RESONANCIA' => 'RESONANCIA',                              
            'SEGURIDAD DEL PACIENTE' => 'SEGURIDAD DEL PACIENTE',                  
            'SIAU' => 'SIAU',                                    
            'SISTEMAS' => 'SISTEMAS',
            'TALENTO HUMANO' => 'TALENTO HUMANO',                  
            'TESORERIA' => 'TESORERIA',
            'TOMOGRAFIA' => 'TOMOGRAFIA',                              
            'UCI PISO 5' => 'UCI PISO 5',                              
            'UCI PISO 6' => 'UCI PISO 6',                              
            'URGENCIAS' => 'URGENCIAS'
        ], null, ['class' => 'form-control custom-select text-secondary', 'placeholder' => 'Seleccione el centro de costo','id' => 'service']) !!}
</div>


@push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#work_position').select2({
                placeholder: 'Seleccione un cargo',
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
            $('#service').select2({
                placeholder: 'Seleccione un servicio',
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
@endpush