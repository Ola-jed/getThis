@extends('templates.base')

@section('title')
    Home
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    @include('components.menu')
    <main class="has-text-white">
        <h3 class="has-text-centered">Hello {{ session()->get('user')->name }}</h3>
        <hr>
        <div class="box">
            <h3 class="has-text-centered subtitle">Paste released</h3>
            <div>
                <div class="box has-background-primary-dark">
                    <p class="subtitle question"> What is paste ?</p>
                    <div class="has-text-white">
                        Paste is a basic service that allow users to paste their code snippets in many languages (C++,C#,Rust,PHP,...)
                        After pasting your code, you chose the lifetime in hours of your snippet and you get the url.
                        You can share the link your anyone and your snippets are public.
                        You can also remove prematurely snippets and modify them
                        <p class="is-centered"><a href="{{ url('paste') }}" class="is-link has-text-link-light">Try paste now !</a></p>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="has-text-centered subtitle has-text-white">
            Latest articles
            <img src="{{ asset('images/article.svg') }}" alt="">
        </h3>
        <div class="latest-articles">
            @include('article.articlelist')
        </div>
        <h3 class="has-text-centered subtitle has-text-white">
            Hottest discussions
            <img src="{{ asset('images/discussion.svg') }}" alt="">
        </h3>
        <div class="hottest-discussions">
            @include('discussion.discussionlist')
        </div>
    </main>
    @include('components.footer')
@endsection