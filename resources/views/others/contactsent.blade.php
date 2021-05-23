@extends('templates.base')

@section('title')
    Contact
@endsection

@include('components.menu')

@section('content')
    <div class="hero-body">
        <div class="box has-background-dark is-center has-text-white column is-4 is-offset-4 is-centered">
            Your message have been sent successfully
        </div>
    </div>
@endsection

@include('components.footer')
