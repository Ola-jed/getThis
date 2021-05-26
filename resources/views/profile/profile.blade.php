@extends('templates.base')

@section('style')

@endsection

@section('content')
    @include('components.menu')
    <main>
        <div class="user-infos">

        </div>
        <div class="articles">
            @include('article.articlelist')
        </div>
        <div class="discussions">
            @include('discussion.discussionlist')
        </div>
    </main>
    @include('components.footer')
@endsection
