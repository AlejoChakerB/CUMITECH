@extends('layouts.app')

@section('content')
<div class="content px-3">
    <div class="container-fluid">
        <div class="card shadow-none border-0">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: white; padding: 0 0;">
                <h4 class="card-title m-0" style="color: #69C5A0; font-size: 25px;"><strong>Lista de asistencias</strong></h4>
                <div class="ml-auto">
                    @can('create_attendances')
                    <a href="{{ route('attendances.create') }}" class="btn btn-default" title="Agregar asistencia">
                        <span class="fas fa-plus" style="color: #69C5A0"></span>
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body p-0">
                <div class="card-panel">
                    <form action="{{ route('attendances.index') }}" method="GET" class="d-flex justify-content-between align-items-center">
                        <!-- Selector de registros por página (Mostrar) a la izquierda -->
                        <div class="form-group mb-0 mt-2">
                            <label for="perPageSelect" class="mr-2" style="color: #69C5A0">Mostrar:</label>
                            <select id="perPageSelect" name="per_page" class="form-select" style="border-radius: 20px" onchange="this.form.submit()">
                                <option value="10" {{ $attendances->perPage() == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $attendances->perPage() == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $attendances->perPage() == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $attendances->perPage() == 100 ? 'selected' : '' }}>100</option>
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
                </div>
                @include('attendances.table')
            </div>
        </div>
    </div>
</div>
@endsection
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