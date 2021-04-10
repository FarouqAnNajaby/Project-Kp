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
                                        <img src="{{ asset('storage/barang/' . $item->file) }}">
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
                                <div class="rating-main">
                                    @if($data->Review()->count())
                                    <ul class="rating">
                                        @php
                                        $rata = $data->Review()->avg('nilai');
                                        $rata2 = floor($rata);
                                        @endphp
                                        @for($i = 0; $i < $rata2; $i++) <li><i class="fa fa-star"></i></li>
                                            @if($rata - $rata2==0.5 && $i==$rata2-1) <li><i class="fas fa-star-half-alt"></i></li>
                                            @endif
                                            @if($i == $rata2-1 && $rata <= 4) @for($j=0; $j < 5 - round($rata); $j++) <li><i class="far fa-star"></i></li>
                                                @endfor
                                                @endif
                                                @endfor
                                    </ul>
                                    <span class="total-review">({{ $data->Review()->count() }}) Penilaian</span>
                                    @else
                                    <span class="total-review ml-0 font-weight-normal">(Barang belum memiliki penilaian)</span>
                                    @endif
                                </div>
                                <p class="price">{{ $data->rp_harga }}</p>
                                <p class="description">{{ $data->deskripsi_singkat }}</p>
                                <div class="umkm">
                                    <img src="{{ asset($data->UMKM->logo ? 'storage/logo-umkm/' . $data->UMKM->logo : 'assets/img/umkm-default.png') }}" alt="{{ $data->UMKM->nama }}" width="75px">
                                    <div class="umkm-name">
                                        <a href="{{ route('ecommerce.etalase', $data->UMKM->kode) }}">{{ $data->UMKM->nama}}</a>
                                        <p>{{ $data->UMKM->UMKM_Kategori->nama }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-buy">
                            <div class="quantity">
                                <h6>Jumlah :</h6>
                                <div class="input-group">
                                    <div class="button minus">
                                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quantity">
                                            <i class="ti-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="quantity" class="input-number" id="quantity" data-min="1" data-max="{{ $data->stok }}" value="1">
                                    <div class="button plus">
                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quantity">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="add-to-cart">
                                @auth
                                <button class="btn" id="add-to-cart">Tambah ke Keranjang</button>
                                @endauth
                                @guest
                                <a href="{{ route('ecommerce.login') }}" class="btn">Tambah ke Keranjang</a>
                                @endguest
                            </div>
                            <p class="cat">Kategori : {{ $data->Kategori->nama }}</p>
                            <p class="availability">Stok Tersedia : {{ $data->stok}}</p>
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
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Penilaian</a></li>
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
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="tab-single review-panel">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="ratting-main">
                                                @if($data->Review()->count())
                                                <div class="avg-ratting">
                                                    <h4>{{ $data->Review()->avg('nilai') }} <span>(Rata-rata)</span></h4>
                                                    <span>Dari total {{ $data->Review()->count() }} penilaian</span>
                                                </div>
                                                @foreach ($data->Review()->get() as $item)
                                                <div class="single-rating">
                                                    <div class="rating-des">
                                                        <h6>{{ $item->User->nama }} <span class="font-weight-normal">({{ $item->formatted_tanggal }})</span></h6>
                                                        <div class="ratings">
                                                            <ul class="rating">
                                                                @for($i = 0; $i < $item->nilai; $i++)
                                                                    <li><i class="fa fa-star"></i></li>
                                                                    @if($i == floor($item->nilai)-1 && $item->nilai <= 4) @for($j=0; $j < 5 - round($item->nilai); $j++) <li><i class="far fa-star"></i></li>
                                                                        @endfor
                                                                        @endif
                                                                        @endfor
                                                            </ul>
                                                            <div class="rate-count">(<span>{{ $item->nilai }}</span>)</div>
                                                        </div>
                                                        <p>{{ $item->keterangan }}</p>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                <div class="avg-rating">
                                                    <span>Barang belum memiliki penilaian</span>
                                                </div>
                                                @endif
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

@push('javascript-custom')
<script>
    $('#add-to-cart').on('click', function() {
        let quantity = $('#quantity').val();
        let csrf_token = $('meta[name=csrf-token]').attr('content');
        let url = window.location.href;
        $.ajax({
            url: url
            , data: {
                quantity: quantity
            }
            , type: 'POST'
            , headers: {
                'X-CSRF-TOKEN': csrf_token
            }
            , dataType: 'json'
            , beforeSend: function() {
                $('button').attr('disabled', true);
            }
            , complete: function() {
                $('button').removeAttr('disabled');
            }
            , success: function(response) {
                $('#quantity').val(1);
                swal("Sukses!", "Barang Berhasil ditambahkan ke Keranjang.", "success");
            }
            , error: function(xhr, status, error) {
                if (xhr.responseText != "") {
                    var err = JSON.parse(xhr.responseText)
                    swal({
                            icon: 'error'
                            , title: xhr.status == 403 ? 'Gagal' : "Terjadi Kesalahan!"
                            , text: err.msg.quantity ? err.msg.quantity[0] : (err.msg || '')
                        })
                        .then((result) => {
                            if (result && xhr.status == 403) {
                                window.location.href = "/login";
                            }
                        });
                }
            }
        })
    })
</script>
@endpush