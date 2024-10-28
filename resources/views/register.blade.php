<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Outlined" rel="stylesheet">
        <title>I-Commerce</title>
        
    </head>
    <body class="">
        <img class="background" src="{{ asset('backgrounds/SeaofClouds.svg') }}">
        <div class="signup">
            <h2>Register now</h2>
            <h3>Free</h3>
            <form class="form" action="{{ route('register.auth') }}" method="post">
                @csrf
                <div class="textbox">
                    <input type="text" required name="username" id="username">
                    <span class="material-symbols-outlined"> account_circle </span>
                    <label for="username">Username</label>
                </div>
                <div class="textbox">
                    <input type="password" required name="password" id="password">
                    <span class="material-symbols-outlined"> key </span>
                    <label for="password">Password</label>
                </div>
                <div>
                    <button type="submit">register</button>
                </div>
            </form>
            @if($errors->any())

                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach

            @endif
        </div>
    </body>
</html>
