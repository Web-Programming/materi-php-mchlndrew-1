@extends('app.master')

@section('title', 'Tambah Produk')

@section('sidebar')
@parent
@endsection

@section('submenu-produk')
<a href="{{ route('produk.create') }}"
    class="list-group-item list-group-item-action ps-4 {{ request()->is('produk/create') ? 'active' : '' }}">
    <i class="fas fa-plus-circle me-2"></i>Tambah Produk
</a>

<a href="/produk/search"
    class="list-group-item list-group-item-action ps-4 {{ request()->is('produk/search') ? 'active' : '' }}">
    <i class="fas fa-search me-2"></i>Cari Produk
</a>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('produk.store') }}" method="POST">
                @csrf

                {{-- Input Nama Produk --}}
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Nama Produk</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Masukkan nama produk" value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Input Harga (Sudah Diperbaiki Struktur Input Group-nya) --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Harga</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                placeholder="0" value="{{ old('price') }}">
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Input Tanggal Rilis --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Tanggal Rilis</label>
                        <input type="date" name="release_date"
                            class="form-control @error('release_date') is-invalid @enderror"
                            value="{{ old('release_date') }}">
                        @error('release_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Input Deskripsi --}}
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3"
                        placeholder="Tambahkan keterangan produk...">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    {{-- Input Status --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="new" {{ old('status')=='new' ? 'selected' : '' }}>Baru (New)</option>
                            <option value="used" {{ old('status')=='used' ? 'selected' : '' }}>Bekas (Used)</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Checkbox Is Active --}}
                    <div class="col-md-6 mb-3 d-flex align-items-end">
                        <div class="form-check mb-2">
                            {{-- Modifikasi old() agar default bernilai checked saat pertama kali halaman dibuka --}}
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{
                                old('is_active', '1' )=='1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Produk Aktif dan Ditampilkan
                            </label>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="fas fa-save"></i> Simpan Produk
                    </button>
                    <button type="reset" class="btn btn-outline-secondary px-4">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection