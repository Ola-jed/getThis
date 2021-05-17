@extends('templates.base')

@section('title')
    Login
@endsection

@section('content')
    <h1>Login</h1>
    <form action="{{ url('login') }}" method="post">
        @csrf
        <label for="email">Email :</label><input type="email" name="email" id="email" value="{{ old('email') }}" required><br>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="password">Password :</label><input type="password" name="password" id="password" value="{{ old('password') }}" required><br>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <button type="submit">Login</button>
    </form>
    @error('message')
        {{ $message }}
    @enderror
    <h3><a href="{{ url('/login/google') }}" class="google-login">Login with google</a></h3>
    <h3><a href="{{ url('/login/github') }}" class="github-login">Login with github</a></h3>
    <h2><a href="{{ url('/register') }}">Not yet registered ? Register</a></h2>
@endsection
