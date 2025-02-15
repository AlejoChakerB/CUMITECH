@extends('layouts.app')

@section('content')

<div class="content px-3">
    <div class="container-fluid">
        <div class="card shadow-none border-0">
            <div class="card-header d-flex justify-content-between align-items-center" style="padding: 0 0;">
                <h4 class="card-title m-0" style="color: #69C5A0; font-size: 25px;"><strong>Lista de usuarios</strong></h4>
                <div class="ml-auto">
                    @can('create_user')
                    <a href="{{ route('admin.users.create') }}" class="btn btn-deafult" title="Crear usuario">
                        <span class="fas fa-user-plus" style="color: #69C5A0"></span>
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body p-0">
                <div class="card-panel">
                    @include('admin.users.table')
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