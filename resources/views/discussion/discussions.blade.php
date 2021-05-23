@extends('templates.base')

@section('title')
    Discussions
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/discussions.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/discussions.js') }}" defer></script>
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
            </div>
        </div>
        <span class="discussion-add">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffffff" class="bi bi-plus-square" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
        </span>
        @include('discussion.discussioncreationform')
        @include('discussion.discussionlist')
    </main>
    @include('components.footer')
@endsection
