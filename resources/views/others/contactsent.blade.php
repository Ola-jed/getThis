@extends('templates.base')

@section('title')
    Contact
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/contactsent.css') }}">
@endsection

@section('content')
    <x-menu></x-menu>
    <div class="hero-body response">
        <div class="box has-background-dark is-center has-text-white column is-4 is-offset-4 is-centered">
            Your message have been sent successfully
        </div>
    </div>
    <x-footer></x-footer>
@endsection