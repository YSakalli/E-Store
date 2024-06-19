<form method="POST" action="{{ route('register') }}">
    @csrf

    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <input type="password" name="password_confirmation" placeholder="Confirm Password">

    <button type="submit">Register</button>
</form>
<style>
    form {
    width: 400px;
    margin: 150px auto;
    padding: 30px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    display: block;
    width: calc(100% - 22px);
    margin-bottom: 20px;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
}

button[type="submit"] {
    display: block;
    width: 100%;
    padding: 15px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

</style>
