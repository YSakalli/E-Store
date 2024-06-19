<style>
/* Genel Stil */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f9;
    color: #333;
    margin: 0;
    padding: 0;
}

/* Navigation Bar */
nav {
    top: 0;
    left: 0;
    right: 0;
    position: fixed;
    width: 100%;
    height: 50px;
    background-color: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(2px);
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    box-shadow: 0px 0px 10px 0px rgba(1, 1, 1, 0.2);
    z-index: 10;
}

.logo img {
    left: 50%;
    width: 80px;
    position: absolute;
    transform: translate(-50%);
    top: 0px;
}

.cart {
    display: flex;
    justify-content: end;
    margin-right: 16px;
    align-items: center;
    gap: 20px;
    position: relative;
}

.cart img {
    width: 24px;
}

.cart a {
    text-decoration: none;
    color: black;
}

.menu {
    display: flex;
    align-items: center;
    margin-left: 16px;
    cursor: pointer;
}

.menu img {
    width: 24px;
}

.aside {
    position: absolute;
    left: -600px;
    height: 100vh;
    width: 30vw;
    background: #f8f8f8;
    display: flex;
    justify-content: center;
    transition: 400ms;
}

.aside.active {
    left: 0;
}

.aside.active .menudarkness {
    display: flex;
}

.aside .close {
    cursor: pointer;
    position: absolute;
    right: 32px;
    top: 24px;
    z-index: 100;
}

.aside .close img {
    width: 24px;
}

.aside .menudarkness {
    display: none;
    position: fixed;
    background-color: rgba(1, 1, 1, 0.2);
    height: 100vh;
    width: 100vw;
    top: 0;
    left: 0;
    z-index: -1;
}

.aside .link {
    margin-top: 64px;
    display: flex;
    flex-direction: column;
    width: 100%;
    text-align: center;
}

.aside .link a {
    color: black;
    text-decoration: none;
    position: relative;
    padding: 8px 0;
    width: 100%;
    background-color: #f8f8f8;
    display: flex;
    justify-content: center;
    align-items: center;
}

.aside .link a img {
    width: 24px;
    height: 24px;
    margin-right: 8px;
}

.aside .link h1 {
    font-size: 32px;
}

.aside .link a:hover {
    background-color: #f0f0f0;
    transition: 400ms;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
}

.dropdown:hover .dropdown-content {
    display: block;
}

@media only screen and (max-width: 480px) {
    /* Mobil */
    .aside {
        width: 100vw;
    }
}

@media only screen and (min-width: 481px) and (max-width: 768px) {
    /* Tabletler */
    .aside {
        width: 50vw;
    }
}

</style>
<nav>
    <div class="menu">
        <img src="{{ asset('assets/menu.png') }}" alt="Menu">
    </div>

    <div class="aside">
        <div class="menudarkness"></div>

        <div class="close">
            <img src="{{ asset('assets/close.png') }}" alt="Close">
        </div>

        <div class="link">
            <h1>Category</h1>
            <a href="{{route('tshirt')}}"><img src="{{ asset('assets/shirt.png') }}" alt="TShirt"><h3>T-Shirt</h3></a>
            <a href="{{route('sweatshirt')}}"><img src="{{ asset('assets/hoodie.png') }}" alt="Sweatshirt"><h3>Sweatshirt</h3></a>
            <a href="{{route('pant')}}"><img src="{{ asset('assets/pants.png') }}" alt="Pant"><h3>Pant</h3></a>
            <a href="{{route('backpack')}}"><img src="{{ asset('assets/backpack.png') }}" alt="Backpack"><h3>Backpack</h3></a>
        </div>
    </div>

    <div class="logo">
        <a href="{{route('index')}}"><img src="{{ asset('assets/logo.png') }}" alt="Logo"></a>
    </div>

    <div class="cart">
        @guest
        <a href="{{route('login')}}">Login</a>
        @else
        <div class="dropdown">
            <p>Merhaba, {{ Auth::user()->name }}!</p>
            <div class="dropdown-content">
                @if(auth()->user()->is_admin)
                    <a href="{{route('addproduct')}}">Ürün Ekle</a>
                    <a href="{{route('orders.index')}}">Gelen Siparişler</a>
                @endif
                <a href="{{route('user.orders')}}">Siparişlerim</a>
                <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        @endguest
        <a href="{{route('cart')}}"><img src="{{ asset('assets/shopping-cart.png') }}" alt="cart"></a>
    </div>
</nav>
<script>
    var menuToggle = document.querySelector('.menu');
    var closeToggle = document.querySelector('.close');
    var aside = document.querySelector('.aside');
    var menudarkness = document.querySelector('.menudarkness');

    menuToggle.addEventListener("click", function(){
        aside.classList.add('active');
    });

    closeToggle.addEventListener("click", function(){
        aside.classList.remove('active');
    });

    menudarkness.addEventListener("click", function(){
        aside.classList.remove('active');
    });
</script>
