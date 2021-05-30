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
            @foreach($latest as $article)
                <div class="article box ">
                    <p class="article-title"><a href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></p>
                    <p class="article-subject box has-background-dark has-text-white column is-one-third"> {{ $article->subject }}</p>
                    <p class="article-author"><a href="{{ url('/profile/'.$article->user_id) }}">{{ $article->user->name }}</a> the {{ date('j F, Y H:i:s', strtotime($article->created_at)) }}</p>
                </div>
            @endforeach
        </div>
        <h3 class="has-text-centered title has-text-white">
            Hottest discussions
            <img src="{{ asset('images/discussion.svg') }}" alt="">
        </h3>
        <div class="hottest-discussions">
            @foreach($hottest as $discussion)
                <div class="discussion box">
                    <p class="discussion-title"><a href="{{ url('discussion/'.$discussion->id) }}">{{ $discussion->subject }}</a></p>
                    <p class="discussion-message-number">{{ $discussion->messages_count }} message(s)</p>
                </div>
            @endforeach
        </div>
    </main>
    @include('components.footer')
@endsection