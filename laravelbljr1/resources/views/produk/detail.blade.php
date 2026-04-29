@extends('template')

@section('title', 'Ini Halam Detail')

@section('navbar')
@parent
<b>Ini Bisa Diisi Navbar Tambahan<b>
        @endsection

        @section('content')
        <h2>Ini Halaman Detail Produk<h2>
                Nama Produk : <b>{{ $product_name }}</b><br />
                Id : <b>{{ $id }}</b>


                <hr />
                @for ($i = 0; $i
                < 5; $i++) Data {{ $i }} <br />
                @endfor
                @endsection