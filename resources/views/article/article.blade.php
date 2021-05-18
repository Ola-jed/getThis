@extends('templates.base')

@section('title')
    {{ $article->title }}
@endsection

@section('style')

@endsection

@section('script')

@endsection

@section('content')
    <div class="subject">
        {{ $article->subject }}
    </div>
    <div class="title">
        {{ $article->title }}
    </div>
    <article>
        {{ $article->content }}
    </article>
    {{-- Put the comments here --}}
@endsection
