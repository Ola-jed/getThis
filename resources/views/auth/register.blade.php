@extends('templates.base')

@section('title')
    Register
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="login-box">
        <h2>Register</h2>
        <form action="{{ url('register') }}" method="post">
            @csrf
            <div class="user-box">
                <input type="name" name="name" required>
                <label>Username</label>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="user-box">
                <input type="email" name="email" required>
                <label>Email</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="user-box">
                <input type="password" name="password1" required>
                <label>Password</label>
                @error('password1')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="user-box">
                <input type="password" name="password2" required>
                <label>Confirm password</label>
                @error('password2')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Register</button>
            <div class="register"><a href="{{ url('/login') }}">Already registered ? Login</a></div>
        </form>
        @error('message')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
@endsection
