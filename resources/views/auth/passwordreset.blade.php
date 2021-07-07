@extends('templates.base')

@section('title')
    Password reset
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="hero-body">
        <form action="{{ url('reset-password') }}" method="post" class="box dark-bg-transparent is-center has-text-white column is-4 is-offset-4 is-centered">
            @csrf
            <h5 class="has-text-centered has-text-light is-white title is-3">Password reset</h5>
            <input type="hidden" name="token" value="{{ $token }}" required>
            @error('token')
                <div class="help is-danger">{{ $message }}</div>
            @enderror
            <div class="field column">
                <label class="label has-text-white" for="email">Email</label>
                <p class="control has-icons-left has-icons-right">
                    <input class="input" name="email" type="email" value="{{ old('email') }}" required>
                    <span class="icon is-small is-left"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                </p>
                @error('email')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field column">
                <label class="label has-text-white" for="password">Password</label>
                <p class="control has-icons-left">
                    <input class="input" type="password" name="password" placeholder="*****" value="{{ old('password') }}" required>
                    <span class="icon is-small is-left"><i class="fas fa-lock" aria-hidden="true"></i></span>
                </p>
                @error('password')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field column">
                <label class="label has-text-white" for="password_confirmation">Confirm password</label>
                <p class="control has-icons-left">
                    <input class="input" type="password" name="password_confirmation" placeholder="*****" value="{{ old('password_cnfirmation') }}" required>
                    <span class="icon is-small is-left"><i class="fas fa-lock" aria-hidden="true"></i></span>
                </p>
                @error('password_confirmation')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            @error('message')
                <div class="help is-danger">{{ $message }}</div>
            @enderror
            <div class="column">
                <button type="submit" class="button is-link is-outlined">Reset password</button>
            </div>
            {{ $status ?? ''}}
        </form>
        @error('message')
            <div class="help is-danger">{{ $message }}</div>
        @enderror
    </div>
@endsection