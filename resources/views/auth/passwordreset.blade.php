@extends('templates.base')

@section('title')
    Password reset
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')


    <div class="login-box">
        <h2>Password reset</h2>
        <form action="{{ url('reset-password') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}" required>
            @error('token')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="user-box">
                <input type="email" name="email" required>
                <label>Email</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="user-box">
                <input type="password" name="password" required>
                <label>Password</label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="user-box">
                <input type="password" name="password_confirmation" required>
                <label>Confirm password</label>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <button type="submit">Reset</button>
            {{ $status ?? ''}}
        </form>
        @error('message')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
@endsection
