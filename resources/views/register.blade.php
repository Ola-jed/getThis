@extends('templates.formbase')

@section('title')
    Register
@endsection

@section('action-form')
    {{ url('/signin') }}
@endsection

@section('head')
    <h1>Register</h1>
@endsection

@section('form-content')
    <label for="name">Username :</label><input type="text" name="name" id="name" required><br>
    <label for="email">Email :</label><input type="email" name="email" id="email" required><br>
    <label for="password1">Password :</label><input type="password" name="password1" id="password1" required><br>
    <label for="password1">Confirm password :</label><input type="password" name="password2" id="password2" required><br>
    <button type="submit">Register</button>
@endsection

@section('foot')
    <h2><a href="{{ url('/login') }}">Already registered ? Login</a></h2>
@endsection
