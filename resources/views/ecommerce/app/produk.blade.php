@extends('ecommerce.layout.app')

@section('content')
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="index.php">Home<i class="ti-arrow-right"></i></a></li>
						<li class="active"><a href="produk.php">Produk</a></li>
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
							<li>
								<label class="checkbox-inline" for="1">
									<input name="news" id="1" type="radio">Pakaian <span class="count">(3)</span>
								</label>
							</li>
							<li>
								<label class="checkbox-inline" for="2">
									<input name="news" id="2" type="radio">Makanan <span class="count">(5)</span>
								</label>
							</li>
							<li>
								<label class="checkbox-inline" for="3">
									<input name="news" id="3" type="radio">Minuman <span class="count">(8)</span>
								</label>
							</li>
						</ul>
					</div>
					<div class="single-widget range">
						<h3 class="title">Harga</h3>
						<div class="price-filter">
							<div class="price-filter-inner">
								<div class="form-group">
									<input type="text" placeholder="Harga minimal" class="format-number" value="10000">
								</div>
								<div class="form-group">
									<input type="text" placeholder="Harga maksimal" class="format-number" value="10000000">
								</div>
								<div class="form-group">
									<button class="btn btn-search-items">Cari</button>
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
									<select>
										<option selected="selected">Nama (A-Z)</option>
										<option>Nama (Z-A)</option>
										<option>Harga (Termahal - Termurah)</option>
										<option>Harga (Termurah - Termahal)</option>
									</select>
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
									<a href="{{ route('ecommerce.detail-barang', $value->uuid) }}">
										<img class="default-img" src="https://via.placeholder.com/550x750" alt="">
										<img class="hover-img" src="https://via.placeholder.com/550x750" alt="">
									</a>
								</div>
								<div class="product-content">
									<h3><a href="{{ route('ecommerce.login') }}">{{ $value->nama }}</a></h3>
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
</section>
@endsection
