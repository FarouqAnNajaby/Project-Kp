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
                        @auth
                        <x-ecommerce-cart />
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
                                                <a href="{{ route('ecommerce.barang.index') . '?kategori=pakaian' }}">Pakaian</a>
                                            </li>
                                            <li class="{{ request()->segment(1) == 'barang' && request()->kategori == 'minuman' ? 'active' : null }}">
                                                <a href=" {{ route('ecommerce.barang.index') . '?kategori=minuman' }} ">Minuman</a>
                                            </li>
                                            <li class="{{ request()->segment(1) == 'barang' && request()->kategori == 'snack' ? 'active' : null }}">
                                                <a href=" {{ route('ecommerce.barang.index') . '?kategori=snack' }} ">Snack</a>
                                            </li>
                                            <x-ecommerce-navbar-kategori />
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