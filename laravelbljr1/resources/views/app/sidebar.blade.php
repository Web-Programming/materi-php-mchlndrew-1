<div class="list-group list-group-flush">
    <a href="/dashboard"
        class="list-group-item list-group-item-action border-0 py-2.5 px-3 mb-1 rounded d-flex align-items-center {{ request()->is('dashboard') ? 'active bg-primary text-white shadow-sm' : 'text-secondary bg-transparent' }}">
        <i class="bi bi-house-door me-3 fs-5"></i>
        <span class="fw-medium">Dashboard</span>
        <a href="/produk"
            class="list-group-item list-group-item-action border-0 py-2.5 px-3 mb-1 rounded d-flex align-items-center {{ request()->is('produk') ? 'active bg-primary text-white shadow-sm' : 'text-secondary bg-transparent' }}">
            <i class="bi bi-box-seam me-3 fs-5"></i>
            <span class="fw-medium">Data Barang</span>
        </a>
        @yield('submenu-produk')

        <a href="/supplier"
            class="list-group-item list-group-item-action border-0 py-2.5 px-3 mb-1 rounded d-flex align-items-center {{ request()->is('supplier') ? 'active bg-primary text-white shadow-sm' : 'text-secondary bg-transparent' }}">
            <i class="bi bi-truck me-3 fs-5"></i>
            <span class="fw-medium">Supplier</span>
        </a>
        @yield('submenu-supplier')

        <div class="mt-4 mb-2 px-3 small text-uppercase text-muted fw-bold"
            style="font-size: 0.72rem; letter-spacing: 0.5px;">
            Laporan
        </div>

        <a href="/laporan/bulan-ini"
            class="list-group-item list-group-item-action border-0 py-2.5 px-3 mb-1 rounded d-flex align-items-center {{ request()->is('laporan*') ? 'active bg-primary text-white shadow-sm' : 'text-secondary bg-transparent' }}">
            <i class="bi bi-calendar3 me-3 fs-5"></i>
            <span class="fw-medium">Bulan ini</span>
        </a>
</div>

<style>
    /* Efek hover untuk menu utama */
    .list-group-item-action:hover {
        background-color: rgba(0, 0, 0, 0.03) !important;
        color: #212529 !important;
    }

    .list-group-item-action.active:hover {
        background-color: #0d6efd !important;
        color: #fff !important;
    }

    /* Efek hover untuk submenu tulisan kecil */
    .ms-4 a:hover {
        color: #0d6efd !important;
        padding-left: 3px;
    }

    .transition-all {
        transition: all 0.2s ease-in-out;
    }
</style>