@extends('layouts.app')

@section('content')
<section class="content-header">
</section>

<div class="content px-3">
    <div class="container-fluid">
        <div class="card shadow-none border-0">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: white; padding: 0 0;">
                <h3 class="card-title m-0" style="color: #69C5A0; font-size: 25px;"><strong>Empleados
                        disponibles</strong></h3>
                <div class="ml-auto d-flex align-items-center gap-2">
                    <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#exportModal" title="Exportar empleados faltantes por dotación">
                        <span class="fas fa-file-export" style="color: #69C5A0"></span>
                    </button>
                    @can('create_endowments')
                    <a href="{{ route('endowments.create') }}" class="btn btn-default" title="Agregar entrega de dotación">
                        <span class="fas fa-plus" style="color: #69C5A0"></span>
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body p-0">
                <form action="{{ route('endowments.index') }}" method="GET"
                    class="d-flex justify-content-between align-items-center">
                    <!-- Selector de registros por página (Mostrar) a la izquierda -->
                    <div class="form-group mb-3 mt-2">
                        <label for="perPageSelect" class="mr-2" style="color: #69C5A0">Mostrar:</label>
                        <select id="perPageSelect" name="per_page" class="form-select" style="border-radius: 20px"
                            onchange="this.form.submit()">
                            <option value="10" {{ $contracts->perPage() == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $contracts->perPage() == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $contracts->perPage() == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $contracts->perPage() == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div>

                    <!-- Botón de búsqueda (Buscar) a la derecha -->
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button class="btn btn-default" type="submit"
                                    style="border-radius: 20px; color: #69C5A0"><strong>Buscar</strong></button>
                            </div>
                            <input type="text" class="form-control" name="search" placeholder="Buscar empleado"
                                style="border-radius: 20px;">
                        </div>
                    </div>
                </form>
                <div class="card-panel">
                    @include('endowments.table')
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    @if(session('pdfUrl'))
        var pdfUrl = '{{ session('pdfUrl') }}';
        window.open(pdfUrl, '_blank');
    @endif
</script>
</div>

<!-- Modal -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seleccione el periodo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('export') }}" method="post" style="margin-bottom: 0;">
            <div class="modal-body">
                    @csrf
                    <div class="form-group col-sm-5 mb-4" style="padding: 0 0">
                        <select id="year" name="year" class="custom-select">
                            @for ($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-success" type="radio" id="Abril" name="period" value="Abril"/>
                        <label class="custom-control-label" for="Abril">Abril</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-primary" type="radio" id="Agosto" name="period" value="Agosto">
                        <label class="custom-control-label" for="Agosto">Agosto</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-warning" type="radio" id="Diciembre" name="period" value="Diciembre"/>
                        <label class="custom-control-label" for="Diciembre">Diciembre</label>
                    </div>                                       
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Exportar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
