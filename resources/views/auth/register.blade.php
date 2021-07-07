@extends('templates.base')

@section('title')
    Register
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/formPage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/register.js') }}" defer></script>
@endsection

@section('content')
    <div class="hero-body">
        <form action="{{ url('register') }}" method="post" class="box dark-bg-transparent is-center has-text-white column is-4 is-offset-4 is-centered">
            @csrf
            <h5 class="has-text-centered has-text-light is-white title is-3">Register</h5>
            <div class="field column">
                <label for="name" class="label has-text-white">Username</label>
                <p class="control has-icons-left has-icons-right">
                    <input type="text" class="input is-primary" name="name" placeholder="Name" maxlength="25" value="{{ old('name') }}" required>
                    <span class="icon is-small is-left"><i class="fas fa-user" aria-hidden="true"></i></span>
                </p>
                @error('name')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field column">
                <label for="email" class="label has-text-white">Email</label>
                <p class="control has-icons-left has-icons-right">
                    <input class="input" name="email" type="email" placeholder="Email" value="{{ old('email') }}" required>
                    <span class="icon is-small is-left"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                </p>
                @error('email')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field column">
                <label for="password1" class="label has-text-white">Password</label>
                <p class="control has-icons-left">
                    <input class="input" type="password" name="password1" placeholder="*****" value="{{ old('password1') }}" required>
                    <span class="icon is-small is-left"><i class="fas fa-lock" aria-hidden="true"></i></span>
                </p>
                @error('password1')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field column">
                <label for="password2" class="label has-text-white">Confirm password</label>
                <p class="control has-icons-left">
                    <input type="password" name="password2" class="input is-primary" placeholder="*****" value="{{ old('password2') }}" id="p2" required>
                    <span class="icon is-small is-left"><i class="fas fa-lock" aria-hidden="true"></i></span>
                </p>
                @error('password2')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field column">
                <button type="submit" class="button is-link is-outlined">Register</button>
            </div>
            <div class="column has-text-centered has-text-white">
                Already registered ? <a href="{{ url('/login') }}" class="is-link has-text-link-dark">Sign in</a>
            </div>
            @if($errors->has('message'))
                <div class="help is-danger error">{{ $errors->first('message') }}</div>
            @endif
        </form>
    </div>
@endsection
