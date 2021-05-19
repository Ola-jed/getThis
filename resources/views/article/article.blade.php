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
    <main>
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
            Written the {{ date('j F, Y', strtotime($article->created_at)) }}
        </div>
        <div class="comment-form">
            <form action="{{ url('/article/'.$article->id.'/comments') }}" method="post" id="comment-post" onsubmit="return false">
                @csrf
                <legend>Your comment</legend>
                <textarea name="content" id="content" cols="30" rows="10" required></textarea><br>
                <button type="submit">Post</button>
            </form>
        </div>
        <div class="comments">
            {{-- Put the comments here --}}
        </div>
    </main>
    @include('components.footer')
@endsection
