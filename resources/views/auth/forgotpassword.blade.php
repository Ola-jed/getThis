@extends('templates.base')

@section('title')
    Forgotten Password
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="login-box">
        <h2>Password reset link</h2>
        <form action="{{ url('forget-password') }}" method="post">
            @csrf
            <div class="user-box">
                <input type="email" name="email" required>
                <label>Email</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <button type="submit">Send reset link</button>
            <div class="register"><a href="{{ url('/register') }}">Not yet registered ? Register</a></div>
            {{ $status ?? ''}}
        </form>
        @error('message')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
@endsection
