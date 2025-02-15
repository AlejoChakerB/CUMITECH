@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">

            </div>
        </div>
    </div>
</section>

<div class="content px-3">

    <div class="clearfix"></div>

    <div class="card shadow-none border-0">
        <div class="card-header" style="background-color: white; padding: 0 0;">
            <h3 class="card-title m-0" style="color: #69C5A0; font-size: 25px;"><strong>Carnets entregados</strong></h3>
            @can('create_cards')
            <a class="float-right btn btn-default" href="{{ route('cards.create') }}">
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
                    <table class="table table-hover shadow mb-5 rounded" id="cardTable">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Empleado</th>
                                <th>Fecha de entrega</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cards->sortBy('delivery_date_card') as $card)
                            <tr>
                                <td> <strong>{{ $card->id }}</strong></td>
                                <td>{{ $card->employe_id ? $card->employe->name : 'Sin ID'}}</td>
                                <td>{{ $card->delivery_date_card->format('Y-m-d') }}</td>
                                <td width="120">
                                    {!! Form::open(['route' => ['cards.destroy', $card->id], 'method' => 'delete', 'class' => "eliminarCardForm"]) !!}
                                    <div class='btn-group'>
                                        <a href="{{ route('cards.show', [$card->id]) }}" class='btn btn-default btn-xs'>
                                            <i class="far fa-eye" style="color: #13A4DA"></i>
                                        </a>
                                        <a href="{{ route('cards.edit', [$card->id]) }}" class='btn btn-default btn-xs'>
                                            <i class="far fa-edit" style="color: #6c6d77"></i>
                                        </a>
                                        {!! Form::button('<i class="far fa-trash-alt" style="color: #da1b1b"></i>', ['type'
                                        => 'submit', 'class' =>
                                        'btn
                                        btn-default btn-xs']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @section('js')
                    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
                    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

                    <script>
                        new DataTable('#cardTable', {
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

@endsection

<script>
    @if(session('pdfUrl'))
        var pdfUrl = '{{ session('pdfUrl') }}';
        window.open(pdfUrl, '_blank');
    @endif
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const eliminarUsuarioForms = document.querySelectorAll('.eliminarCardForm');
    
        eliminarUsuarioForms.forEach((form) => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Previene la acción por defecto del formulario
                const currentForm = this; // Obtén el formulario actual
    
                Swal.fire({
                    title: '¿Estás seguro de querer eliminar este registro?',
                    html: '<br><strong style= "color: red";>Esta acción afectara a la base de datos.</strong>',
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