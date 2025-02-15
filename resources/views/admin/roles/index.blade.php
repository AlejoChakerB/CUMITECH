@extends('layouts.app')

@section('title', 'Roles')

@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Lista de roles</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Roles</li>
        </ol>
    </div>
</div>


<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Listado de Roles</h4>
                <h6 class="card-subtitle">Las opciones pueden variar segun el rol de su cuenta</h6>
                 @can('roles')
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary pull-right">
                        <i class="fa fa-plus-circle"></i>  Nuevo Role
                    </a>
                 @endcan
                
                @include('admin.roles.table')

            </div>
        </div>
    </div>
</div>
@endsection




