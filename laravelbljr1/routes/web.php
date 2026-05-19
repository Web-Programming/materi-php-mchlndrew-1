<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

// ==================== ROUTE LATIHAN AWAL ====================
Route::get('/latihan', function () {
    echo "Hallo, Nama Saya Andrew";
});

Route::get('/alamat', function(){
    echo "Jalan Kolonel Atmo 14. Palembang";
});

Route::get('/path1/path2/detail', function(){
    echo "Jalan Kolonel Atmo 14<br>Rt. 01 Rw. 02<br>Ilir Barat I<br>Kota Palembang<br>Provinsi Sumatera Selatan";
});

Route::get('/user/{id}', function($id){ echo "User ID: " . $id; });
Route::get('/user2/{name}', function($name){ echo "User Name: " . $name; });
Route::get('/user3/{name?}', function($name = 'Tamu'){ echo "User Name: " . $name; });
Route::get('/user4/{id}/{name}', function($id, $name){ echo "User ID: " . $id . "<br>User Name: " . $name; });

Route::post('/simpan', function(){ echo "Data berhasil disimpan"; });
Route::put('/update/{id}', function($id){ echo "Data berhasil diperbarui dengan ID: " . $id; });
Route::patch('/update2/{id}', function($id){ echo "Data berhasil diperbarui dengan ID: " . $id; });
Route::delete('/hapus/{id}', function($id){ echo "Data berhasil dihapus dengan ID: " . $id; });

Route::get('/test-method', function(){ return view('test_method'); });
Route::get('/profil', function(){ return view("profile"); });


// ==================== HOME & UTAMA ====================
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('home');
})->name('home');


// ==================== ROUTE AUTHENTIKASI (GUEST) ====================
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// ==================== ROUTE YANG DILINDUNGI (Wajib Login) ====================
Route::middleware('auth')->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Fitur Pencarian Produk (Ditaruh di atas Resource agar tidak bentrok dengan /produk/{id})
    Route::get('/produk/search', [ProductController::class, 'search'])->name('produk.search');
    
    // CRUD Produk & Supplier
    Route::resource('/produk', ProductController::class);
    Route::resource('/supplier', SupplierController::class);
    
    // URL alternatif /barang jika kamu masih membutuhkannya agar terhubung ke ProductController
    Route::get('/barang', [ProductController::class, 'index'])->name('barang.index');
    Route::get('/barang/create', [ProductController::class, 'create'])->name('barang.create');
    Route::post('/barang', [ProductController::class, 'store'])->name('barang.store');
    Route::get('/barang/{id}', [ProductController::class, 'show'])->name('barang.show');
    Route::get('/barang/edit/{id}', [ProductController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/update/{id}', [ProductController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [ProductController::class, 'destroy'])->name('barang.destroy');
});