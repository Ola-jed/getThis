@extends('templates.base')

@section('title')
    {{ $discussion->subject }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/discussion.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/discussion.js') }}" defer></script>
@endsection

@section('content')
    <x-menu></x-menu>
    <main>
        <div class="has-text-white infos">
            <h2 class="title has-text-white is-center">{{ $discussion->subject }}</h2>
            <p>Created by <a href="{{ url('/account/'.$discussion->user_id) }}" class="is-link has-text-link-light">{{ $discussion->user->name }}</a>, on {{ $discussion->created_at->toDayDateTimeString() }}</p>
        </div>
        @include('discussion.messagecreationform')
        <div class="messages">
            @include('discussion.messages')
        </div>
    </main>
    <x-footer></x-footer>
@endsection
