@extends('ecommerce.layout.app')

@section('content')
<section class="shop single section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="product-gallery">
                            <div class="flexslider-thumbnails">
                                <ul class="slides">
                                    @foreach ($data->Foto()->get() as $item)
                                    <li data-thumb="{{ asset('storage/barang/' . $item->file) }}" rel="adjustX:10, adjustY:">
                                        <img src="{{ asset('storage/barang/' . $item->file) }}" class="img-grey">
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="product-des">
                            <div class="short">
                                <h4>{{ $data->nama }}</h4>
                                <p class="price">{{ $barang->rp_harga }}</p>
                                <p class="description">{{ $data->deskripsi_singkat }}</p>
                                <div class="umkm">
                                    <img src="{{ asset($data->UMKM->logo ? 'storage/logo-umkm/' . $data->UMKM->logo : 'assets/img/umkm-default.png') }}" alt="{{ $data->UMKM->nama }}" class="img-grey" width="75px">
                                    <div class="umkm-name">
                                        <span>{{ $data->UMKM->nama}}</span>
                                        <p>{{ $data->UMKM->UMKM_Kategori->nama }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-buy">
                            <p class="cat">Kategori : {{ $data->Kategori->nama }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-info">
                        <div class="nav-main">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description" role="tab">Deskripsi</a></li>
                            </ul>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                <div class="tab-single">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="single-des">
                                                {!! $data->deskripsi !!}
                                            </div>
                                        </div>
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
@endsection

@push('stylesheet')
<style>
    .flexslider-thumbnails .flex-control-nav img {
        -webkit-filter: grayscale(100%);
        filter: grayscale(100%);
    }
</style>
@endpush