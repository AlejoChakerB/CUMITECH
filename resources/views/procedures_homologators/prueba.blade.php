@extends('layouts.app')
@section('content')

@php
    $asset = asset('');
@endphp
<div id="app">
    <resportsbi-menu :asset='@json($asset)'></resportsbi-menu>
</div>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
