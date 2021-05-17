@extends('templates.base')

@section('title')
    Home
@endsection

@section('content')
    Hello {{ \Illuminate\Support\Facades\Session::get('user')->name }}
@endsection
