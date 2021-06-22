@extends('templates.base')

@section('title')
    Forgotten Password
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="hero-body">
        <form action="{{ url('forget-password') }}" method="post" class="box has-background-dark is-center has-text-white column is-5 is-offset-4 is-centered">
            @csrf
            <h2 class="subtitle has-text-white has-text-centered">Forgotten password</h2>
            <div class="field">
                <label for="email" class="label has-text-white">Email</label>
                <input type="email" name="email" class="input is-primary" value="{{ old('email') }}" required>
                @error('email')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            @error('message')
                <div class="help is-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="button is-link is-outlined">Send reset link</button>
            <div class="register"><a href="{{ url('/register') }}">Not yet registered ? Register</a></div>
            {{ $status ?? ''}}
        </form>
        @error('message')
            <div class="help is-danger error">{{ $message }}</div>
        @enderror
    </div>
@endsection
