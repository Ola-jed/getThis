@extends('templates.base')

@section('title')
    Articles
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/articles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common_articles_discussions.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/article.js') }}" defer></script>
    <script src="{{ asset('js/navigation.js') }}" defer></script>
    <script src="{{ asset('js/formShow.js') }}" defer></script>
@endsection

@section('content')
    @include('components.menu')
    <main>
        <div class="article-search field has-addons">
            <div class="control">
                <input class="input" name="search" type="search" placeholder="Search by title" id="form-search">
            </div>
            <div class="control">
                <button class="button is-info is-outlined search-btn">
                    <img src="{{ asset('images/search.svg') }}" alt="delete">
                </button>
            </div>
        </div>
        <span class="add">
            <img src="{{ asset('images/plus.svg') }}" alt="">
        </span>
        @include('article.articleform')
        <div class="articles">
            @include('article.articlelist')
        </div>
        <div class="navigation-links">
            <a href="javascript: void(0)" class="previous button is-primary is-outlined">Previous</a>
            <a href="javascript: void(0)" class="next button is-primary is-outlined">Next</a>
        </div>
    </main>
    @include('components.footer')
@endsection
