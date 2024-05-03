<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<style>
    body{
        overflow-x: hidden;
        font-family: "Helvetica", sans-serif;
    }
</style>
<body>
    <div>
    @include('includes.navigation')
    </div>
    <div>
        @yield('content')
    </div>
    <div>
        @include('includes.footer')
    </div>
</body>
</html>
