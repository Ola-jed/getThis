@extends('templates.base')

@section('title')
    Profile
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    @include('components.menu')
    <main>
        <div class="user-infos">

        </div>
        @if(count($articles) > 0)
            <div class="articles">
                <h4 class="has-text-centered subtitle has-text-white">
                    Articles written
                    <img src="{{ asset('images/article.svg') }}" alt="">
                </h4>
                @include('article.articlelist')
            </div>
        @endif

        @if(count($discussions) > 0)
            <div class="discussions">
                <h4 class="has-text-centered subtitle has-text-white">
                    Discussions created
                    <img src="{{ asset('images/discussion.svg') }}" alt="">
                </h4>
                @include('discussion.discussionlist')
            </div>
        @endif

    </main>
    @include('components.footer')
@endsection
