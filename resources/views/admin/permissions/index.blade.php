@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Lista de permisos</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Permisos</li>
            </ol>
        </div>
    </div>


    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.permissions.table')
                </div>
            </div>
        </div>
    </div>

@endsection
