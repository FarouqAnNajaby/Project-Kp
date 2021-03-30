<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('kasir.index') }}">Lamongan Mart Kasir</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('kasir.index') }}">LMK</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ request()->routeIs('kasir.index') ? 'active' : null }}">
                <a href="{{ route('kasir.index') }}" class="nav-link"><i class="fas fa-pencil-ruler"></i> <span>Kasir</span></a>
            </li>
            <li class="{{ request()->routeIs('kasir.transaksi.index') ? 'active' : null }}">
                <a href="{{ route('kasir.transaksi.index') }}" class="nav-link"><i class="fas fa-th-large"></i> <span>Transaksi</span></a>
            </li>
            <li class="{{ request()->routeIs('kasir.laporan-umkm.index') ? 'active' : null }}">
                <a href="{{ route('kasir.laporan-umkm.index') }}" class="nav-link"><i class="far fa-file-alt"></i> <span>Laporan UMKM</span></a>
            </li>
            <li class="{{ request()->routeIs('kasir.laporan.index') ? 'active' : null }}">
                <a href="{{ route('kasir.laporan.index') }}" class="nav-link"><i class="far fa-file-alt"></i> <span>Laporan Transaksi</span></a>
            </li>
        </ul>
    </aside>
</div>