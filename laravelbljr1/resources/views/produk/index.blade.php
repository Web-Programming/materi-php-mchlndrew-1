@extends('app.master')

@section('title', 'Produk Index')

@section('sidebar')
@parent
@section('submenu-produk')
<a href="/produk/create" class="list-group-item list-group-item-action ps-4 
        {{ request()->is('produk/create') ? 'active' : '' }}">Tambah Produk</a>
<a href="/produk/search" class="list-group-item list-group-item-action ps-4 
        {{ request()->is('produk/search') ? 'active' : '' }}">Cari Produk</a>
@endsection
@endsection

@section('content')
<h1 class="h3 mb-3">Produk Index</h1>
<p class="text-muted">Halaman daftar produk menggunakan layout master.</p>

<div class="card">
    <div class="card-body">
        Konten produk bisa ditampilkan di sini.
    </div>
</div>
@endsection