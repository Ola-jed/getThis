@extends('templates.base')

@section('title')
    Contact
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@include('components.menu')

@section('content')
    <div class="login-box">
        <h2>Contact</h2>
        <form action="{{ url('contact') }}" method="post">
            @csrf
            <div class="user-box">
                <input type="name" name="subject" required>
                <label>Subject</label>
                @error('subject')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="user-box">
                <textarea name="content" placeholder="Your message" cols="42" rows="10"></textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Send</button>
        </form>
        @error('message')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
@endsection

@include('components.footer')
