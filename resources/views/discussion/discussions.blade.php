@extends('templates.base')

@section('title')
    Discussions
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/article.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/commentManager.js') }}" defer></script>
@endsection

@section('content')
    @include('components.menu')
    <main>

    </main>
    @include('components.footer')
@endsection
