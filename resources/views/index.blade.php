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
        Hello {{ \Illuminate\Support\Facades\Session::get('user')->name }}
        <div class="latest-articles">
            <p>Latest articles</p>
            @foreach($latest as $article)
                <div class="article">
                    <p class="article-title">{{ $article->title }}</p>
                    <p class="article-subject"> {{ $article->subject }}</p>
                    <p>Written by {{ \App\Models\User::find($article->writer_id)->name }}</p>
                </div>
            @endforeach
        </div>
        <div class="hottest-discussions">
            <p>Hottest discussions</p>
            @foreach($hottest as $discussion)
                <div class="discussion">
                    <p class="discussion-title">{{ $discussion->subject }}</p>
                    <p class="discussion-message-number">{{ $discussion->messages_count }} message(s)</p>
                    <p><a href="{{ url('/discussion/'.$discussion->id) }}">Participate</a></p>
                </div>
            @endforeach
        </div>
    </main>
    @include('components.footer')
@endsection
