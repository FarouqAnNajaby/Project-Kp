<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="index.php">Lamongan Mart Admin</a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="index.php">LMA</a>
		</div>
		<ul class="sidebar-menu">
			<li class="active"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> <span>Beranda</span></a></li>
			<li class="menu-header">Data Umum</li>
			<li><a class="nav-link" href="{{ route('admin.umkm.index') }}"><i class="fas fa-store"></i> <span>UMKM</span></a></li>
			<li class="dropdown">
				<a class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-boxes"></i> <span>Barang</span></a>
				<ul class="dropdown-menu">
					<li><a class="nav-link" href="barang.php">Data Barang</a></li>
					<li><a class="nav-link" href="history_barang.php">History Barang</a></li>
				</ul>
			</li>
		</ul>
	</aside>
</div>