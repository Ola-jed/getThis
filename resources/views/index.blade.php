@extends('templates.base')

@section('title')
    Home
@endsection

@section('content')
    @include('components.menu')
    <main>
        Hello {{ \Illuminate\Support\Facades\Session::get('user')->name }}
    </main>
    @include('components.footer')
@endsection
