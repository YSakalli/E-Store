@extends('layouts.default')
@section('content')
<style>
    body{
        display: flex;
        justify-content: center;
        align-content: center;
    }
.container{
    margin-top: 150px;
    display: grid;
    grid-template-columns: 1fr 3fr;
    width: 75vw;
    height: 600px;

}
.container .filter{
border: 2px black solid;
border-radius: 20px;
max-height: 500px;
position: sticky;
top: 100px;
}

.container .content{
display: flex;
flex-wrap: wrap;
gap: 50px;
margin: 32px 32px;
justify-content: center
}
.container .content .product{
max-width: 300px;
min-width: 200px;
max-height: 300px;
min-height: 200px;
background-color: #f8f8f8;
display: grid;
grid-template-rows: 3fr 1fr;
}
.container .content .product .imagediv{
width: 200px;
}
.container .content .product .imagediv img{
width: 200px;
}

.container .content .product .price{
}
.container .content .product .price .add{
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 30px;
}
.container .content .product .price .add button{
    height: 20px;
    width: 100px;
}

.container .content .product .price h1{
    text-align: center;
    font-size: 24px;
    margin: 0;
}
</style>

<div class="container">
<div class="filter"></div>

<div class="content">
@foreach($products as $product)
        <div class="product">
            <div class="imagediv">
                <img src="{{asset('assets/tshirt.png')}}" alt="">
            </div>
            <div class="price">
                <h1>{{ $product->name }}</h1>
                <div class="add">
                    <p>Price: ${{ $product->price }}</p>
                    <form method="POST" action="{{ route('cart.add') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <label for="quantity_{{ $product->id }}">Quantity:</label>
                        <input type="number" id="quantity_{{ $product->id }}" name="quantity" value="1" min="1">
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
@endforeach

</div>

</div>

@stop
