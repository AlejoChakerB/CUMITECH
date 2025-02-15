@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h4 class="card-title">Nuevo Role</h4>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.roles.store') }}">
                        @include('admin.roles.form')
                        <button class="btn btn-primary btn-block">Crear role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
