@extends('templates.base')

@section('title')
    {{ $user->name }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/modal.js') }}" defer></script>
@endsection

@section('content')
    <x-menu></x-menu>
    <main>
        <div class="user-infos card has-background-dark">
            <div class="profile-photo"><img src="{{ asset('images/user.svg') }}" alt="Profile"></div>
            <div class="has-text-white subtitle">Name : {{ $user->name }}</div>
            <div class="has-text-white subtitle">Email : {{ $user->email }}</div>
            <div class="has-text-white subtitle">Active since {{ $user->created_at->toDayDateTimeString() }}</div>
            <div class="has-text-white subtitle">{{ $articles->count() }} @choice('article|articles',$articles->count()) written</div>
        </div>
        @if($articles->count() > 0)
            <div class="articles">
                <h4 class="has-text-centered subtitle has-text-white">
                    @choice('Article|Articles',$articles->count()) written
                    <i class="fa fa-book fa-fw" aria-hidden="true"></i>
                </h4>
                @include('article.articlelist')
            </div>
        @endif
        @if($discussions->count() > 0)
            <div class="discussions">
                <h4 class="has-text-centered subtitle has-text-white">
                    @choice('Discussion|Discussions',$discussions->count()) created
                    <i class="fa fa-comment" aria-hidden="true"></i>
                </h4>
                @include('discussion.discussionlist')
            </div>
        @endif

        @if($user->id !== session()->get('user')->id)
            <button class="button is-warning" id="open-modal"><i class="fa fa-flag" aria-hidden="true"></i>  Report</button>
            <div class="modal">
                <div class="modal-background"></div>
                <div class="modal-content">
                    <div class="modal-card">
                        <header class="modal-card-head has-background-dark">
                            <p class="modal-card-title has-text-white">Report {{ $user->name }}</p>
                            <button class="delete close" aria-label="close"></button>
                        </header>
                        <section class="modal-card-body has-background-dark">
                            <form action="{{ url('/account/'.$user->id) }}" method="post">
                                @csrf
                                <textarea name="cause" class="textarea" placeholder="Explain why you want to report this user" required></textarea>
                                <div class="buttons">
                                    <button type="submit" class="button is-primary is-outlined">Report</button>
                                    <button class="button is-danger is-selected" id="cancel">Cancel</button>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
                <button class="modal-close is-large close" aria-label="close"></button>
            </div>
        @endif
    </main>
    <x-footer></x-footer>
@endsection