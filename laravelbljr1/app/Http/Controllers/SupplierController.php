<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::paginate(5);

        return view('supplier.index', [
            'title' => 'Daftar Supplier',
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // PERBAIKAN: Mengembalikan view form dan mengirimkan variabel $title
        return view('supplier.create', [
            'title' => 'Tambah Supplier Baru'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // PERBAIKAN: Validasi data yang dikirim dari form create.blade.php
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:15',
            'email'   => 'required|email|unique:suppliers,email',
            'address' => 'required|string',
        ], [
            // Custom pesan error bahasa Indonesia
            'name.required'    => 'Nama supplier wajib diisi.',
            'phone.required'   => 'Nomor telepon wajib diisi.',
            'email.required'   => 'Email wajib diisi.',
            'email.unique'     => 'Email ini sudah terdaftar.',
            'address.required' => 'Alamat lengkap wajib diisi.',
        ]);

        // Simpan data ke database melalui Model Supplier
        Supplier::create([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'address' => $request->address,
        ]);

        // Redirect kembali ke halaman daftar supplier dengan pesan sukses
        return redirect()->route('supplier.index')->with('success', 'Data supplier berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('supplier.detail', [
            'id' => $id,
            'title' => 'Detail Supplier',
            'supplier' => $supplier
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Nantinya diisi untuk mengambil data lama sebelum di-update
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', [
            'title' => 'Edit Data Supplier',
            'supplier' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Nantinya diisi untuk memproses update data
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Nantinya diisi untuk menghapus data supplier
    }

    /**
     * PERBAIKAN NYATA: Menangani pencarian data supplier
     */
    public function search(Request $request)
    {
        $title = "Pencarian Supplier";
        $keyword = $request->input('keyword');

        // Mencari berdasarkan nama supplier yang mirip dengan keyword
        $suppliers = Supplier::when($keyword, function($query, $keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })->paginate(5);

        return view('supplier.search', compact('title', 'suppliers', 'keyword'));
    }
}   