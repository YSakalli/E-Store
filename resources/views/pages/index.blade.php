@extends('layouts.default')

@section('content')
<div class="container">
    <h1>Kategoriler</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    @if ($categories->isEmpty())
        <p>Henüz bir kategori yok.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>İsim</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="new-category">
        <h2>Yeni Kategori Ekle</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Kategori İsmi</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success mt-2">Ekle</button>
        </form>
    </div>
</div>
@endsection

<style>
    .container {
        max-width: 800px;
        margin: 150px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .container h1 {
        text-align: center;
        margin-bottom: 30px;
    }

    .btn-primary {
        margin-bottom: 20px;
    }

    .alert {
        margin-top: 20px;
        padding: 15px;
        border-radius: 4px;
    }

    .table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px;
        border: 1px solid #ddd;
    }

    .table th {
        background-color: #f4f4f4;
    }

    .new-category {
        margin-top: 40px;
    }

    .new-category h2 {
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .btn-success {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
    }

    .btn-danger {
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
    }
</style>
