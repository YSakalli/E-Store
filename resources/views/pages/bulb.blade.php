@extends('layouts.default')
@section('content')
    <form action="{{"iletisim-sonuc"}}" method="post">
        @csrf
        <label for="">Ad Soyad</label><br>
        <input type="text" name="adsoyad"><br>
        <label for="">Mail</label><br>
        <input type="text" name="mail"><br>
        <label for="">Telefon</label><br>
        <input type="text" name="telefon"><br>
        <label for="">Metin</label><br>
    <textarea name="metin" id="" cols="30" rows="10"></textarea><br>
    <input type="submit" name="ilet" value="gonder">
    </form>
@stop
