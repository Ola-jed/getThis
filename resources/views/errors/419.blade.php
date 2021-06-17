@extends('templates.base')

@section('title')
    Page expired
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/419.css') }}">
@endsection

@section('content')
    @include('components.menu')
    <div class="hero-body has-text-white center">
        419 | Page expired
    </div>
    @include('components.footer')
@endsection