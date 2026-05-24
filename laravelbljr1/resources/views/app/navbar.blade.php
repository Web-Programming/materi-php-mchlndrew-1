<a class="navbar-brand" href="{{ route('home') }}">PT TFMAKMUR</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
    aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="mainNavbar">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}" href="{{ route('produk.index') }}">
                Produk
            </a>
        </li>
    </ul>

    {{-- Menu Autentikasi dipindahkan ke dalam collapse navbar agar responsif di HP --}}
    <div class="d-flex align-items-center-lg nav-authentication">
        @auth
        <span class="navbar-text me-3 mb-2 mb-lg-0 d-block d-lg-inline">
            Halo, <strong>{{ Auth::user()->name }}</strong>
        </span>
        {{-- Tombol Logout --}}
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm w-100-sm">Logout</button>
        </form>
        @else
        {{-- Mengubah url() menjadi route() agar sinkron dengan web.php --}}
        <a href="{{ route('login') }}"
            class="btn btn-outline-primary btn-sm me-lg-2 mb-2 mb-lg-0 d-block d-lg-inline-block">Login</a>
        <a href="{{ route('register') }}" class="btn btn-primary btn-sm d-block d-lg-inline-block">Daftar</a>
        @endauth
    </div>
</div>