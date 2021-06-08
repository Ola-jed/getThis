@extends('templates.base')

@section('title')
    Register
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/formPage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="hero-body">
        <form action="{{ url('register') }}" method="post" class="box has-background-dark is-center has-text-white column is-4 is-offset-4">
            @csrf
            <h5 class="has-text-centered has-text-light is-white title is-5">Register</h5>
            <div class="field column is-two-thirds">
                <label for="name" class="label has-text-white">Username</label>
                <input type="text" class="input is-primary" name="name" placeholder="Name" maxlength="25" required>
                @error('name')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field column is-two-thirds">
                <label for="email" class="label has-text-white">Email</label>
                <input type="email" name="email" class="input is-primary" placeholder="user@mail.com" required>
                @error('email')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field column is-two-thirds">
                <label for="password" class="label has-text-white">Password</label>
                <input type="password" name="password1" class="input is-primary" placeholder="*****" required>
                @error('password1')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field column is-two-thirds">
                <label for="password" class="label has-text-white">Confirm password</label>
                <input type="password" name="password2" class="input is-primary" placeholder="*****" required>
                @error('password2')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="control">
                <button type="submit" class="button is-link is-outlined">Register</button>
            </div>
            <div class="register has-text-link"><a href="{{ url('/login') }}">Already registered ? Login</a></div>
            @if($errors->has('message'))
                <div class="help is-danger error">{{ $errors->first('message') }}</div>
            @endif
        </form>
    </div>
@endsection
