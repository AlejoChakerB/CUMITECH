<!-- Salary Field -->
<div class="form-group col-sm-6">
    {!! Form::label('salary', 'Salario:') !!}
    {!! Form::number('salary', null, ['class' => 'form-control']) !!}
</div>

<!-- Start Date Contract Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_date_contract', 'Fecha de inicio de contrato:') !!}
    {!! Form::text('start_date_contract', null, ['class' => 'form-control','id'=>'start_date_contract']) !!}
</div>

<!-- Disable -->
<div class="form-group col-sm-6">
    {!! Form::label('disable', 'Deshabilitado:') !!}
    {!! Form::text('disable', null, ['class' => 'form-control']) !!}
</div>

<!-- Employe Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('employe_id', 'Empleado:') !!}
        <strong>
            {!! Form::select('employe_id', $employes, null, ['class' => 'form-control custom-select', 'placeholder' => 'Seleccione un empleado' ,'id' => 'employe_id']) !!}
        </strong>
    </div>

@push('page_scripts')
    <script type="text/javascript">
        $('#start_date_contract').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })

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
    </script>
@endpush