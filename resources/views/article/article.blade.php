@extends('templates.base')

@section('title')
    {{ $article->title }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/article.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/commentManager.js') }}" defer></script>
@endsection

@section('content')
    @include('components.menu')
    <main class="has-text-white">
        <div class="title">
            {{ $article->title }}
        </div>
        <hr>
        <div class="subject">
            {{ $article->subject }}
        </div>
        <article>
            {{ $article->content }}
        </article>
        <div class="date">
            <a href="{{ url('/profile/'.\App\Models\User::find($article->writer_id)->id) }}">{{ \App\Models\User::find($article->writer_id)->name }}</a>, the {{ date('j F, Y', strtotime($article->created_at)) }}
        </div>
        <hr>
        <div class="comment-form">
            <form action="{{ url('/article/'.$article->id.'/comments') }}" method="post" id="comment-post" onsubmit="return false">
                @csrf
                <textarea name="content" id="content" cols="30" rows="10" placeholder="Your comment" required></textarea><br>
                <button type="submit" class="button is-primary">Post</button>
            </form>
        </div>
        <div class="comments">
            {{-- Put the comments here --}}
        </div>
    </main>
    @include('components.footer')
@endsection
