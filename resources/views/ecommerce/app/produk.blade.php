@extends('ecommerce.layout.app')

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{ route('ecommerce.index') }}">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="{{ route('ecommerce.barang.index') }}">Produk</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="product-area shop-sidebar shop section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-12">
                <div class="shop-sidebar">
                    <div class="single-widget category">
                        <h3 class="title">Kategori</h3>
                        <ul class="check-box-list">
                            @foreach ($kategori as $index => $value)
                            @if($index < 5) <li>
                                <label class="checkbox-inline" for="kategori-{{ $index }}">
                                    {!! Form::radio('kategori', $value->slug, request()->kategori == $value->slug ? true : false, ['id' => 'kategori-' . $index]) !!}{{ $value->nama }} <span class="count">({{ $value->total }})</span>
                                </label>
                                </li>
                                @elseif($index == 5)
                                <li><a data-toggle="collapse" href="#more-kategori" class="mb-3 text-primary">...........................</a></li>
                                @endif
                                @if($index >= 5)<li>
                                    <div class="collapse" id="more-kategori">
                                        <label class="checkbox-inline" for="kategori-{{ $index }}">
                                            {!! Form::radio('kategori', $value->slug, request()->kategori == $value->slug ? true : false, ['id' => 'kategori-' . $index]) !!}{{ $value->nama }} <span class="count">({{ $value->total }})</span>
                                        </label>
                                    </div>
                                </li>
                                @endif
                                @endforeach
                                @if(request()->has('kategori'))
                                <li><a href="javascript:;" id="remove-filter-kategori" class="text-primary">Hapus filter kategori</a></li>
                                @endif
                        </ul>
                    </div>
                    <div class="single-widget range">
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
            <div class="col-lg-9 col-md-8 col-12">
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
                    @foreach($data as $index => $value)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="single-product">
                            <div class="product-img">
                                <a href="{{ route('ecommerce.show', [$value->kode, $value->slug]) }}">
                                    <img class="default-img img-cover img-fluid" src="{{ asset('storage/barang/' . $value->foto) }}" alt="">
                                </a>
                            </div>
                            <div class="product-content">
                                <h3><a href="{{ route('ecommerce.login') }}">{!! $value->name_limitted2 !!}</a></h3>
                                <div class="product-price">
                                    <span>{{ $value->rp_harga }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-12">
                        {{ $data->links('vendor.pagination.e-commerce') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection