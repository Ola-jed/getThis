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
    <x-menu></x-menu>
    <main class="has-text-white">
        <div class="title is-centered is-center has-text-centered">
            {{ $article->title }}
        </div>
        <hr>
        <div class="subject">
            {{ $article->subject }}
        </div>
        <article class="has-text-black">
{!! $article->htmlContent() !!}
        </article>
        <div class="date">
            <a href="{{ url('/account/'.$article->user_id) }}">{{ $article->user->name }}</a>, on {{ $article->created_at->toDayDateTimeString() }}
            <p>Last update on {{ $article->updated_at->toDayDateTimeString() }}</p>
        </div>
        @if(session()->get('user')->id === $article->user_id)
            <a href="{{ url('/article/'.$article->slug.'/update') }}" class="button is-warning is-outlined">Update</a>
        @endif
        <hr>
        <div class="comment-form">
            <form action="{{ url('/article/'.$article->slug.'/comments') }}" method="post" id="comment-post" onsubmit="return false">
                @csrf
                <textarea name="content" id="content" cols="30" rows="10" placeholder="Your comment" class="textarea is-primary" required></textarea><br>
                <button type="submit" class="button is-primary">Post</button>
            </form>
        </div>
        <div class="comments">
            {{-- Put the comments here --}}
        </div>
    </main>
    <x-footer></x-footer>
@endsection
