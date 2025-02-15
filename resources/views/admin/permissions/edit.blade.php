@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Editar Permisos</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">Permisos</a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                @include('common.errors')
                <div class="card-body">
                    <h4 class="card-title">Actualizar Permisos</h4>
                    <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
                        {{ method_field('PUT') }} {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Identificador:</label>
                            <input disabled
                                value="{{ $permission->name }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="display_name">Nombre:</label>
                            <input name="display_name"
                                value="{{ old('display_name', $permission->display_name) }}"
                                class="form-control">
                        </div>
                        <button class="btn btn-primary btn-block">Actualizar permiso</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
