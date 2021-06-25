<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.index') }}">Lamongan Mart Admin</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.index') }}">LMA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ request()->routeIs('admin.index') ? 'active' : null }}">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="fas fa-home"></i> <span>Beranda</span>
                </a>
            </li>
            @if(Gate::check('super-admin'))
            <li class="dropdown{{ request()->segment(2) == 'list-admin-kasir' ? ' active' : null }}">
                <a href="javascript:;" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-users"></i><span>List Admin & Kasir</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->segment(3) == 'admin' ? ' active' : null }}">
                        <a class="nav-link" href="{{ route('admin.list-admin-kasir.admin.index') }}">
                            Data Admin
                        </a>
                    </li>
                    <li class="{{ request()->segment(3) == 'kasir' ? ' active' : null }}">
                        <a class="nav-link" href="{{ route('admin.list-admin-kasir.kasir.index') }}">
                            Data Kasir
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Data Master</li>
            <li class="dropdown{{ request()->segment(2) == 'master-data' ? ' active' : null }}">
                <a href="javascript:;" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-database"></i><span>Master Data</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->segment(3) == 'banner-ecommerce' ? ' active' : null }}">
                        <a class="nav-link" href="{{ route('admin.master-data.banner.index') }}">
                            Data Banner E-Commerce
                        </a>
                    </li>
                    <li class="{{ request()->segment(3) == 'kategori-barang' ? ' active' : null }}">
                        <a class="nav-link" href="{{ route('admin.master-data.kategori-barang.index') }}">
                            Data Kategori Barang
                        </a>
                    </li>
                    <li class="{{ request()->segment(3) == 'kategori-umkm' ? ' active' : null }}">
                        <a class="nav-link" href="{{ route('admin.master-data.kategori-umkm.index') }}">
                            Data Kategori UMKM
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            <li class="menu-header">Data Umum</li>
            <li class="{{ request()->segment(2) == 'umkm' ? 'active' : null }}">
                <a class="nav-link" href="{{ route('admin.umkm.index') }}">
                    <i class="fas fa-store"></i> <span>UMKM</span>
                </a>
            </li>
            <li class="dropdown{{ request()->segment(2) == 'barang' ? ' active' : null }}">
                <a href="javascript:;" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-boxes"></i><span>Barang</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->segment(2) == 'barang' && !in_array(request()->segment(3), ['log', 'pengadaan']) ? ' active' : null }}"><a class=" nav-link" href="{{ route('admin.barang.index') }}">Data Barang</a></li>
                    <li class="{{ request()->segment(2) == 'barang' && request()->segment(3) == 'pengadaan' ? ' active' : null }}"><a class=" nav-link" href="{{ route('admin.barang.pengadaan.index') }}">Pengadaan Barang</a></li>
                    <li class="{{ request()->segment(2) == 'barang' && request()->segment(3) == 'log' ? ' active' : null }}">
                        <a href="{{ route('admin.barang.log.index') }}">Log Barang</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>