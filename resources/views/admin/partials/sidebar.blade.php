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
			<li class="menu-header">Data Umum</li>
			<li class="dropdown{{ request()->routeIs('admin.umkm*') ? ' active' : null }}">
				<a href="javascript:;" class="nav-link has-dropdown" data-toggle="dropdown">
					<i class="fas fa-store"></i><span>UMKM</span>
				</a>
				<ul class="dropdown-menu">
					<li class="{{ request()->routeIs('admin.umkm*') ? ' active' : null }}">
						<a class="nav-link" href="{{ route('admin.umkm.index') }}">Data UMKM</a>
					</li>
					<li class="{{ request()->routeIs('admin.umkm.kategori*') ? ' active' : null }}">
						<a href="{{ route('admin.umkm.kategori.index') }}">Kategori UMKM</a>
					</li>
				</ul>
			</li>
			<li class="dropdown{{ request()->routeIs('admin.barang*') ? ' active' : null }}">
				<a href="javascript:;" class="nav-link has-dropdown" data-toggle="dropdown">
					<i class="fas fa-boxes"></i><span>Barang</span>
				</a>
				<ul class="dropdown-menu">
					<li class="{{ request()->routeIs('admin.barang.index') ? ' active' : null }}"><a class=" nav-link" href="{{ route('admin.barang.index') }}">Data Barang</a></li>

					<li class="{{ request()->routeIs('admin.barang.history*') ? ' active' : null }}">
						<a href="{{ route('admin.barang.history.index') }}">History Barang</a>
					</li>
				</ul>
			</li>
		</ul>
	</aside>
</div>