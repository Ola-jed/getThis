@extends('templates.base')

@section('title')
    Forgotten Password
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="hero-body">
        <form action="{{ url('forget-password') }}" method="post" class="box dark-bg-transparent is-center has-text-white column is-4 is-offset-4 is-centered">
            @csrf
            <h5 class="has-text-centered has-text-light is-white subtitle">Forgotten password</h5>
            <div class="field column">
                <label for="email" class="label has-text-white">Email</label>
                <p class="control has-icons-left has-icons-right">
                    <input class="input" id="email" name="email" type="email" value="{{ old('email') }}" required>
                    <span class="icon is-small is-left"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                </p>
                @error('email')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            @error('message')
                <div class="help is-danger">{{ $message }}</div>
            @enderror
            <div class="column">
                <button type="submit" class="button is-link is-outlined">Send reset link</button>
            </div>
            <hr>
            <div class="register">Not yet registered ? <a href="{{ url('/register') }}" class="is-link has-text-link-dark">Register</a></div>
            {{ $status ?? ''}}
        </form>
        @error('message')
            <div class="help is-danger error">{{ $message }}</div>
        @enderror
    </div>
@endsection
