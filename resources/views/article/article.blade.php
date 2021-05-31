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
            <a href="{{ url('/profile/'.$article->user_id) }}">{{ $article->user->name }}</a>, on {{ date('F j , Y H:i:s', strtotime($article->created_at)) }}
            <p>Last update on {{ date('F j , Y H:i:s', strtotime($article->updated_at)) }}</p>
        </div>
        @if(\Illuminate\Support\Facades\Session::get('user')->id === $article->user_id)
            <a href="{{ url('/article/'.$article->slug.'/update') }}" class="button is-link">Update</a>
        @endif
        <hr>
        <div class="comment-form">
            <form action="{{ url('/article/'.$article->slug.'/comments') }}" method="post" id="comment-post" onsubmit="return false">
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
