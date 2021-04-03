@extends('ecommerce.layout.app')

@section('content')
<section class="hero-slider">
    <div class="single-slider" style="background-image: url('https://via.placeholder.com/1900x700');">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-12">
                    <div class="text-inner">
                        <div class="row">
                            <div class="col-lg-7 col-12">
                                <div class="hero-text">
                                    <p>Maboriosam in a nesciung eget magnae <br> dapibus disting tloctio in the find it pereri <br> odiy maboriosm.</p>
                                    <div class="button">
                                        <a href="javascript:;" class="btn">Shop Now!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
                        @foreach($barang as $index => $value)
                        <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{ route('ecommerce.barang.index', $value->uuid) }}">
                                        <img class="default-img" src="https://via.placeholder.com/550x750" alt="">
                                        <img class="hover-img" src="https://via.placeholder.com/550x750" alt="">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h3><a href="detail-barang.php">{{ $value->nama }}</a></h3>
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

<section class="midium-banner mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="single-banner">
                    <img src="https://via.placeholder.com/600x370" alt="#">
                    <div class="content">
                        <p>Aksesoris</p>
                        <h3>Kumpulan Aksesoris</h3>
                        <a href=" {{ route('ecommerce.barang.index') }}">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="single-banner">
                    <img src="https://via.placeholder.com/600x370" alt="#">
                    <div class="content">
                        <p>Makanan</p>
                        <h3>Makan enak,<br> perut kenyang!</h3>
                        <a href="{{ route('ecommerce.barang.index') }}" class="btn">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection