@extends('app.master')

@section('title', $title)

{{-- Perbaikan: Section sidebar dan submenu dipisah secara sejajar --}}
@section('sidebar')
@parent
@endsection

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

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        <a href="{{ route('supplier.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('supplier.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Nama Supplier</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Masukkan nama supplier" value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">No. Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                placeholder="Contoh: 08123456789" value="{{ old('phone') }}">
                        </div>
                        @error('phone')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Email Supplier</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Contoh: supplier@toko.com" value="{{ old('email') }}">
                        </div>
                        @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Alamat Lengkap</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3"
                        placeholder="Masukkan alamat lengkap supplier...">{{ old('address') }}</textarea>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="fas fa-save"></i> Simpan Supplier
                    </button>
                    <button type="reset" class="btn btn-outline-secondary px-4">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection