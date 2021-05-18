@extends('templates.base')

@section('title')
    Contact
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@include('components.menu')

@section('content')
    <div class="login-box">
        Your message have been sent successfully
    </div>
@endsection

@include('components.footer')
