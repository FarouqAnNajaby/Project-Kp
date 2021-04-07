@extends('ecommerce.layout.app')

@section('content')
<x-ecommerce-banner />
<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Barang Terbaru</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info">
                    <div class="row">
                        @foreach($data as $index => $value)
                        <div class="col-lg-3 col-md-6 col-12">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection