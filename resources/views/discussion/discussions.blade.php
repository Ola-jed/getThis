@extends('templates.base')

@section('title')
    Discussions
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/discussions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common_articles_discussions.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/discussions.js') }}" defer></script>
    <script src="{{ asset('js/navigation.js') }}" defer></script>
    <script src="{{ asset('js/formShow.js') }}" defer></script>
@endsection

@section('content')
    @include('components.menu')
    <main>
        <div class="discussion-search field has-addons">
            <div class="control">
                <input class="input" name="search" type="search" placeholder="Search a discussion" id="form-search">
            </div>
            <div class="control">
                <button class="button is-info is-outlined search-btn">
                    <img src="{{ asset('images/search.svg') }}" alt="">
                </button>
            </div>
        </div>
        <span class="add">
            <img src="{{ asset('images/plus.svg') }}" alt="Add">
        </span>
        @include('discussion.discussioncreationform')
        <div class="discussions">
            @include('discussion.discussionlist')
        </div>
        <div class="navigation-links">
            <a href="javascript: void(0)" class="previous button is-primary is-outlined">Previous</a>
            <a href="javascript: void(0)" class="next button is-primary is-outlined">Next</a>
        </div>
    </main>
    @include('components.footer')
@endsection