@extends('templates.base')

@section('title')
    Paste
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/paste.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/pasteform.js') }}" defer></script>
@endsection

@section('content')
    <x-menu></x-menu>
    <form action="{{ url('paste') }}" method="post" class="is-center has-text-white column is-centered">
        @csrf
        <h5 class="has-text-centered has-text-light is-white title is-5">Paste</h5>
        <div class="has-text-centered">
            Copy and paste your source code file here and choose the lifetime of your paste (The pastes are all temporal).
            You can also drag and drop a file into the form.
        </div>
        <div class="field column">
            <label for="title" class="label has-text-white">Title</label>
            <input type="text" id="title" name="title" class="input is-primary" placeholder="Title" required>
            @error('title')
                <div class="help is-danger">{{ $message }}</div>
            @enderror
            <label for="content" class="label has-text-white">Code</label>
            <textarea name="content" id="content" cols="30" rows="20" class="textarea is-primary" required></textarea>
            @error('content')
                <div class="help is-danger">{{ $message }}</div>
            @enderror
        </div>
        <label for="lifetime" class="label has-text-white">Lifetime in hours</label>
        <div class="select">
            <select name="lifetime" id="lifetime">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="4">4</option>
                <option value="8">8</option>
                <option value="16">16</option>
                <option value="24">24</option>
                <option value="48">48</option>
                <option value="72">72</option>
                <option value="96">96</option>
                <option value="120">120</option>
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
    <x-footer></x-footer>
@endsection