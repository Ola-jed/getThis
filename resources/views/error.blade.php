@extends('templates.base')

@section('title')
    Error
@endsection

@section('content')
    <main class="hero-body">
        <div class="is-danger is-center has-text-white column is-4 is-offset-4 is-centered has-text-centered">
            {{ $message }}
        </div>
        <a href="{{ url('/login') }}" class="has-text-link-light">Return to login page</a>
    </main>
@endsection
