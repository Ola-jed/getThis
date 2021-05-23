@extends('templates.base')

@section('title')
    {{ $article->title }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/article.css') }}">
@endsection

@section('content')
    @include('components.menu')
    <main class="has-text-white">
        <form action="{{ url('article/'.$article->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="field">
                <label for="subject" class="label has-text-white">Subject</label>
                <input type="text" class="input is-primary" name="subject" value="{{ $article->subject }}" required>
                @error('subject')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field">
                <label for="subject" class="label has-text-white">Title</label>
                <input type="text" class="input is-primary" name="title" value="{{ $article->title }}" required>
                @error('title')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <textarea name="content" id="content" cols="30" rows="10" class="textarea is-primary" required>
                {{ $article->content }}
            </textarea><br>
            <button type="submit" class="button is-primary">Update</button>
        </form>
    </main>
    @include('components.footer')
@endsection
