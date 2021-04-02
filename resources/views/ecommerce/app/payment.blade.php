@extends('ecommerce.layout.app')

@section('content')
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="index.php">Home<i class="ti-arrow-right"></i></a></li>
						<li class="active"><a href="cart.php">Cart</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="shop checkout section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-12">
				<div class="checkout-form">
					<h2>Pembayaran </h2>
					<p>Untuk menyelesaikan pembayaran, silahkan transfer ke nomor rekening yang tertera dan mengunggah foto bukti pembayaran.</p>
					<div class="text-center my-5">
						<h1> 00099834573483</h1>
						<h6>A/N WILDAN JERRY KURNIAWAN</h6>
					</div>
					<div class="order-details mb-5">
						<div class="single-widget">
							<h2>BARANG</h2>
							<div class="content">
								<ul>
									<?php for ($i = 0; $i < 3; $i++) { ?>
										<li>
											<p>Kemeja Lengan Panjan &mdash; (Ukuran S) <span>Rp. <?= rand(1, 999); ?>.000</span></p>
										</li>
									<?php } ?>
									<li class="last	">Total yang harus di bayar<span><b>Rp. <?= rand(1, 999); ?>.000</b></span></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="checkout-form">
					<h2>Pembayaran </h2>
					<p>Unggah foto bukti pembayaran anda di bawah ini.</p>
					<form class="form" method="post" action="{{ route('ecommerce.sendPayment') }}">
						@csrf
						<div class='row'>
							<div class="col-lg-4 col-12">
								<div class="product-img-transfer mb-3">
									<img class="default-img" src="https://via.placeholder.com/150x150" alt="#">
								</div>
								<div class="single-widget get-button-trf">
									<div class="content">
										<div class="button">
											<button class="btn">Pilih Foto</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-5 offset-lg-3 col-12">
								<div class="single-widget get-button">
									<div class="content">
										<div class="button">
											<button class="btn">kirim validasi pembayaran</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection