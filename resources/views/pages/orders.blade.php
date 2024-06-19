@extends('layouts.default')

@section('content')
<style>
    /* Genel Stil */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f9;
    color: #333;
    margin: 0;
    padding: 0;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Başlık */
h1 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 2.5em;
    color: #5d5d5d;
}

/* Tablo Stili */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}

.table th, .table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.table th {
    background-color: #007bff;
    color: white;
    font-weight: bold;
}

.table tr:hover {
    background-color: #f1f1f1;
}

/* Buton Stili */
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

/* Form Kontrol */
.form-control {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #ced4da;
    border-radius: 5px;
}

/* Başarı Mesajı */
.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: center;
}

</style>
<div class="container">
    <h1>Siparişler</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Sipariş ID</th>
                <th>Kullanıcı</th>
                <th>Toplam Fiyat</th>
                <th>Durum</th>
                <th>Ürünler</th>
                @if (auth()->user()->is_admin)
                    <th>Durum Güncelle</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->total_price }} ₺</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <ul>
                            @foreach ($order->orderItems as $item)
                                <li>{{ $item->product->name }} - {{ $item->quantity }} adet - {{ $item->price }} ₺</li>
                            @endforeach
                        </ul>
                    </td>
                    @if (auth()->user()->is_admin)
                        <td>
                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                <select name="status" class="form-control">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Beklemede</option>
                                    <option value="approved" {{ $order->status == 'approved' ? 'selected' : '' }}>Onaylandı</option>
                                    <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>Reddedildi</option>
                                </select>
                                <button type="submit" class="btn btn-primary mt-2">Güncelle</button>
                            </form>
                        </td>

                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
