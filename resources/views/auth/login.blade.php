<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body{
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .container{
        background-color: #f8f8f8;
        height: 64vh;
        width: 40vw;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
    }
    .container form{
        width: 80%;
        display: flex;
        flex-direction: column;
    }
    .container form input{

        border: none;
        outline: none;
        height: 32px;
        border-bottom: 2px solid rgba(0, 0, 0, 0.5);
        background-color: #f8f8f8;
        margin-top: 8px;
        font-size: 16px;
    }
    .container form input:last-child {
        border: none;
        color: white;
        border-radius: 10px;

        font-size: 14px;
        background-color: #2196f3;
        margin-top: 16px;
        height: 32px;

    }
    @media only screen and (max-width: 480px) {
    /* Mobil*/
    .container{
        width: 90vw;
    }
}
@media only screen and (min-width: 481px) and (max-width: 768px) {
    /* Tabletler */
    .container{
        width: 90vw;
    }
}
</style>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="{{route('login')}}" method="post">
            @csrf
            <input type="email" name="email" placeholder="Mail">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="Kayit Ol">
        </form>
    </div>
</body>
</html>
