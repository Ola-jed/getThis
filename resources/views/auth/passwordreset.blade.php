@extends('templates.base')

@section('title')
    Password reset
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="hero-body">
        <form action="{{ url('reset-password') }}" method="post" class="box has-background-dark is-center has-text-white column is-5 is-offset-4 is-centered">
            @csrf
            <h2 class="subtitle has-text-white has-text-centered">Password reset</h2>
            <input type="hidden" name="token" value="{{ $token }}" required>
            @error('token')
                <div class="help is-danger">{{ $message }}</div>
            @enderror
            <div class="field">
                <label class="label has-text-white" for="email">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="input is-primary" required>
                @error('email')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field">
                <label class="label has-text-white" for="password">Password</label>
                <input type="password" name="password" class="input is-primary" value="{{ old('password') }}" required>
                @error('password')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field">
                <label class="label has-text-white" for="password_confirmation">Confirm password</label>
                <input type="password" name="password_confirmation" class="input is-primary" value="{{ old('password_confirm') }}" required>
                @error('password_confirmation')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            @error('message')
                <div class="help is-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="button is-link is-outlined">Reset password</button>
            {{ $status ?? ''}}
        </form>
        @error('message')
            <div class="help is-danger">{{ $message }}</div>
        @enderror
    </div>
@endsection