@extends('templates.base')

@section('title')
    Articles
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/articles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common_articles_discussions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastui-editor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/codemirror.min.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/article.js') }}" defer></script>
    <script src="{{ asset('js/navigation.js') }}" defer></script>
    <script src="{{ asset('js/formShow.js') }}" defer></script>
    <script src="{{ asset('js/toastui.min.js') }}" defer></script>
    <script src="{{ asset('js/articleForm.js') }}" defer></script>
@endsection

@section('content')
    <x-menu></x-menu>
    <main>
        <div class="search-container">
            <div class="article-search field has-addons is-four-fifths">
                <div class="control is-expanded">
                    <input class="input" name="search" type="search" placeholder="Search by title" id="form-search">
                </div>
                <div class="control">
                    <button class="button is-info is-outlined search-btn">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="add ">
                <img src="{{ asset('images/plus.svg') }}" alt="Add">
            </div>
        </div>
        @include('article.articleform')
        <div class="articles">
            @include('article.articlelist')
        </div>
        <div class="navigation-links">
            <a href="javascript: void(0)" class="previous button is-primary is-outlined"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
            <a href="javascript: void(0)" class="next button is-primary is-outlined"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        </div>
    </main>
    <x-footer></x-footer>
@endsection
