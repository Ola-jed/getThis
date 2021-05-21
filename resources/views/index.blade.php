@extends('templates.base')

@section('title')
    Home
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    @include('components.menu')
    <main>
        <h3>Hello {{ \Illuminate\Support\Facades\Session::get('user')->name }}</h3>
        <div class="latest-articles">
            <p>
                Latest articles
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                </svg>
            </p>
            @foreach($latest as $article)
                <div class="article">
                    <p class="article-title"><a href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></p>
                    <p class="article-subject"> {{ $article->subject }}</p>
                    <p class="article-author">Written the {{ date('j F, Y', strtotime($article->created_at)) }} by <a href="{{ url('/profile/'.\App\Models\User::find($article->writer_id)->id) }}">{{ \App\Models\User::find($article->writer_id)->name }}</a></p>
                </div>
            @endforeach
        </div>
        <div class="hottest-discussions">
            <p>
                Hottest discussions
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-right-text" viewBox="0 0 16 16">
                    <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z"/>
                    <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </p>

            @foreach($hottest as $discussion)
                <div class="discussion">
                    <p class="discussion-title"><a href="{{ url('discussion/'.$discussion->id) }}">{{ $discussion->subject }}</a></p>
                    <p class="discussion-message-number">{{ $discussion->messages_count }} message(s)</p>
                </div>
            @endforeach
        </div>
    </main>
    @include('components.footer')
@endsection
