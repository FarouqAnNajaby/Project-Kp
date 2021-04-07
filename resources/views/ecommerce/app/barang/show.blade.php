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
                                    <ul class="rating">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-half-o"></i></li>
                                        <li class="dark"><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    <a href="javascript:;" class="total-review">(102) Penilaian</a>
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
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews</a></li>
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
                                                <div class="avg-ratting">
                                                    <h4>4.5 <span>(Overall)</span></h4>
                                                    <span>Based on 1 Comments</span>
                                                </div>
                                                <div class="single-rating">
                                                    <div class="rating-author">
                                                        <img src="https://via.placeholder.com/60x60" alt="#">
                                                    </div>
                                                    <div class="rating-des">
                                                        <h6>Naimur Rahman</h6>
                                                        <div class="ratings">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star-half-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                            <div class="rate-count">(<span>3.5</span>)</div>
                                                        </div>
                                                        <p>Duis tincidunt mauris ac aliquet congue. Donec vestibulum consequat cursus. Aliquam pellentesque nulla dolor, in imperdiet.</p>
                                                    </div>
                                                </div>
                                                <div class="single-rating">
                                                    <div class="rating-author">
                                                        <img src="https://via.placeholder.com/60x60" alt="#">
                                                    </div>
                                                    <div class="rating-des">
                                                        <h6>Advin Geri</h6>
                                                        <div class="ratings">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                            </ul>
                                                            <div class="rate-count">(<span>5.0</span>)</div>
                                                        </div>
                                                        <p>Duis tincidunt mauris ac aliquet congue. Donec vestibulum consequat cursus. Aliquam pellentesque nulla dolor, in imperdiet.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="comment-review">
                                                <div class="add-review">
                                                    <h5>Add A Review</h5>
                                                    <p>Your email address will not be published. Required fields are marked</p>
                                                </div>
                                                <h4>Your Rating</h4>
                                                <div class="review-inner">
                                                    <div class="ratings">
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <form class="form" method="post" action="mail/mail.php">
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        <div class="form-group">
                                                            <label>Your Name<span>*</span></label>
                                                            <input type="text" name="name" required="required" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <div class="form-group">
                                                            <label>Your Email<span>*</span></label>
                                                            <input type="email" name="email" required="required" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-12">
                                                        <div class="form-group">
                                                            <label>Write a review<span>*</span></label>
                                                            <textarea name="message" rows="6" placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-12">
                                                        <div class="form-group button5">
                                                            <button type="submit" class="btn">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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