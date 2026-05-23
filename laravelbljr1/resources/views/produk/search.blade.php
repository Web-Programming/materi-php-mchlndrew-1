@extends('app.master')

@section('title', 'Pencarian Produk')

@section('sidebar')
@parent
{{-- Memastikan urutan submenu tetap: Tambah baru Cari --}}
@section('submenu-produk')
{{-- Tombol Tambah Produk --}}
<a href="{{ route('produk.create') }}"
    class="list-group-item list-group-item-action ps-4 {{ request()->is('produk/create') ? 'active' : '' }}">
    <i class="fas fa-plus-circle me-2"></i>Tambah Produk
</a>
{{-- Tombol Cari Produk (Biru karena kita di halaman search) --}}
<a href="{{ route('produk.search') }}"
    class="list-group-item list-group-item-action ps-4 {{ request()->is('produk/search') ? 'active' : '' }}">
    <i class="fas fa-search me-2"></i>Cari Produk
</a>
@endsection
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cari Produk</h1>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('produk.search') }}" method="GET">
                <div class="input-group input-group-lg">
                    <input type="text" name="keyword" class="form-control"
                        placeholder="Ketik nama produk lalu tekan Enter..." value="{{ request('keyword') }}" autofocus>
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if(request('keyword'))
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h6 class="mb-0 font-weight-bold text-primary">
                Hasil Pencarian untuk: "<span class="text-dark">{{ request('keyword') }}</span>"
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $item)
                        <tr>
                            <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('produk.show', $item->id) }}" class="btn btn-sm btn-info text-white">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Produk tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
            <div class="mt-4">
                {{ $products->appends(['keyword' => request('keyword')])->links() }}
            </div>
            @endif
        </div>
    </div>
    @else
    <div class="card shadow-sm border-0">
        <div class="card-body text-center py-5">
            <i class="fas fa-search fa-4x text-gray-200 mb-3"></i>
            <p class="text-muted mb-0">Silakan masukkan kata kunci untuk mulai mencari produk.</p>
        </div>
    </div>
    @endif
</div>
@endsection