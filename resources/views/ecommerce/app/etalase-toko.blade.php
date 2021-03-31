<?php include('layouts/head.php'); ?>
<?php include('layouts/navbar.php'); ?>

<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="index.php">Home<i class="ti-arrow-right"></i></a></li>
						<li><a href="produk.php">Produk <i class="ti-arrow-right"></i> </a></li>
						<li class="active"><a href="etalase-toko.php">Etalase Toko</a></li>
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
					<div class="single-widget toko">
						<div class="row">
							<div class="col-12 col-md-3 col-lg-3">
								<div class="logo mb-4 mb-md-0">
									<img src="https://via.placeholder.com/250x250" class="w-100" alt="logo">
								</div>
							</div>
							<div class="col-12 col-md-9 col-lg-9">
								<div class="etalase-umkm">
									<div class="etalase-umkm-name">Roughneck 1991 Apparel</div>
									<div class="row">
										<div class="col-12 col-md-6 col-lg-6 mb-4">
											<h4>Alamat</h4>
											<p>Ruko megapolitan, Jl. Cinere Raya No.874, Cinere, Kec. Cinere, Kota Depok, Jawa Barat 16514</p>
										</div>
										<div class="col-12 col-md-6 col-lg-6 mb-4">
											<h4>Kategori</h4>
											<p>Makanan</p>
										</div>
										<div class="col-12 col-md-6 col-lg-6 mb-4">
											<h4>Email</h4>
											<p>roughneck1991@gmail.com</p>
										</div>
										<div class="col-12 col-md-6 col-lg-6 mb-4">
											<h4>No. Telpon</h4>
											<p>087887898678</p>
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
					<div class="single-widget range mb-5">
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

			<div class="col-lg-9 col-md-12 col-12">
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
					<?php for ($i = 0; $i < 6; $i++) { ?>
						<div class="col-lg-4 col-md-6 col-12">
							<div class="single-product">
								<div class="product-img">
									<a href="detail-barang.php">
										<img class="default-img" src="https://via.placeholder.com/550x750" alt="">
										<img class="hover-img" src="https://via.placeholder.com/550x750" alt="">
									</a>
								</div>
								<div class="product-content">
									<h3><a href="detail-barang.php">Women Hot Collection</a></h3>
									<div class="product-price">
										<span>Rp. <?= rand(1, 999); ?>.000</span>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include('layouts/footer.php'); ?>
<?php include('layouts/javascript.php'); ?>