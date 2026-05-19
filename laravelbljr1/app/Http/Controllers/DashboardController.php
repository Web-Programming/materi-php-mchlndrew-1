<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Menghitung total semua barang
        $totalBarang = Product::count();
        
        // 2. Menghitung status berdasarkan value dari form ('new' / 'used')
        $barangBaru = Product::where('status', 'new')->count();
        $barangBekas = Product::where('status', 'used')->count();
        
        // 3. Menghitung produk yang aktif (dari checkbox is_active kemarin)
        $barangAktif = Product::where('is_active', 1)->count();
        
        // 4. Menghitung nilai stok menggunakan kolom 'price' (sesuai input form)
        $nilaiStok = 'Rp ' . number_format(Product::sum('price'), 0, ',', '.');
        
        // 5. Mengambil 5 produk terbaru
        $barangTerbaru = Product::latest()->take(5)->get();
        
        return view('Dashboard.dashboard', compact(
            'totalBarang',
            'barangBaru',
            'barangBekas',
            'barangAktif',
            'nilaiStok',
            'barangTerbaru'
        ));
    }   
}
