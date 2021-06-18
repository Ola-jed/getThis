@extends('templates.base')

@section('title')
    Paste
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/paste.css') }}">
@endsection

@section('content')
    @include('components.menu')
    <form action="{{ url('paste') }}" method="post" class="is-center has-text-white column is-centered">
        @csrf
        <h5 class="has-text-centered has-text-light is-white title is-5">Paste</h5>
        <div class="field column">
            <label for="title" class="label has-text-white">Title</label>
            <input type="text" name="title" class="input is-primary has-background-dark has-text-white" placeholder="Title" required>
            @error('title')
                <div class="help is-danger">{{ $message }}</div>
            @enderror
            <label for="content" class="label has-text-white">Code</label>
            <textarea name="content" placeholder="Your code" cols="30" rows="20" class="textarea is-primary has-background-dark has-text-white"></textarea>
            @error('content')
                <div class="help is-danger">{{ $message }}</div>
            @enderror
        </div>
        <label for="lifetime" class="label has-text-white">Lifetime in hours</label>
        <div class="select">
            <select name="lifetime">
                <option value="1">1</option>
                <option value="1">2</option>
                <option value="1">4</option>
                <option value="1">8</option>
                <option value="1">16</option>
                <option value="1">24</option>
                <option value="1">48</option>
                <option value="1">72</option>
                <option value="1">96</option>
                <option value="1">120</option>
            </select>
        </div>
        @error('lifetime')
            <div class="help is-danger">{{ $message }}</div>
        @enderror
        <br>
        <button type="submit" class="button is-primary is-outlined">Save</button>
        @error('message')
            <div class="error">{{ $message }}</div>
        @enderror
    </form>
    @include('components.footer')
@endsection