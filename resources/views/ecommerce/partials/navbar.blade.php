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
                            <a href="javascript:;"><i class="ti-search"></i></a>
                        </div>
                        <div class="search-top ">
                            <form class="search-form keyword-mbl-form">
                                {!! Form::text('keyword-mbl', request()->keyword_mbl ?? null, ['placeholder' => 'Cari barang....']) !!}
                                <button value="search keyword-btn" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <form class="keyword-form">
                                {!! Form::text('keyword', request()->keyword ?? null, ['placeholder' => 'Cari barang....']) !!}
                                <button class="btnn keyword-btn"><i class=" ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <div class="sinlge-bar">
                            @auth
                            <a href="{{ route('ecommerce.profile') }}" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                            @endauth
                            @guest
                            <a href="{{ route('ecommerce.login') }}" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                            @endguest
                        </div>
                        <div class="sinlge-bar shopping">
                            <a href="{{ route('ecommerce.cart') }}" class="single-icon"><i class="ti-bag"></i> <span class="total-count"><?= rand(1, 5); ?></span></a>
                        </div>
                        @auth
                        <div class="single-bar shopping">
                            <a href="{{ route('ecommerce.logout') }}" class="single-icon"><i class="fa fa-sign-out"></i></a>
                        </div>
                        @endauth
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
                                            <li class="{{ request()->routeIs('ecommerce.index') ? 'active' : null }}">
                                                <a href="{{ route('ecommerce.index') }}">Home</a>
                                            </li>
                                            <li class="{{ request()->segment(1) == 'barang' && request()->kategori == 'pakaian' ? 'active' : null }}">
                                                <a href="{{ route('ecommerce.barang') . '?kategori=pakaian' }}">Pakaian</a>
                                            </li>
                                            <li class="{{ request()->segment(1) == 'barang' && request()->kategori == 'minuman' ? 'active' : null }}">
                                                <a href=" {{ route('ecommerce.barang') . '?kategori=minuman' }} ">Minuman</a>
                                            </li>
                                            <li class="{{ request()->segment(1) == 'barang' && request()->kategori == 'snack' ? 'active' : null }}">
                                                <a href=" {{ route('ecommerce.barang') . '?kategori=snack' }} ">Snack</a>
                                            </li>
                                            <li>
                                                <a href=" javascript:;">Kategori<i class="ti-angle-down"></i></a>
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