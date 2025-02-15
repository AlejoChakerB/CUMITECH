@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="padding: 0 0">
        <div id="app">
            <pending-component :route='@json(asset(''))'
                :user='@json(Auth::id())'></pending-component>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </div>
@endsection
