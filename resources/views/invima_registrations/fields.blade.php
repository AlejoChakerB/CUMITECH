<div class="form-group row">
    <!-- Health Register Field -->
    <div class="form-group col-sm-4">
       {!! Form::label('health_register', 'Registro sanitario:') !!}
       {!! Form::text('health_register', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el registro sanitario']) !!}
   </div>

   <!-- Generic name Field -->
   <div class="form-group col-sm-4">
        {!! Form::label('generic_name', 'Nombre generico:') !!}
        {!! Form::text('generic_name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre generico']) !!}
    </div>
</div>

<div class="form-group row">
    <!-- Tradename Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('tradename', 'Nombre comercial:') !!}
        {!! Form::text('tradename', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre comercial']) !!}
    </div>
    <!-- Pharmaceutical form Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('pharmaceutical_form', 'Forma farmaceutica:') !!}
        {!! Form::select('pharmaceutical_form', [
            'Aerosol' => 'Aerosol',
            'Ampolla' => 'Ampolla',
            'Caja' => 'Caja',
            'Capsula' => 'Capsula',
            'Comprimido' => 'Comprimido',
            'Crema topica' => 'Crema topica',
            'Emulsion' => 'Emulsion',
            'Frasco' => 'Frasco',
            'Frascos Vial' => 'Frascos Vial',
            'Gel topico' => 'Gel topico',
            'Gotas' => 'Gotas',
            'Granulados' => 'Granulados',
            'Inhalacion' => 'Inhalacion',
            'Jarabe' => 'Jarabe',
            'Lata' => 'Lata',
            'Liquida' => 'Liquida',
            'Mezclado' => 'Mezclado',
            'Otico' => 'Otico',
            'Ovulo' => 'Ovulo',
            'Parche termico' => 'Parche termico',
            'Polvo para suspension' => 'Polvo para suspension',
            'Polvo' => 'Polvo',
            'Polvo esteril' => 'Polvo esteril',
            'Polvo esteril para reconstituir' => 'Polvo esteril para reconstituir',
            'Polvo liofilizado' => 'Polvo liofilizado',
            'Polvo para reconstituir' => 'Polvo para reconstituir',
            'Polvo para solucion inyectable' => 'Polvo para solucion inyectable',
            'Pomada' => 'Pomada',
            'Pote' => 'Pote',
            'Solucion' => 'Solucion',
            'Solucion inyectable' => 'Solucion inyectable',
            'Solucion nasal' => 'Solucion nasal',
            'Solucion oftalmica' => 'Solucion oftalmica',
            'Solucion oral' => 'Solucion oral',
            'solucion para infusion' => 'solucion para infusion',
            'Solucion para inhalar' => 'Solucion para inhalar',
            'Solucion para nebulizar' => 'Solucion para nebulizar',
            'Solucion topica' => 'Solucion topica',
            'Suspension' => 'Suspension',
            'Suspension inyectable' => 'Suspension inyectable',
            'Suspension oral' => 'Suspension oral',
            'Suspensión rectal' => 'Suspensión rectal',
            'Tableta' => 'Tableta',
            'Unguento' => 'Unguento',
            'Unguento topico' => 'Unguento topico',
            'Vial' => 'Vial'
        ], null, ['class' => 'form-control custom-select text-secondary', 'placeholder' => 'Seleccione la forma farmaceutica', 'id' => 'pharmaceutical_form']) !!}

    </div>
</div>

<div class="form-group row">
    <!-- State invima Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('state_invima', 'Estado del registro:') !!}
        {!! Form::select('state_invima',[
            'Vigente' => 'Vigente',
            'En tramite' => 'En tramite',
            'No vigente' => 'No vigente'
        ], null, ['class' => 'form-control custom-select text-secondary', 'placeholder' => 'Seleccione el estado del registro']) !!}
    </div>

    <!-- Validity Registration Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('validity_registration', 'Fecha de vencimiento:') !!}
        {!! Form::text('validity_registration', null, ['class' => 'form-control','id'=>'registration', 'placeholder' => 'Ingrese la fecha de vencimiento']) !!}
    </div>
</div>

<div class="form-group row">
    <!-- Laboratory Manufacturer Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('laboratory_manufacturer', 'Laboratorio fabricante:') !!}
        {!! Form::text('laboratory_manufacturer', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el laboratorio fabricante']) !!}
    </div>
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#registration').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })

        $(document).ready(function() {
            $('#pharmaceutical_form').select2({
                placeholder: 'Seleccione la forma farmaceutica',
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