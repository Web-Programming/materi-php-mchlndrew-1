<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // <--- Import ini sudah aman ada di sini
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. PERBAIKAN UTAMA: Tambahkan baris ini agar tombol Prev & Next ciut jadi rapi khas Bootstrap!
        Paginator::useBootstrapFive();

        // -------------------------------------------------------------
        // Kumpulan Gate Otorisasi Kamu (Sudah Benar & Tetap Dipertahankan)
        // -------------------------------------------------------------
        
        // Untuk mengelola product hanya dilakukan oleh Admin
        Gate::define('manage-product', function ($user) {
            return $user->role === 'admin';
        });

        // Untuk update product dapat dilakukan oleh admin dan sales
        Gate::define('update-product', function (User $user) {
            return $user->role === 'admin' || $user->role === 'sales';
        });

        // Untuk delete product dapat dilakukan oleh admin
        Gate::define('delete-product', function (User $user) {
            return $user->role === 'admin';
        });

        // Untuk membuat product dapat dilakukan oleh user yang sudah login
        Gate::define('create-products', function (User $user) {
            return $user !== null;
        });
    }
}