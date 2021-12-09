@extends('templates.base')

@section('title')
    Home
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <x-menu></x-menu>
    <main class="has-text-white">
        <div class="box">
            <h3 class="has-text-centered subtitle"><i class="fa fa-clipboard" aria-hidden="true"></i> Paste released</h3>
            <div>
                <div class="box has-background-dark">
                    <p class="subtitle question has-text-white"> What is paste ?</p>
                    <div class="has-text-white">
                        Paste is a basic service that allow users to paste their code snippets in many languages (C++,C#,Rust,PHP,...)
                        After pasting your code or drag&dropping your file, you chose the lifetime in hours of your snippet and you get the url.
                        You can share the link your anyone and your snippets are public.
                        You can also remove prematurely snippets and modify them.
                        <p class="is-centered has-margin-top"><a href="{{ url('paste') }}" class="link">Try paste now !</a></p>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="has-text-centered subtitle has-text-white">
            Latest articles
            <i class="fa fa-book fa-fw" aria-hidden="true"></i>
        </h3>
        <div class="latest-articles">
            @include('article.articlelist')
        </div>
        <h3 class="has-text-centered subtitle has-text-white">
            Hottest discussions
            <i class="fa fa-comment" aria-hidden="true"></i>
        </h3>
        <div class="hottest-discussions">
            @include('discussion.discussionlist')
        </div>
    </main>
    <x-footer></x-footer>
@endsection