<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * GET /api/products
     * Menampilkan semua produk (dengan pagination)
     */
    public function index(): JsonResponse
    {
        $products = Product::paginate(10);

        return response()->json([
            'status'  => 'success',
            'message' => 'Daftar produk berhasil diambil.',
            'data'    => $products,
        ], 200);
    }

    /**
     * POST /api/products
     * Menyimpan produk baru
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:100',
            'price'        => 'required|numeric|min:0',
            'description'  => 'nullable|string',
            'status'       => 'required|in:new,used',
            'is_active'    => 'nullable|boolean',
            'release_date' => 'nullable|date',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Produk berhasil ditambahkan.',
            'data'    => $product,
        ], 201); // 201 = Created
    }

    /**
     * GET /api/products/{id}
     * Menampilkan detail satu produk
     */
    public function show(string $id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Produk tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Detail produk berhasil diambil.',
            'data'    => $product,
        ], 200);
    }

    /**
     * PUT /api/products/{id}
     * Memperbarui data produk
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Produk tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'name'         => 'required|string|max:100',
            'price'        => 'required|numeric|min:0',
            'description'  => 'nullable|string',
            'status'       => 'required|in:new,used',
            'is_active'    => 'nullable|boolean',
            'release_date' => 'nullable|date',
        ]);

        $product->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Produk berhasil diperbarui.',
            'data'    => $product,
        ], 200);
    }

    /**
     * DELETE /api/products/{id}
     * Menghapus produk
     */
    public function destroy(string $id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Produk tidak ditemukan.',
            ], 404);
        }

        $product->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Produk berhasil dihapus.',
        ], 200);
    }
}