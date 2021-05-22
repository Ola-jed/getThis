@extends('templates.base')

@section('title')
    Login
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="hero-body">
        <form action="{{ url('login') }}" method="post" class="box has-background-dark is-center has-text-white column is-4 is-offset-4 is-centered">
            @csrf
            <h5 class="has-text-centered has-text-light is-white title is-5">Login</h5>
            <div class="field column is-two-thirds">
                <label for="email" class="label has-text-white">Email</label>
                <input type="email" name="email" class="input is-primary" placeholder="user@mail.com" required>
                @error('email')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="field column is-two-thirds">
                <label for="password" class="label has-text-white">Password</label>
                <input type="password" name="password" class="input is-primary" placeholder="*****" required>
                @error('password')
                    <div class="help is-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="control column">
                <button type="submit" class="button is-link is-outlined">Login</button>
            </div>
            @error('message')
                <div class="help is-danger">{{ $message }}</div>
            @enderror
            <div class="other">Or login with</div>
            <div class="other-login ">
                <a href="{{ url('/login/google') }}" class="google-login">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 326667 333333" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"><path d="M326667 170370c0-13704-1112-23704-3518-34074H166667v61851h91851c-1851 15371-11851 38519-34074 54074l-311 2071 49476 38329 3428 342c31481-29074 49630-71852 49630-122593m0 0z" fill="#4285f4"/><path d="M166667 333333c44999 0 82776-14815 110370-40370l-52593-40742c-14074 9815-32963 16667-57777 16667-44074 0-81481-29073-94816-69258l-1954 166-51447 39815-673 1870c27407 54444 83704 91852 148890 91852z" fill="#34a853"/><path d="M71851 199630c-3518-10370-5555-21482-5555-32963 0-11482 2036-22593 5370-32963l-93-2209-52091-40455-1704 811C6482 114444 1 139814 1 166666s6482 52221 17777 74814l54074-41851m0 0z" fill="#fbbc04"/><path d="M166667 64444c31296 0 52406 13519 64444 24816l47037-45926C249260 16482 211666 1 166667 1 101481 1 45185 37408 17777 91852l53889 41853c13520-40185 50927-69260 95001-69260m0 0z" fill="#ea4335"/></svg>
                </a>
                <a href="{{ url('/login/github') }}" class="github-login">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="30" height="30" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 640 640"><path d="M319.988 7.973C143.293 7.973 0 151.242 0 327.96c0 141.392 91.678 261.298 218.826 303.63 16.004 2.964 21.886-6.957 21.886-15.414 0-7.63-.319-32.835-.449-59.552-89.032 19.359-107.8-37.772-107.8-37.772-14.552-36.993-35.529-46.831-35.529-46.831-29.032-19.879 2.209-19.442 2.209-19.442 32.126 2.245 49.04 32.954 49.04 32.954 28.56 48.922 74.883 34.76 93.131 26.598 2.882-20.681 11.15-34.807 20.315-42.803-71.08-8.067-145.797-35.516-145.797-158.14 0-34.926 12.52-63.485 32.965-85.88-3.33-8.078-14.291-40.606 3.083-84.674 0 0 26.87-8.61 88.029 32.8 25.512-7.075 52.878-10.642 80.056-10.76 27.2.118 54.614 3.673 80.162 10.76 61.076-41.386 87.922-32.8 87.922-32.8 17.398 44.08 6.485 76.631 3.154 84.675 20.516 22.394 32.93 50.953 32.93 85.879 0 122.907-74.883 149.93-146.117 157.856 11.481 9.921 21.733 29.398 21.733 59.233 0 42.792-.366 77.28-.366 87.804 0 8.516 5.764 18.473 21.992 15.354 127.076-42.354 218.637-162.274 218.637-303.582 0-176.695-143.269-319.988-320-319.988l-.023.107z"/></svg>
                </a>
            </div>
            <div class="register has-text-link"><a href="{{ url('/register') }}">Not yet registered ? Register</a></div>
        </form>
    </div>
@endsection
