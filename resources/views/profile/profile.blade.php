@extends('templates.base')

@section('title')
    Profile
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/profile.js') }}" defer></script>
    <script src="{{ asset('js/modal.js') }}" defer></script>
@endsection

@section('content')
    <x-menu></x-menu>
    <main>
        <div class="user-infos card has-background-dark">
            <div class="has-text-white subtitle">Name : {{ session()->get('user')->name }}</div>
            <div class="has-text-white subtitle">Email : {{ session()->get('user')->email }}</div>
            <div class="has-text-white subtitle">Active since the {{ session()->get('user')->created_at->toDayDateTimeString() }}</div>
            <div class="has-text-white subtitle">Last account update on {{ session()->get('user')->updated_at->toDayDateTimeString() }}</div>
            <div class="has-text-white subtitle">{{ $article_count }} @choice('article|articles',$article_count) written</div>
        </div>
        <div class="button is-warning is-outlined update">Update account</div>
        @include('profile.profileupdateform')
        @if(count($articles) > 0)
            <div class="articles">
                <h4 class="has-text-centered subtitle has-text-white">
                    @choice('Article|Articles',$articles->count()) written
                    <i class="fa fa-book fa-fw" aria-hidden="true"></i>
                </h4>
                @include('article.articlelist')
            </div>
        @endif
        @if(count($discussions) > 0)
            <div class="discussions">
                <h4 class="has-text-centered subtitle has-text-white">
                    @choice('Discussion|Discussions',$discussions->count()) created
                    <img src="{{ asset('images/discussion.svg') }}" alt="">
                </h4>
                @include('discussion.discussionlist')
            </div>
        @endif
        <div>
            <button class="button is-danger is-outlined" id="open-modal">Delete my account</button>
            @error('delete')
                <div class="help is-danger">{{ $message }}</div>
            @enderror
            <div class="modal">
                <div class="modal-background"></div>
                <div class="modal-content">
                    <div class="modal-card">
                        <header class="modal-card-head has-background-dark">
                            <p class="modal-card-title has-text-white">Do you really want to delete your account ?</p>
                        </header>
                        <section class="modal-card-body has-background-dark">
                            <form action="{{ url('/profile') }}" method="post" class="delete-profile">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button is-danger is-outlined">Yes</button>
                                <button type="button" class="button is-success" id="cancel">No</button>
                                <button class="modal-close is-large" aria-label="close" id="close"></button>
                                @error('delete')
                                    <div class="help is-danger">{{ $message }}</div>
                                @enderror
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-footer></x-footer>
@endsection