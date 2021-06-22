@extends('templates.base')

@section('title')
    Login
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="hero-body">
        <form action="{{ url('login') }}" method="post" class="box has-background-dark is-center has-text-white column is-4 is-offset-4 is-centered">
            @csrf
            <h5 class="has-text-centered has-text-light is-white title is-5">Login</h5>
            <div class="field column is-two-thirds">
                <label for="email" class="label has-text-white">Email</label>
                <input type="email" name="email" class="input is-primary" placeholder="user@mail.com" value="{{ old('email') }}" required>
                @error('email')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field column is-two-thirds">
                <label for="password" class="label has-text-white">Password</label>
                <input type="password" name="password" class="input is-primary" placeholder="*****" value="{{ old('password') }}" required>
                @error('password')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="control column">
                <button type="submit" class="button is-link is-outlined">Login</button>
            </div>
            <div class="other">Or login with</div>
            <div class="other-login ">
                <a href="{{ url('/login/google') }}" class="google-login">
                    <img src="{{ asset('images/google-color.svg') }}" alt="">
                </a>
                <a href="{{ url('/login/github') }}" class="github-login">
                    <img src="{{ asset('images/github.svg') }}" alt="">
                </a>
            </div>
            <div class="columns">
                <div class="column register has-text-link"><a href="{{ url('/register') }}">Register</a></div>
                <div class="column register has-text-link"><a href="{{ url('/forget-password') }}">Forgotten password ?</a></div>
            </div>
            @if($errors->has('message'))
                <div class="help is-danger error">{{ $errors->first('message') }}</div>
            @endif
        </form>
    </div>
@endsection
