<div class="sinlge-bar shopping">
    <a href="{{ route('ecommerce.cart.index') }}" class="single-icon">
        <i class="ti-bag"></i>
        <span class="total-count">
            {{ $total_item }}
        </span>
    </a>
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{ $total_item }} Barang</span>
            <a href="{{ route('ecommerce.cart.index') }}">Lihat Keranjang</a>
        </div>
        <ul class="shopping-list">
            @forelse ($data->limit(2)->get() as $item)
            <li>
                <a class="cart-img" href="{{ route('ecommerce.barang.show', [$item->Barang->kode, $item->Barang->slug]) }}">
                    <img src="{{ asset('storage/barang/' . $item->Barang->Foto()->where('is_highlight', 1)->first()->file) }}" alt="{{ $item->Barang->nama }}">
                </a>
                <h4>
                    <a href="{{ route('ecommerce.barang.show', [$item->Barang->kode, $item->Barang->slug]) }}">
                        {{ $item->Barang->nama }}
                    </a>
                </h4>
                <p class="quantity">{{ $item->jumlah }}x - <span class="amount">{{ $item->Barang->rp_harga }}</span></p>
            </li>
            @empty
            <li>
                <p class="my-0 text-small">Keranjang Kamu Masih Kosong...</p>
            </li>
            @endforelse
        </ul>
        @if($data->count())
        <div class="bottom">
            <div class="total">
                <span>Total</span>
                <span class="total-amount">{{ $total_pay }}</span>
            </div>
            <a href="{{ route('ecommerce.checkout.index') }}" class="btn animate">Checkout</a>
        </div>
        @endif
    </div>
</div>