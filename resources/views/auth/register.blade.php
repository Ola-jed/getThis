@extends('templates.base')

@section('title')
    Register
@endsection

@section('content')
    <h1>Register</h1>
    <form action="{{ url('register') }}" method="POST">
        @csrf
        <label for="name">Username :</label><input type="text" name="name" id="name" value="{{ old('name') }}" required><br>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="email">Email :</label><input type="email" name="email" id="email" value="{{ old('email') }}" required><br>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="password1">Password :</label><input type="password" name="password1" id="password1" value="{{ old('password1') }}" required><br>
        @error('password1')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="password1">Confirm password :</label><input type="password" name="password2" id="password2" value="{{ old('password2') }}" required><br>
        @error('password2')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <button type="submit">Register</button>
    </form>
    <h2><a href="{{ url('/login') }}">Already registered ? Login</a></h2>
@endsection
