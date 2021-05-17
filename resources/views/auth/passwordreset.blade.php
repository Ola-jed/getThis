@extends('templates.base')

@section('title')
    Password reset
@endsection

@section('content')
    <h1>Password reset</h1>
    <form action="{{ url('reset-password') }}" method="post">
        @csrf
        <label for="email">Email :</label><input type="email" name="email" id="email" value="{{ old('email') }}" required><br>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="password">Password :</label><input type="password" name="password" id="password" value="{{ old('password') }}" required><br>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="password_confirmation">Confirm password :</label><input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" required><br>
        @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <input type="hidden" name="token" value="{{ $token }}" readonly required>
        <button type="submit">Reset</button>
    </form>
    @error('message')
    {{ $message }}
    @enderror
    {{ $status ?? ''}}
    <h2><a href="{{ url('/register') }}">Not yet registered ? Register</a></h2>
@endsection
