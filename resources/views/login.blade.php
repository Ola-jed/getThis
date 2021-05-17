@extends('templates.formbase')

@section('title')
    Login
@endsection

@section('action-form')
    {{ url('/login') }}
@endsection

@section('head')
    <h1>Login</h1>
@endsection

@section('form-content')
    <label for="email">Email :</label><input type="email" name="email" id="email" required><br>
    <label for="password">Password :</label><input type="password" name="password" id="password" required><br>
    <button type="submit">Login</button>
@endsection

@section('foot')
    <h3><a href="{{ url('/login/google') }}" class="google-login">Login with google</a></h3>
    <h3><a href="{{ url('/login/github') }}" class="github-login">Login with github</a></h3>
    <h2><a href="{{ url('/register') }}">Not yet registered ? Register</a></h2>
@endsection
