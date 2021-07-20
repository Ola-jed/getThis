@extends('templates.base')

@section('title')
    Contact
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/formPage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    @include('components.menu')
    <div class="hero-body">
        <form action="{{ url('contact') }}" method="post" class="box has-background-dark is-center has-text-white column is-4 is-offset-4 is-centered">
            @csrf
            <h5 class="has-text-centered has-text-light is-white title is-5">Contact</h5>
            <div class="field column">
                <label for="subject" class="label has-text-white">Subject</label>
                <input type="text" name="subject" class="input is-primary" placeholder="Subject" required>
                @error('subject')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field column">
                <textarea name="content" placeholder="Your message" cols="42" rows="10" class="textarea is-primary"></textarea>
                @error('content')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="line"><button type="submit" class="button is-link is-outlined">Send</button></div>
            @error('message')
                <div class="help is-danger">{{ $message }}</div>
            @enderror
        </form>
    </div>
    @include('components.footer')
@endsection