@extends('app.master')
@section('title', $title)
@section('sidebar')
@parent
@section('submenu-produk')
<a href="/produk/create" class="list-group-item list-group-item-action ps-4 
        {{ request()->is('produk/create') ? 'active' : '' }}">Tambah
    Produk</a>
<a href="/produk/search" class="list-group-item list-group-item-action ps-4 
        {{ request()->is('produk/search') ? 'active' : '' }}">Cari
    Produk</a>
@endsection
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $title }}</h1>
        <a href="{{ url('/produk') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Produk</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th width="200">ID</th>
                    <td>{{ $product->id }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $product->description ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-{{ $product->status === 'new' ? 'success' : 'secondary' }}">
                            {{ $product->status === 'new' ? 'Baru' : 'Bekas' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Aktif</th>
                    <td>
                        <span class="badge bg-{{ $product->is_active ? 'success' : 'danger' }}">
                            {{ $product->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Rilis</th>
                    <td>{{ $product->release_date ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Dibuat</th>
                    <td>{{ $product->created_at }}</td>
                </tr>
                <tr>
                    <th>Diperbarui</th>
                    <td>{{ $product->updated_at }}</td>
                </tr>
            </table>


        </div>
        <div class="card-footer">
            <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('produk.edit', $product->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection