@extends('layouts.default')

@section('content')
<style>
    /* Genel Stiller */
    .container {
        max-width: 1200px;
        margin: 100px auto;
        padding: 20px;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .table th {
        background-color: #f4f4f4;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .alert {
        margin-top: 20px;
        padding: 15px;
        background-color: #dff0d8;
        color: #3c763d;
        border: 1px solid #d6e9c6;
        border-radius: 4px;
    }

    /* Durum Renklendirme */
    .table .status-pending {
        background-color: #f0ad4e; /* Turuncu tonu */
        color: #fff;
    }

    .table .status-approved {
        background-color: #5cb85c; /* Yeşil tonu */
        color: #fff;
    }

    .table .status-rejected {
        background-color: #d9534f; /* Kırmızı tonu */
        color: #fff;
    }

    /* İptal Butonu Stili */
    .btn-cancel {
        background-color: #d9534f; /* Kırmızı tonu */
        color: #fff;
        border: none;
        padding: 6px 12px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-cancel:hover {
        background-color: #c9302c; /* Koyu kırmızı tonu */
    }
</style>

<div class="container">
    <h1>Siparişlerim</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($orders->isEmpty())
        <p>Henüz bir siparişiniz yok.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Sipariş ID</th>
                    <th>Toplam Fiyat</th>
                    <th>Durum</th>
                    <th>Ürünler</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->total_price }} ₺</td>
                        <td class="status-{{ $order->status }}">
                            @if ($order->status == 'pending')
                                Beklemede
                            @elseif ($order->status == 'approved')
                                Onaylandı
                            @elseif ($order->status == 'rejected')
                                Reddedildi
                            @endif
                        </td>
                        <td>
                            <ul>
                                @foreach ($order->orderItems as $item)
                                    <li>{{ $item->product->name }} - {{ $item->quantity }} adet - {{ $item->price }} ₺</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            @if ($order->status == 'pending')
                                <form action="{{ route('order.cancel', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-cancel">İptal Et</button>
                                </form>
                            @elseif ($order->status == 'approved')
                                <p>Sipariş onaylandı. İptal edilemez.</p>
                            @elseif ($order->status == 'rejected')
                                <p>Sipariş reddedildi. İptal edilemez.</p>
                            @elseif ($order->status == 'cancelled')
                                <p>Sipariş iptal edildi.</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
