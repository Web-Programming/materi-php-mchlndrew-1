<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Menghitung total seluruh produk
        $totalBarang = Product::count();
        
        // 2. Menggunakan kolom 'is_active' untuk keaktifan produk (1 = aktif, 0 = nonaktif)
        $barangAktif = Product::where('is_active', 1)->count();
        $barangHabis = Product::where('is_active', 0)->count();
        
        // 3. Menghitung berdasarkan kondisi fisik produk pada kolom 'status' ('new' / 'used')
        $barangBaru = Product::where('status', 'new')->count(); 
        $barangBekas = Product::where('status', 'used')->count();
        
        // 4. PENGAMAN FORMAT: Kita buat hitungan bersihnya dulu
        $totalHargaMentah = Product::sum('price') ?? 0;
        $formatRupiah = 'Rp ' . number_format($totalHargaMentah, 0, ',', '.');
        
        // Kita simpan ke dalam kedua nama variabel sebagai bentuk antisipasi/back-up
        $nilaiStok = $formatRupiah;
        $nilaiStokFormat = $formatRupiah;
        
        // 5. Mengambil 5 data produk yang paling terakhir ditambahkan
        $barangTerbaru = Product::latest()->take(5)->get();
        
        // 6. Masukkan semua variabel ke dalam compact()
        return view('dashboard', compact(
            'totalBarang',
            'barangAktif',
            'barangHabis',
            'barangBaru',
            'barangBekas',
            'nilaiStok',       // Cadangan jika Blade memanggil $nilaiStok
            'nilaiStokFormat', // Cadangan jika Blade memanggil $nilaiStokFormat
            'barangTerbaru'
        ));
    }

   
    public function laporanBulanIni()
    {
        $title = "Laporan Produk Bulan Ini";

        
        $bulanSekarang = now()->month;
        $tahunSekarang = now()->year;

        
        $products = Product::whereMonth('release_date', $bulanSekarang)
                           ->whereYear('release_date', $tahunSekarang)
                           ->latest()
                           ->get();

        
        $totalProdukBulanIni = $products->count();
        $totalNilaiBulanIni = $products->sum('price');

        // 4. Kirim data ke halaman view laporan
        return view('laporanbulanini', compact(
            'title', 
            'products', 
            'totalProdukBulanIni', 
            'totalNilaiBulanIni'
        ));
    }
}