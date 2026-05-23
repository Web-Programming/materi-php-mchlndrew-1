<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk (Halaman Utama)
     */
    public function index()
    {
        $title = "Daftar Produk";
        
        // PERBAIKAN: Menggunakan latest() agar produk baru langsung muncul di Page 1 baris pertama
        $products = Product::latest()->paginate(10);
        
        return view('produk.index', compact('title', 'products'));
    }

    /**
     * Menampilkan form tambah produk
     */
    public function create()
    {
        $title = "Tambah Produk";
        return view('produk.create', compact('title'));
    }

    /**
     * Menyimpan produk baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string', 
            'status' => 'required|in:new,used', // Memastikan sinkron dengan database & view (new/used)
            'is_active' => 'nullable|boolean',
            'release_date' => 'nullable|date',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk maksimal 100 karakter.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka.',
            'price.min' => 'Harga produk tidak boleh negatif.',
            'status.required' => 'Status produk wajib dipilih.',
            'status.in' => 'Status produk harus new atau used.',
            'release_date.date' => 'Format tanggal rilis tidak valid.',
        ]);

        // Konversi nilai checkbox 'is_active' menjadi 1 atau 0
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        
        // Simpan data ke database
        Product::create($validated);
        
        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail produk
     */
    public function show(string $id)
    {
        $title = "Detail Produk";
        $product = Product::findOrFail($id);
        return view('produk.detail', compact('product', 'title'));
    }

    /**
     * Menampilkan form edit produk
     */
    public function edit(string $id)
    {
        $title = "Edit Produk";
        $product = Product::findOrFail($id);
        return view('produk.edit', compact('product', 'title'));
    }

    /**
     * Memperbarui data produk di database
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:new,used',
            'is_active' => 'nullable|boolean',
            'release_date' => 'nullable|date',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk maksimal 100 karakter.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka.',
            'price.min' => 'Harga produk tidak boleh negatif.',
            'status.required' => 'Status produk wajib dipilih.',
            'status.in' => 'Status produk harus new atau used.',
            'release_date.date' => 'Format tanggal rilis tidak valid.',
        ]);

        // Konversi nilai checkbox 'is_active' menjadi 1 atau 0
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        // Perbarui data di database
        $product->update($validated);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Menghapus produk dari database
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Melakukan pencarian produk
     */
    public function search(Request $request)
    {
        $title = "Pencarian Produk";
        $keyword = $request->input('keyword');
        
        $products = Product::when($keyword, function($query, $keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })->latest()->paginate(10); // Menambahkan latest() di sini juga agar pencarian terurut yang terbaru

        return view('produk.search', compact('title', 'products', 'keyword'));
    }
}