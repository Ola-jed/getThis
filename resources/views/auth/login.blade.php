@extends('templates.base')

@section('title')
    Login
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="hero-body">
        <form action="{{ url('login') }}" method="post" class="box dark-bg-transparent has-text-white column is-4 is-offset-4">
            @csrf
            <h5 class="has-text-centered has-text-light is-white title is-3">Login</h5>
            <div class="field column">
                <label for="email" class="label has-text-white">Email</label>
                <p class="control has-icons-left has-icons-right">
                    <input class="input" id="email" name="email" type="email" placeholder="Email" value="{{ old('email') }}" required>
                    <span class="icon is-small is-left"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                </p>
                @error('email')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field column">
                <label for="password" class="label has-text-white">Password</label>
                <p class="control has-icons-left">
                    <input class="input" type="password" id="password" name="password" placeholder="*****" value="{{ old('password') }}" required>
                    <span class="icon is-small is-left"><i class="fas fa-lock" aria-hidden="true"></i></span>
                </p>
                @error('password')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field column has-text-white">
                <label class="checkbox">
                    <input type="checkbox" name="remember-me">
                    Remember me
                </label>
            </div>
            <div class="line">
                <button type="submit" class="button is-link is-outlined is-one-third">Login</button>
                <div class="column is-narrow"><a href="{{ url('/forget-password') }}" class="is-link has-text-link-dark">Forgotten password ?</a></div>
            </div>
            <div class="social">
                <a href="{{ url('/login/google') }}" class="google-login">
                    <img src="{{ asset('images/google-color.svg') }}" alt="Google">
                </a>
                <a href="{{ url('/login/github') }}" class="github-login">
                    <img src="{{ asset('images/github.svg') }}" alt="Github">
                </a>
            </div>
            <hr>
            <div class="column has-text-centered has-text-white">
                Not registered yet ? <a href="{{ url('/register') }}" class="is-link has-text-link-dark">Sign up</a>
            </div>
            @if($errors->has('message'))
                <div class="help is-danger error">{{ $errors->first('message') }}</div>
            @endif
        </form>
    </div>
@endsection