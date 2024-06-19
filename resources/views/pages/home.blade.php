@extends('layouts.default')
@section('content')
<style>
    body {
        background-color: #f5f5f5;
        font-family: Arial, sans-serif;
    }
    .container {
        display: flex;
        justify-content: center;
        margin-top: 100px;
        height: auto;
        gap: 64px;
        flex-wrap: wrap;
    }
    .container h1 {
        width: 100%;
        text-align: center;
        margin-bottom: 50px;
        font-size: 2.5rem;
        color: #333;
    }
    .promotion {
        background-color: #fff;
        width: 28vw;
        height: auto;
        padding: 20px;
        position: relative;
        bottom: 32px;
        display: flex;
        flex-direction: column;
        border-radius: 20px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .promotion:hover {
        transform: translateY(-10px);
        box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.2);
    }
    .promotion .imgdiv {
        width: 100%;
        height: 200px;
        position: relative;
        margin-bottom: 20px;
    }
    .promotion .imgdiv img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
    }
    .promotion .content h1 {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 10px;
    }
    .promotion .content p {
        color: #777;
        margin-bottom: 20px;
    }
    .promotion .content a {
        text-decoration: none;
        background-color: #007BFF;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    .promotion .content a:hover {
        background-color: #0056b3;
    }

    @media only screen and (max-width: 480px) {
        .container {
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }
        .promotion {
            width: 80vw;
            height: auto;
        }
        .container h1 {
            font-size: 1.5rem;
        }
    }
    @media only screen and (min-width: 481px) and (max-width: 768px) {
        .container {
            flex-direction: column;
            align-items: center;
        }
        .promotion {
            width: 80vw;
        }
    }

    /* Giriş ve çıkış yap CSS stili */
    .auth-container {
        width: 100%;
        text-align: center;
        margin-bottom: 30px;
    }
    .auth-container a, .auth-container .btn-logout {
        text-decoration: none;
        background-color: #007BFF;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        font-size: 1rem;
        margin: 0 10px;
        display: inline-block;
    }
    .auth-container a:hover, .auth-container .btn-logout:hover {
        background-color: #0056b3;
    }
    .auth-container .welcome-message {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 20px;
    }
    .auth-container .btn-logout {
        background-color: #d9534f;
        border: none;
        cursor: pointer;
    }
    .auth-container .btn-logout:hover {
        background-color: #c9302c;
    }
</style>

<div class="container">
    <div class="auth-container">
        @guest
            <h1> <a href="{{ route('login') }}">giriş yapın</a> <a href="{{ route('register') }}">kaydolun</a></h1>
        @else
            <div class="welcome-message">
                Merhaba, @if(auth()->user()->is_admin) Admin @endif {{ Auth::user()->name }}!
            </div>

        @endguest
    </div>

    <div class="promotion">
        <div class="imgdiv">
            <img src="{{asset('assets/tshirt.png')}}" alt="tshirt">
        </div>
        <div class="content">
            <h1>Kiyafet</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur, earum.</p>
            <a href="{{route('tshirt')}}">Satın Al</a>
        </div>
    </div>

    <div class="promotion">
        <div class="imgdiv">
            <img src="{{asset('assets/tshirt.png')}}" alt="tsirt">
        </div>
        <div class="content">
            <h1>Kiyafet</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur, earum.</p>
            <a href="{{route('tshirt')}}">Satın Al</a>
        </div>
    </div>
</div>

@stop
