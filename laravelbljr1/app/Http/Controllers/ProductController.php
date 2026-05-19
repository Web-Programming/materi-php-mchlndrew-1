<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Daftar Produk";
        $products = Product::paginate(10); // ambil 10 data per halaman
        return view('produk.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Produk";
        return view('produk.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validated = $request->validate([
        'name' => 'required|max:150',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'status' => 'required|in:new,used',
        'is_active' => 'nullable|boolean',
        'release_date' => 'nullable|date',

        
    ]);
    $request->validate(
    [
    'name' => 'required|string|max:100',
    ],
    [
    // Format: 'field.aturan' => 'pesan kustom'
    'name.required' => 'Nama produk wajib diisi.',
    'name.max' => 'Nama produk maksimal 100 karakter.',
    'price.required' => 'Harga produk wajib diisi.',
    'price.numeric' => 'Harga produk harus berupa angka.',
    'price.min' => 'Harga produk tidak boleh negatif.',
    'status.required' => 'Status produk wajib dipilih.',
    'status.in' => 'Status produk harus new atau used.',
    'release_date.date'=> 'Format tanggal rilis tidak valid.',
    ]
);
    $validated['is_active'] = $request->has('is_active') ? 1 : 0;

    Product::create($validated);

    return redirect()->route('produk.index')
        ->with('success', 'Produk berhasil ditambahkan.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Detail Produk";
        $product = Product::findOrFail($id); // 404 otomatis jika tidak ditemukan
        return view('produk.detail', compact('product', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Edit Produk";
        $product = Product::findOrFail($id);
        return view('produk.edit', compact('product', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate(
        [
            'name' => 'required|string|max:100',
        ],
        [
            // Format: 'field.aturan' => 'pesan kustom'
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk maksimal 100 karakter.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka.',
            'price.min' => 'Harga produk tidak boleh negatif.',
            'status.required' => 'Status produk wajib dipilih.',
            'status.in' => 'Status produk harus new atau used.',
            'release_date.date'=> 'Format tanggal rilis tidak valid.',
        
        ]
        );
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $product->update($validated);
        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
    public function search()
    {
    return "Halaman Search Produk";
    }
}
