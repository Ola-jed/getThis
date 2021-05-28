@extends('templates.base')

@section('title')
    Profile
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/profile.js') }}" defer></script>
@endsection

@section('content')
    @include('components.menu')
    <main>
        <div class="user-infos card has-background-dark">
            <div class="profile-photo"><img src="{{ asset('images/user.svg') }}" alt="Profile"></div>
            <div class="has-text-white subtitle">Name : {{ \Illuminate\Support\Facades\Session::get('user')->name }}</div>
            <div class="has-text-white subtitle">Email : {{ \Illuminate\Support\Facades\Session::get('user')->email }}</div>
            <div class="has-text-white subtitle">Active since {{ date('F j, Y H:i:s', strtotime(\Illuminate\Support\Facades\Session::get('user')->created_at)) }}</div>
            <div class="has-text-white subtitle">Last account update on {{ date('F j, Y H:i:s', strtotime(\Illuminate\Support\Facades\Session::get('user')->created_at)) }}</div>
            <div class="has-text-white subtitle">{{ $article_count }} article(s) written</div>
        </div>
        <div class="button is-link update">Update account</div>
        @include('profile.profileupdateform')
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
        <div>
            <form action="{{ url('/profile') }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="button is-danger is-outlined" name="delete">Delete my account</button>
                @error('delete')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </form>
        </div>
    </main>
    @include('components.footer')
@endsection
