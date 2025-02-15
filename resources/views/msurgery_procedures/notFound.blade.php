@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row m-t-40">
        </div>
    </div>
</section>

<div class="content px-3">

    <div class="clearfix"></div>

    <div class="card shadow-none border-0">
        <div class="card-header" style="background-color: white; padding: 0 0;">
            <h3 class="card-title m-0" style="color: #69C5A0; font-size: 25px;"><strong>Procedimientos sin homologar</strong></h3>
            @can('create_endowments')
            <a class="float-right btn btn-default" href="{{ route('msurgeryProcedures.create') }}">
                <span class="fas fa-plus" style="color: #69C5A0"></span>
            </a>
            @endcan
        </div>
        <div class="card-body p-0">
            <div class="card-panel">
                @section('css')
                <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
                @endsection
                <div class="table-responsive">
                    <table class="table table-hover shadow mb-3 rounded" id="endowmenTable">
                        <thead>
                        <tr>
                            <th># servicio</th>
                            <th>Tipo</th>
                            <th>Procedimiento</th>
                            <th>UVR</th>
                            <th>Observacion</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($msurgeryProcedures as $msurgeryProcedure)
                            <tr>
                                <td>{{ $msurgeryProcedure->cod_surgical_act }}</td>
                                <td>
                                    @php
                                        $code = $msurgeryProcedure->code_procedure ?? null;
                                        $manualType = $msurgeryProcedure->procedures->manual_type ?? null;
                                    @endphp
            
                                    @if($manualType == 256)
                                        <span class="badge text-black" style="background-color:#A3BF18;">ISS</span>
                                    @elseif($manualType == "SOAT") 
                                        <span class="badge text-white" style="background-color:#00B0EB;">{{ $manualType }}</span>
                                    @else
                                        <span class="badge text-white" style="background-color:#da1b1b;">{{ $manualType }}</span>  
                                    @endif
                                </td>
                                <td>{{ $msurgeryProcedure->code_procedure ? $msurgeryProcedure->procedures->description : 'Sin ID' }}
                                    <br>
                                    <small><strong style="color: #69C5A0">{{ $msurgeryProcedure->type }}</strong></small>
                                </td>
                                <td>{{ $msurgeryProcedure->code_procedure ? $msurgeryProcedure->procedures->uvr : 'Sin ID' }}</td>
                                <td>{{ $msurgeryProcedure->observation}}</td>
                                <td width="120">
                                    {!! Form::open(['route' => ['msurgeryProcedures.destroy', $msurgeryProcedure->id], 'method' => 'delete']) !!}
                                    <div class='btn-group'>
                                        <a href="{{ route('msurgeryProcedures.show', [$msurgeryProcedure->id]) }}"
                                        class='btn btn-default btn-xs'>
                                            <i class="far fa-eye" style="color: #13A4DA"></i>
                                        </a>
                                        <a href="{{ route('msurgeryProcedures.edit', [$msurgeryProcedure->id]) }}"
                                        class='btn btn-default btn-xs'>
                                            <i class="far fa-edit" style="color: #6c6d77"></i>
                                        </a>
                                        {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @section('js')
                    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
                    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
                    <script>
                        new DataTable('#endowmenTable', {
                            language: {
                                search: '<Strong style="color: #69C5A0">Buscar</Strong>',
                                info: '<strong>Página</strong> <strong>_PAGE_</strong> <strong>de</strong> <strong>_PAGES_</strong>',
                                lengthMenu: '<strong style="color: #69C5A0">Mostrar _MENU_</Strong>',
                                infoEmpty: '',
                                infoFiltered: 'Filtrado de _MAX_ registros totales',
                                zeroRecords: 'No se encontraron resultados',
                                paginate: {
                                    previous: 'Anterior',
                                    next: 'Siguiente'
                                }
                            }
                        });
                    </script>
                    @endsection
                </div>                
            </div>
        </div>

    </div>
    <div id="app">
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @include('layouts.alerts')
</div>

@endsection

<script>
    @if(session('pdfUrl'))
        var pdfUrl = '{{ session('pdfUrl') }}';
        window.open(pdfUrl, '_blank');
    @endif
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const eliminarUsuarioForms = document.querySelectorAll('.eliminarEndowmentForm');
    
        eliminarUsuarioForms.forEach((form) => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Previene la acción por defecto del formulario
                const currentForm = this; // Obtén el formulario actual
    
                Swal.fire({
                    title: '¿Estás seguro de querer eliminar este registro?',
                    html: '<br><strong style= "color: red";>Esta acción afectará a la base de datos.</strong>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        title: 'custom-title', // Clase personalizada para el título
                        content: 'custom-content', // Clase personalizada para el contenido
                        icon: 'custom-icon' // Clase personalizada para el icono
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // El usuario confirmó la eliminación, envía el formulario actual
                        currentForm.submit();
                    }
                });
            });
        });
    });
</script>

<style>
    .custom-title {
        color: #14ABE3;
        /* Cambia el color del título a rojo */
    }

    .custom-icon::before {
        color: #cf33ff;
        /* Cambia el color del icono a rojo */
    }

    .pagination .page-item.active .page-link {
        background-color: #69C5A0;
        border-color: #69C5A0;
        color: white;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 10px;
        margin-top: 10px;
        margin-right: 4px;
    }

    .dataTables_length select {
        border-radius: 10px;
        margin-top: 10px;
    }
</style>