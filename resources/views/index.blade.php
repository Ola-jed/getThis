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
        <h3 class="has-text-centered">Hello {{ \Illuminate\Support\Facades\Session::get('user')->name }}</h3>
        <hr>
        <h3 class="has-text-centered title has-text-white">
            Latest articles
            <img src="{{ asset('images/article.svg') }}" alt="">
        </h3>
        <div class="latest-articles">
            @include('article.articlelist')
        </div>
        <h3 class="has-text-centered title has-text-white">
            Hottest discussions
            <img src="{{ asset('images/discussion.svg') }}" alt="">
        </h3>
        <div class="hottest-discussions">
            @include('discussion.discussionlist')
        </div>
    </main>
    @include('components.footer')
@endsection