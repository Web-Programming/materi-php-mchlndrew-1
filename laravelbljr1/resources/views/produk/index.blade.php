@extends('app.master')

@section('title', $title)

@section('sidebar')
@parent
@endsection

@section('submenu-produk')
<a href="/produk/create"
    class="list-group-item list-group-item-action ps-4 {{ request()->is('produk/create') ? 'active' : '' }}">
    <i class="fas fa-plus-circle me-2"></i>Tambah Produk
</a>
<a href="/produk/search"
    class="list-group-item list-group-item-action ps-4 {{ request()->is('produk/search') ? 'active' : '' }}">
    <i class="fas fa-search me-2"></i>Cari Produk
</a>
@endsection

@section('content')
{{-- Pembungkus utama kita beri ID agar AJAX bisa memperbarui area ini saja --}}
<div class="container-fluid mt-4" id="ajax-product-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        @can('create-product')
        <a href="{{ route('produk.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm"></i> Tambah Produk
        </a>
        @endcan
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aktif</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $item)
                        <tr>
                            <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                            <td>{{ $item->name }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $item->status === 'new' ? 'success' : 'secondary' }}">
                                    {{ $item->status === 'new' ? 'Baru' : 'Bekas' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $item->is_active ? 'success' : 'danger' }}">
                                    {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('produk.show', $item->id) }}"
                                    class="btn btn-sm btn-info text-white">Detail</a>
                                <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $item->id }}">
                                    Hapus
                                </button>

                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Konfirmasi
                                                    Hapus</h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start" style="white-space: normal;">
                                                <p class="mb-0">Apakah Anda yakin ingin menghapus produk <strong>{{
                                                        $item->name }}</strong>?</p>
                                                <p class="text-muted small mb-0">Tindakan ini tidak dapat dibatalkan.
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('produk.destroy', $item->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Tidak ada data produk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center px-2">
        <div class="text-muted small">
            Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }}
            results
        </div>
        <div class="pagination-wrapper">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

{{-- SCRIPT AJAX PENGHANCUR PANTULAN LAYAR --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const container = document.getElementById('ajax-product-container');

        // Menangkap seluruh event klik di dalam kontainer produk
        container.addEventListener('click', function (e) {
            // Cari tahu apakah yang diklik adalah tombol link pagination
            const targetLink = e.target.closest('.pagination a, .page-item a');

            if (targetLink) {
                e.preventDefault(); // Stop browser agar TIDAK melakukan reload halaman penuh

                const url = targetLink.getAttribute('href');
                if (!url || url === '#') return;

                // Set efek transparan tipis saat data sedang dimuat (efek loading halus)
                container.style.opacity = '0.5';

                // Lakukan request data ke server di balik layar (AJAX)
                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.text())
                    .then(html => {
                        // Buat penampung html sementara
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        // Ambil konten baru dari respon server
                        const newContent = doc.getElementById('ajax-product-container').innerHTML;

                        // Suntikkan konten baru ke halaman tanpa refresh browser
                        container.innerHTML = newContent;

                        // Kembalikan kejelasan warna kontainer
                        container.style.opacity = '1';

                        // Perbarui URL browser di atas secara senyap tanpa memicu refresh
                        window.history.pushState({}, '', url);
                    })
                    .catch(error => {
                        console.error('Gagal memuat data pagination:', error);
                        container.style.opacity = '1';
                    });
            }
        });
    });
</script>
@endsection