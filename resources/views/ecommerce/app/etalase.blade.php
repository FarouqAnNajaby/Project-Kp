@extends('ecommerce.layout.app')

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li>
                            <a href="{{ route('ecommerce.index') }}">
                                Home<i class="ti-arrow-right"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('ecommerce.barang.index') }}">
                                Produk <i class="ti-arrow-right"></i>
                            </a>
                        </li>
                        <li class="active">
                            <a href="{{ route('ecommerce.etalase', $data->kode) }}">Etalase Toko</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="product-area shop-sidebar shop section">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="shop-sidebar">
                    <div class="single-widget">
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="logo mb-4 mb-md-0">
                                    <img src="{{ asset($data->logo) }}" class="w-100 etalase-logo" alt="logo">
                                </div>
                            </div>
                            <div class="col-12 col-md-9 col-lg-9">
                                <div class="etalase-umkm">
                                    <div class="etalase-umkm-name">{{ $data->nama }}</div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6 mb-4">
                                            <h4>Alamat</h4>
                                            <p>{{ $data->alamat }}</p>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 mb-4">
                                            <h4>Kategori</h4>
                                            <p>{{ $data->UMKM_Kategori->nama }}</p>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 mb-4">
                                            <h4>Email</h4>
                                            <p>{{ $data->email }}</p>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 mb-4">
                                            <h4>Nomor Telepon</h4>
                                            <p>{{ $data->local_nomor_telp }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-12">
                <div class="shop-sidebar">
                    <div class="single-widget category">
                        <h3 class="title">Kategori</h3>
                        <ul class="check-box-list">
                            @foreach ($kategori as $index => $value)
                            <li>
                                @if($index < 5) <label class="checkbox-inline" for="kategori-{{ $index }}">
                                    {!! Form::radio('kategori', $value->slug, request()->kategori == $value->slug ? true : false, ['id' => 'kategori-' . $index]) !!}
                                    {{ $value->nama }} <span class="count">({{ $value->total }})</span>
                                    </label>
                                    @elseif($index == 5)
                                    <a data-toggle="collapse" href="#more-kategori" class="mb-3 text-primary">...........................</a>
                                    @endif
                                    @if($index >= 5)
                                    <div class="collapse" id="more-kategori">
                                        <label class="checkbox-inline" for="kategori-{{ $index }}">
                                            {!! Form::radio('kategori', $value->slug, request()->kategori == $value->slug ? true : false, ['id' => 'kategori-' . $index]) !!}{{ $value->nama }} <span class="count">({{ $value->total }})</span>
                                        </label>
                                    </div>
                                    @endif
                            </li>
                            @endforeach
                            @if(request()->has('kategori'))
                            <li><a href="javascript:;" id="remove-filter-kategori" class="text-primary">Hapus filter kategori</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="single-widget range mb-5">
                        <h3 class="title">Harga</h3>
                        <div class="price-filter">
                            <div class="price-filter-inner">
                                <div class="form-group">
                                    {!! Form::text('min-price', request()->min_price ?? 1000, ['class' => 'format-number', 'placeholder' => 'Harga minimal']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::text('max-price', request()->max_price ?? 10000000, ['class' => 'format-number', 'placeholder' => 'Harga minimal']) !!}
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-search-items" id="filter-price">Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-12 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="shop-top">
                            <div class="shop-shorter">
                                <div class="single-shorter">
                                    <label>Urutkan dari :</label>
                                    {!! Form::select('orderby', ['nama-asc' => 'Nama (A-Z)', 'nama-desc' => 'Nama (Z-A)', 'harga-desc' => 'Harga (Termahal - Termurah)', 'harga-asc' => 'Harga (Termurah - Termahal)'], request()->orderby ?? 'nama-asc') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($barang as $index => $value)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a href="{{ route('ecommerce.barang.show', [$value->kode, $value->slug]) }}">
                                    <img class="default-img img-cover img-fluid" src="{{ asset('storage/barang/' . $value->foto) }}" alt="">
                                </a>
                            </div>
                            <div class="product-content">
                                <h3><a href="{{ route('ecommerce.barang.show', [$value->kode, $value->slug]) }}">{!! $value->name_limitted2 !!}</a></h3>
                                <div class="product-price">
                                    <span>{{ $value->rp_harga }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-12">
                        {{ $barang->links('vendor.pagination.e-commerce') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection