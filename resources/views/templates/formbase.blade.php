@extends('templates.base')

@section('content')
    @yield('head')
    <form action= @yield('action-form') method="POST">
        @csrf
        @yield('form-content')
    </form>
    @yield('foot')
@endsection
