<div class="col-lg-3 col-sm-3 col-12">
    <div class="shop-sidebar">
        <div class="single-widget category">
            <h3 class="title">Menu</h3>
            <ul class="categor-list">
                <li @if(request()->routeIs('ecommerce.profile'))class="active"@endif>
                    <a href="{{ route('ecommerce.profile') }}">Profil Pengguna</a>
                </li>
                <li @if(request()->routeIs('ecommerce.history') || request()->routeIs('ecommerce.history.show'))class="active"@endif>
                    <a href="{{ route('ecommerce.history') }}">Riwayat Pembelian</a>
                </li>
                <li><a href="{{ route('ecommerce.logout') }}">Keluar</a></li>
            </ul>
        </div>
    </div>
</div>