@extends('templates.base')

@section('title')
    {{ $discussion->subject }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/discussion.css') }}">
@endsection

@section('script')
@endsection

@section('content')
    @include('components.menu')
    <main>
        <div class="has-text-white">
            <h2 class="title has-text-white is-center">{{ $discussion->subject }}</h2>
            <p>Created by <a href="{{ url('/profile/'.$discussion->creator_id) }}">{{ \App\Models\User::find($discussion->creator_id)->name }}</a>, on {{ date('F j , Y H:i:s', strtotime($discussion->created_at)) }}</p>
        </div>
        @include('discussion.messagecreationform')
        <div class="messages">
            @include('discussion.messages')
        </div>
    </main>
    @include('components.footer')
@endsection
