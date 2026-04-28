@extends('app.master')

@section('title', 'Produk Index')

@section('sidebar')
    @parent
    @section
        <a href="/supplier/create" class="list-group-item list-group-item-action ps-4">Tambah Supplier</a>
        <a href="/supplier/search" class="list-group-item list-group-item-action ps-4">Cari Supplier</a>
    @endsection
@endsection

@section('content')
    <h1 class="h3 mb-3"> Supplier Index</h1>
    <p class="text-muted">Halaman daftar Supplier menggunakan layoutmaster.</p>

    <div class="card">
        <div class="card-body">
            Kontent Supplier bisa ditampilkan disini
        </div>
    </div>
@endsection
