@extends('templates.base')

@section('title')
    Paste
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/pasteview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/highlight/gruvbox.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/highlight.min.js') }}" defer></script>
    <script src="{{ asset('js/pasteview.js') }}" type="module" defer></script>
@endsection

@section('content')
    @include('components.menu')
    <main>
        <pre><code>
            {!! $paste->content !!}
        </code></pre>
    </main>
    @include('components.footer')
@endsection