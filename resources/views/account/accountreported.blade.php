@extends('templates.base')

@section('title')
    User reported
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/contactsent.css') }}">
@endsection

@section('content')
    @include('components.menu')
    <div class="hero-body response">
        <div class="box has-background-dark is-center has-text-white column is-4 is-offset-4 is-centered">
            Your report have been sent. <br>
            We will do an analysis to see if the user has actually violated any rules of the platform
        </div>
    </div>
    @include('components.footer')
@endsection
