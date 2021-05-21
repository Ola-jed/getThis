@extends('templates.base')

@section('title')
    Articles
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/articles.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/article.js') }}" defer></script>
@endsection

@section('content')
    @include('components.menu')
    <main>
        @foreach($articles as $article)
            <div class="article">
                <p class="article-title"><a href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></p>
                <p class="article-subject"> {{ $article->subject }}</p>
                <p class="article-author">Written the {{ date('j F, Y', strtotime($article->created_at)) }} by <a href="{{ url('/profile/'.\App\Models\User::find($article->writer_id)->id) }}">{{ \App\Models\User::find($article->writer_id)->name }}</a></p>
            </div>
        @endforeach
        <div class="navigation-links">
            <a href="javascript: void(0)" class="previous">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                </svg>
                Previous
            </a>
            <a href="javascript: void(0)" class="next">Next
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                </svg>
            </a>
        </div>
    </main>
    @include('components.footer')
@endsection
