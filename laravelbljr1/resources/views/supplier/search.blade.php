@extends('app.master')

@section('title', 'Pencarian Supplier')

@section('sidebar')
@parent
@section('submenu-supplier')
<a href="{{ route('supplier.create') }}"
    class="list-group-item list-group-item-action ps-4 {{ request()->is('supplier/create') ? 'active' : '' }}">
    <i class="fas fa-plus-circle me-2"></i>Tambah Supplier
</a>
<a href="{{ route('supplier.search') }}"
    class="list-group-item list-group-item-action ps-4 {{ request()->is('supplier/search') ? 'active' : '' }}">
    <i class="fas fa-search me-2"></i>Cari Supplier
</a>
@endsection
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cari Supplier</h1>
        <a href="{{ route('supplier.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('supplier.search') }}" method="GET">
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" name="keyword" class="form-control border-start-0 ps-0"
                        placeholder="Ketik nama atau telepon supplier..." value="{{ request('keyword') }}" autofocus>
                    <button class="btn btn-primary px-4" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    @if(request('keyword'))
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-primary">Hasil Pencarian: "<span class="text-dark">{{
                    request('keyword') }}</span>"</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Supplier</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suppliers as $item)
                        <tr>
                            <td>{{ ($suppliers->currentPage() - 1) * $suppliers->perPage() + $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->address ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('supplier.show', $item->id) }}"
                                    class="btn btn-sm btn-info text-white">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-exclamation-circle fa-2x mb-3"></i><br>
                                Supplier dengan kata kunci "{{ request('keyword') }}" tidak ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($suppliers->hasPages())
            <div class="mt-3">
                {{ $suppliers->appends(['keyword' => request('keyword')])->links() }}
            </div>
            @endif
        </div>
    </div>
    @else
    <div class="card shadow-sm border-0">
        <div class="card-body text-center py-5">
            <i class="fas fa-truck fa-4x text-gray-200 mb-3"></i>
            <h5 class="text-muted">Siap mencari supplier?</h5>
            <p class="text-muted mb-0">Masukkan nama perusahaan atau kontak supplier pada kolom di atas.</p>
        </div>
    </div>
    @endif
</div>
@endsection 