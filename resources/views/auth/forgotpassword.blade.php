@extends('templates.base')

@section('title')
    Forgotten Password
@endsection

@section('content')
    <h1>Password reset link</h1>
    <form action="{{ url('forget-password') }}" method="post">
        @csrf
        <label for="email">Email :</label><input type="email" name="email" id="email" value="{{ old('email') }}" required><br>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <button type="submit">Send reset link</button>
    </form>
    @error('message')
        {{ $message }}
    @enderror
    {{ $status ?? ''}}
    <h2><a href="{{ url('/register') }}">Not yet registered ? Register</a></h2>
@endsection
