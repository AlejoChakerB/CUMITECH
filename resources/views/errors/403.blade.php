@extends('errors::minimal')

@section('title', __('Sin acceso'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
