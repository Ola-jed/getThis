@extends('templates.base')

@section('title')
    {{ $user->name }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
    @include('components.menu')
    <main>
        <div class="user-infos card has-background-dark">
            <div class="profile-photo"><img src="{{ asset('images/user.svg') }}" alt="Profile"></div>
            <div class="has-text-white subtitle">Name : {{ $user->name }}</div>
            <div class="has-text-white subtitle">Email : {{ $user->email }}</div>
            <div class="has-text-white subtitle">Active since {{ date('F j, Y H:i:s', strtotime($user->created_at)) }}</div>
            <div class="has-text-white subtitle">Last account update on {{ date('F j, Y H:i:s', strtotime($user->created_at)) }}</div>
            <div class="has-text-white subtitle">{{ $articles->count() }} article(s) written</div>
        </div>
        @if($articles->count() > 0)
            <div class="articles">
                <h4 class="has-text-centered subtitle has-text-white">
                    Articles written
                    <img src="{{ asset('images/article.svg') }}" alt="">
                </h4>
                @include('article.articlelist')
            </div>
        @endif
        @if($discussions->count() > 0)
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