@extends('layouts.default')
@section('content')
<style>
    .container{
        display: flex;
        justify-content: center;
        margin-top: 320px;
        height: 100vh;
        gap: 64px;
    }
    .container h1 {
        position: absolute;
        z-index: -2;
        top: 96px;
    }

    .promotion{
        background-color: #f8f8f8;
        width: 28vw;
        height: 500px;
        position: relative;
        bottom:32px;
        display: flex;
        justify-content: center;
        flex-direction: column;
        border-radius: 20px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);

    }
    .promotion .imgdiv{
        width: 90%;
        height: 60%;
        position: relative;
        top: -144px;
        margin: auto;

    }
    .promotion .imgdiv img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;

    }

    .promotion:last-child{

        top:32px;
    }
    @media only screen and (max-width: 480px) {
    /* Mobil*/
    .container{
        flex-direction:column;
        align-items: center;
    }
    .promotion{
        width: 80vw;
        height: 400px;
    }
    .container h1{
        font-size:24px ;
    }
    }
    @media only screen and (min-width: 481px) and (max-width: 768px) {
        /* Tabletler */
        .container{
        flex-direction:column;
        align-items: center;
    }
    .promotion{
        width: 80vw;
    }

    }
</style>

<div class="container">
    <h1>Bütün Elektirik Malzemeleri</h1>

    <div class="promotion">
        <div class="imgdiv">
            <img src="{{asset('assets/promotion.webp')}}" alt="">
        </div>
        <div class="content">
            <h1>Lamba</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur, earum.</p>
            <a href="">Satin al</a>
        </div>
    </div>

    <div class="promotion">
        <div class="imgdiv">
            <img src="{{asset('assets/wire.webp')}}" alt="">
        </div>

            <div class="content">
                <h1>Lamba</h1>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur, earum.</p>
                <a href="">Satin al</a>
            </div>
    </div>

</div>

@stop
