@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid" style="padding: 0 0">
            <div id="app">
                <qr-scan :route='@json(asset(''))' :user='@json(Auth::id())'></qr-scan>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
@endsection
