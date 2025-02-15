@extends('layouts.app')

@section('content')
<div class="content px-3">
    <div class="container-fluid">
        @include('flash::message')
        <div class="card shadow-none border-0">
            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: white; padding: 0 0;">
                <h3 class="card-title m-0" style="color: #69C5A0; font-size: 25px;"><strong>Calendarios</strong></h3>
                <div class="ml-auto">
                    @can('create_calendars')
                    <a href="{{ route('calendars.create') }}" class="btn btn-default" title="Crear calendario">
                        <span class="fas fa-calendar-plus" style="color: #69C5A0"></span>
                    </a>
                    @endcan
                    <a class="btn btn-default" data-bs-toggle="modal" data-bs-target="#importar" title="Importar calendarios">
                        <span class="fas fa-file-import" style="color: #69C5A0"></span>
                    </a>
                    <a href="{{ route('calendars.generate') }}" class="btn btn-default" title="Actualizar calendarios">
                        <span class="fas fa-redo-alt" style="color: #69C5A0"></span>
                    </a>
                </div>
            </div>
            <div class="card-body p-0">

                <form action="{{ route('calendars.index') }}" method="GET" class="d-flex justify-content-between align-items-center">
                    <!-- Selector de registros por página (Mostrar) a la izquierda -->
                    <div class="form-group mb-3 mt-2">
                        <label for="perPageSelect" class="mr-2" style="color: #69C5A0">Mostrar:</label>
                        <select id="perPageSelect" name="per_page" class="form-select" style="border-radius: 20px" onchange="this.form.submit()">
                            <option value="10" {{ $calendars->perPage() == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $calendars->perPage() == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $calendars->perPage() == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $calendars->perPage() == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div>
                    
                    <!-- Botón de búsqueda (Buscar) a la derecha -->
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button class="btn btn-default" type="submit" style="border-radius: 20px; color: #69C5A0"><strong>Buscar</strong></button>
                            </div>
                            <input type="text" class="form-control" name="search" placeholder="Buscar empleado" style="border-radius: 20px;">
                        </div>
                    </div>
                </form>

                <div class="card-panel">
                    @include('calendars.table')
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="importar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h5 class="modal-title" id="staticBackdropLabel"><strong>Importar archivo excel</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => ['import'], 'method' => 'post', 'class' => 'row
                col-sm-12
                mt-4'])
                !!}
                <div class="row">
                    <div class="form-group col-sm-6">
                        {!! Form::file('file', null, ['class' => 'form-control','id'=>'file'
                        ,'name'=>'file', 'placeholder'=>'file']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <button class="btn btn-default" type="submit" style="background-color: #69C5A0; color: white"><strong>Importar</strong></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@push('page_scripts')
<script type="text/javascript">
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
@endsection