@extends('templates.base')

@section('title')
    Paste
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/pasteview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/highlight/gruvbox.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/highlight.min.js') }}" defer></script>
    <script src="{{ asset('js/line-number.min.js') }}" defer></script>
    <script src="{{ asset('js/pasteview.js') }}" defer></script>
@endsection

@section('content')
    <x-menu></x-menu>
    <main>
        <pre><code>
{{ $paste->content }}
        </code></pre>
        <p class="has-text-white"><a href="{{ url('/account/'.$paste->user_id) }}" class="has-text-link-light">{{ $paste->user->name }}</a>, on {{ $paste->created_at->toDayDateTimeString() }}</p>
        @if(session()->get('user')?->id === $paste->user_id)
            <div class="modifications columns">
                <div class="column is-narrow">
                    <a href="{{ url('paste/'.$paste->slug.'/edit') }}" class="button is-warning is-outlined">Edit</a>
                </div>
                <div class="column is-narrow">
                    <form action="{{ url('paste/'.$paste->slug) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="button is-danger is-outlined" onclick="alert('This paste will be deleted')">Delete</button>
                    </form>
                </div>
            </div>
        @endif
    </main>
    <x-footer></x-footer>
@endsection