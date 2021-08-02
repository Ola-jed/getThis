@extends('templates.base')

@section('title')
    Page expired
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/419.css') }}">
@endsection

@section('content')
    <x-menu></x-menu>
    <div class="hero-body has-text-white center">
        419 | Page expired
    </div>
    <x-footer></x-footer>
@endsection