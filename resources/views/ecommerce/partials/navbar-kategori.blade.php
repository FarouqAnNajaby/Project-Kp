<li>
    <a href=" javascript:;">Kategori<i class="ti-angle-down"></i></a>
    <ul class="dropdown">
        @foreach($kategori as $index => $item)
        <li><a href="{{ route('ecommerce.barang.index') }}?kategori={{ $item->slug }}">{{ $item->nama }}</a></li>
        @endforeach
        <li><a href="{{ route('ecommerce.barang.index') }}">Semua Kategori</a></li>
    </ul>
</li>