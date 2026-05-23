@extends('template')

@section('content')

<h1>{{ $title }}</h1>
@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('produk.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nama Produk</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $product->name) }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Harga</label><br>
        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
            value="{{ old('price', $product->price) }}">
        @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Deskripsi</label><br>
        <textarea name="description" id="description"
            class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <label>Status</label><br>
    <select name="status" class="form-control">
        <option value="new" {{ old('status', $product->status) == 'new' ? 'selected' : '' }}>New</option>
        <option value="used" {{ old('status', $product->status) == 'used' ? 'selected' : '' }}>Used</option>
    </select><br><br>

    <label>Aktif</label>
    <input type="checkbox" name="is_active" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
    <br><br>

    <label>Tanggal Rilis</label><br>
    <input type="date" name="release_date" class="form-control @error('release_date') is-invalid @enderror"
        value="{{ old('release_date', $product->release_date) }}">
    @error('release_date')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <br>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection