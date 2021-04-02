<header class="header shop">
	<div class="middle-inner">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-12">
					<div class="logo">
						<a href="{{ route('ecommerce.index') }}"><img src="{{ asset('assets/ecommerce/images/ms-icon-70x70.png')}}" alt="logo"></a>
					</div>
					<div class="search-top">
						<div class="top-search">
							<a href="#0"><i class="ti-search"></i></a>
						</div>
						<div class="search-top ">
							<form class="search-form">
								<input type="text" placeholder="Search here..." name="search">
								<button value="search" type="submit"><i class="ti-search"></i></button>
							</form>
						</div>
					</div>
					<div class="mobile-nav"></div>
				</div>
				<div class="col-lg-8 col-md-7 col-12">
					<div class="search-bar-top">
						<div class="search-bar">
							<form>
								<input name="search" placeholder="Cari barang..." type="search">
								<button class="btnn"><i class="ti-search"></i></button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-3 col-12">
					<div class="right-bar">
						<div class="sinlge-bar">
							<a href="{{ route('ecommerce.login') }}" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
						</div>
						<div class="sinlge-bar shopping">
							<a href="{{ route('ecommerce.cart') }}" class="single-icon"><i class="ti-bag"></i> <span class="total-count"><?= rand(1, 5); ?></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="header-inner">
		<div class="container">
			<div class="cat-nav-head">
				<div class="row">
					<div class="col-12">
						<div class="menu-area">
							<nav class="navbar navbar-expand-lg">
								<div class="navbar-collapse">
									<div class="nav-inner">
										<ul class="nav main-menu menu navbar-nav">
											<li class="{{ request()->routeIs('ecommerce.index') ? 'active' : null }}"><a href="{{ route('ecommerce.index') }}">Home</a></li>
											<li class="{{ request()->routeIs('ecommerce.pakaian') ? 'active' : null }}"><a href="{{ route('ecommerce.pakaian') }}">Pakaian</a></li>
											<li class="{{ request()->routeIs('ecommerce.minuman') ? 'active' : null }}"><a href=" {{ route('ecommerce.minuman') }} ">Minuman</a></li>
											<li class="{{ request()->routeIs('ecommerce.snack') ? 'active' : null }}"><a href=" {{ route('ecommerce.snack') }} ">Snack</a></li>
											<li class=""><a href="">Kategori<i class="ti-angle-down"></i></a>
												<ul class="dropdown">
													<li><a href=" ">Keripik</a></li>
													<li><a href=" ">Aksesoris</a></li>
													<li><a href=" ">Sambal</a></li>
													<li><a href=" {{ route('ecommerce.produk') }} ">Semua Kategori</a></li>
												</ul>
											</li>
											
										</ul>
									</div>
								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>