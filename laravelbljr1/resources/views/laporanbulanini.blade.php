@extends('app.master')

@section('title', 'Laporan Bulan Ini')

@section('sidebar')
@parent
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800">{{ $title }}</h1>
            <p class="text-muted small mb-0">Periode: <strong>{{ now()->translatedFormat('F Y') }}</strong></p>
        </div>
        {{-- Tombol Cetak (Opsional untuk variasi) --}}
        <button onclick="window.print()" class="btn btn-secondary btn-sm shadow-sm">
            <i class="bi bi-printer me-1"></i> Cetak Laporan
        </button>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small d-block text-uppercase fw-bold">Produk Baru Masuk</span>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalProdukBulanIni }} Barang</h3>
                    </div>
                    <i class="bi bi-box-seam fs-2 text-primary opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small d-block text-uppercase fw-bold">Estimasi Nilai Investori</span>
                        <h3 class="fw-bold mb-0 text-dark">Rp {{ number_format($totalNilaiBulanIni, 0, ',', '.') }}</h3>
                    </div>
                    <i class="bi bi-currency-dollar fs-2 text-success opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3" style="width: 5%">No</th>
                            <th>Nama Barang</th>
                            <th>Tanggal Rilis</th>
                            <th>Status Fisik</th>
                            <th class="pe-3 text-end">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $index => $item)
                        <tr>
                            <td class="ps-3 text-muted">{{ $index + 1 }}</td>
                            <td class="fw-medium text-dark">{{ $item->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->release_date)->translatedFormat('d F Y') }}</td>
                            <td>
                                <span
                                    class="badge bg-opacity-10 text-{{ $item->status === 'new' ? 'success bg-success' : 'secondary bg-secondary' }} px-2 py-1">
                                    {{ $item->status === 'new' ? 'Baru' : 'Bekas' }}
                                </span>
                            </td>
                            <td class="pe-3 text-end fw-bold text-dark">Rp {{ number_format($item->price, 0, ',', '.')
                                }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="bi bi-clipboard-x display-6 d-block mb-2 text-opacity-25"></i>
                                Tidak ada data produk yang diinput pada bulan ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection