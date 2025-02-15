@extends('layouts.app')

@section('content')
<!-- Item Field -->
<div id="app">
    <viewer-component :route='@json(asset(''))' :user='@json(Auth::id())'></viewer-component>
</div>

<script src="{{ asset('js/app.js') }}"></script>
@endsection

