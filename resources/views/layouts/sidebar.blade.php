<div class="col-md-3 col-lg-2 bg-white shadow-sm rounded-4 p-4 mb-4 position-fixed"
     style="
        border-right: 1px solid #e3e6f0;
        top: 0;
        left: 0;
        height: 100vh;
        overflow-y: auto;
        z-index: 1000;
     ">
    <div class="d-flex align-items-center mb-5 pb-3 border-bottom">
        <img src="{{ asset('images/LOGO DEPO KAISAR ICE.svg') }}" alt="Logo" style="max-height: 40px;">
        <span class="ms-2 fw-bold h5 mb-0" style="color: #000000;">Depo Kaisar Ice</span>
    </div>

    <div class="nav flex-column nav-pills">
        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active bg-dark text-white' : 'text-dark' }} mb-2 rounded-3 shadow-sm">
            <i class="bi bi-grid{{ request()->routeIs('home') ? '-fill' : '' }} me-2"></i> Dashboard
        </a>
        
        <small class="text-muted fw-bold text-uppercase mt-3 mb-2">Master Data</small>
        @if(Auth::user()->role === 'super admin')
        <a href="{{ route('DataAdmin.index') }}" class="nav-link {{ request()->routeIs('DataAdmin.*') ? 'active bg-dark text-white' : 'text-dark' }} mb-1 rounded-3">
            <i class="bi bi-person-badge{{ request()->routeIs('DataAdmin.*') ? '-fill' : '' }} me-2"></i> Data Admin
        </a>
        @endif
        
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('produk.index') }}" class="nav-link {{ request()->routeIs('produk.index') ? 'active bg-dark text-white' : 'text-dark' }} mb-1 rounded-3">
            <i class="bi bi-box-seam{{ request()->routeIs('produk.index') ? '-fill' : '' }} me-2"></i> Produk Es Batu
        </a>
        @endif
        
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('supplier.index') }}" class="nav-link {{ request()->routeIs('supplier.index') ? 'active bg-dark text-white' : 'text-dark' }} mb-1 rounded-3">
            <i class="bi bi-truck me-2"></i> Supplier
        </a>
        <a href="{{ route('pelanggan.index') }}" class="nav-link {{ request()->routeIs('pelanggan.index') ? 'active bg-dark text-white' : 'text-dark' }} mb-1 rounded-3">
            <i class="bi bi-people{{ request()->routeIs('pelanggan.index') ? '-fill' : '' }} me-2"></i> Pelanggan
        </a>
        <a href="{{ route('karyawan.index') }}" class="nav-link {{ request()->routeIs('karyawan.index') ? 'active bg-dark text-white' : 'text-dark' }} mb-1 rounded-3">
            <i class="bi bi-person-check{{ request()->routeIs('karyawan.index') ? '-fill' : '' }} me-2"></i> Karyawan Pengiriman
        </a>
        <small class="text-muted fw-bold text-uppercase mt-3 mb-2">Transaksi</small>
        <a href="{{ route('barang_masuk.index') }}" class="nav-link {{ request()->routeIs('barang_masuk.index') ? 'active bg-dark text-white' : 'text-dark' }} mb-1 rounded-3">
            <i class="bi bi-download me-2"></i> Barang Masuk
        </a>
        <a href="{{ route('distribusi.index') }}" class="nav-link {{ request()->routeIs('distribusi.index') ? 'active bg-dark text-white' : 'text-dark' }} mb-1 rounded-3">
            <i class="bi bi-send me-2"></i> Distribusi
        </a>
        <small class="text-muted fw-bold text-uppercase mt-3 mb-2">Laporan</small>
        <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->routeIs('laporan.index') ? 'active bg-dark text-white' : 'text-dark' }} mb-1 rounded-3">
            <i class="bi bi-file-earmark-bar-graph{{ request()->routeIs('laporan.index') ? '-fill' : '' }} me-2"></i> Laporan Operasional
        </a>
        @endif

        <small class="text-muted fw-bold text-uppercase mt-3 mb-2">Pengaturan</small>
        <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active bg-dark text-white' : 'text-dark' }} mb-1 rounded-3">
            <i class="bi bi-person-circle"></i> Profil
        </a>
    </div>
</div>