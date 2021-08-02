@extends('templates.base')

@section('title')
    Not found
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/404.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/404.js') }}" defer></script>
@endsection

@section('content')
    <x-menu></x-menu>
    <div class="hero-body">
        <div class="box has-background-dark is-center has-text-white column is-4 is-offset-4 is-centered">
            <p class="not-found">404 - Not found</p>
            <p class="title has-text-white is-centered has-text-weight-semibold whack">Whack-a-mole!</p>
            <div class="buttons">
                <span class="score has-background-black button has-text-white">0</span>
                <button onClick="startGame()" class="button is-link is-outlined">Start!</button>
            </div>
            <div class="game">
                <div class="hole hole1">
                    <div class="mole"></div>
                </div>
                <div class="hole hole2">
                    <div class="mole"></div>
                </div>
                <div class="hole hole3">
                    <div class="mole"></div>
                </div>
                <div class="hole hole4">
                    <div class="mole"></div>
                </div>
                <div class="hole hole5">
                    <div class="mole"></div>
                </div>
                <div class="hole hole6">
                    <div class="mole"></div>
                </div>
            </div>
            <p>
                <a href="{{ route('index') }}" class="is-link has-text-link-dark">Go back to home</a>
            </p>
        </div>
    </div>
    <x-footer></x-footer>
@endsection