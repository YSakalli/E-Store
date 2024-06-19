<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    .container {
    width: 300px;
    margin: 150px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

h1 {
    text-align: center;
}

input[type="email"],
input[type="password"],
input[type="submit"] {
    display: block;
    width: 100%;
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
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
