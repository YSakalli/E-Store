@extends('layouts.default')
@section('content')
<style>
   body {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
    padding: 0;
    height: 100vh;
    background-color: #f0f0f0;
}

.container {
    display: grid;
    grid-template-columns: 1fr 3fr;
    width: 75vw;
    height: 600px;
    margin-top: 50px;
}

.filter {
    border: 2px solid black;
    border-radius: 20px;
    max-height: 500px;
    position: sticky;
    top: 100px;
    padding: 20px;
}

.filter h3 {
    margin-bottom: 10px;
}

.filter div {
    margin-bottom: 15px;
}

.filter label {
    display: block;
    margin-bottom: 5px;
}

.filter select,
.filter input[type="number"] {
    width: 90%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.filter button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.filter button:hover {
    background-color: #0056b3;
}

.content {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin: 32px 32px;
    justify-content: center;
}

.product {
    position: relative;
    max-width: 200px;
    min-width: 250px;
    max-height: 330px;
    min-height: 290px;
    background-color: #f8f8f8;
    border-radius: 10px;
    overflow: hidden;
}

.imagediv {
    text-align: center;
}

.imagediv img {
    max-width: 85%;
    height: auto;
}

.price {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 10px;
    text-align: center;
}

.price h1 {
    margin: 0;
}

.add {
    margin-top: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.add p {
    margin: 0;
}

.add input[type="number"] {
    width: 50px;
    padding: 5px;
    text-align: center;
}

.add button {
    background-color: #28a745;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    cursor: pointer;
}

.add button:hover {
    background-color: #218838;
}
</style>

<div class="container">
    <div class="filter">
        <form method="GET" action="{{ route('tshirt') }}">
            <h3>Filter</h3>
            <div>
                <label for="category">Color:</label>
                <select name="category" id="category">
                    <option value="">All</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request()->category == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="min_price">Min Price:</label>
                <input type="number" name="min_price" id="min_price" value="{{ request()->min_price }}">
            </div>
            <div>
                <label for="max_price">Max Price:</label>
                <input type="number" name="max_price" id="max_price" value="{{ request()->max_price }}">
            </div>
            <div>
                <button type="submit">Apply Filter</button>
            </div>
        </form>
    </div>

    <div class="content">
        @forelse($products as $product)
            <div class="product">
                <div class="imagediv">
                    <img src="{{asset('storage/' . $product->image) }}" alt="">
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

                            @if(Auth::check())
                                <input type="hidden" name="userid" value="{{ Auth::user()->name }}">
                            @else
                                <input type="hidden" name="userid" value="guest">
                            @endif

                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No products found.</p>
        @endforelse
    </div>
</div>
@stop
