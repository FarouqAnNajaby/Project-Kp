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
<div class="shopping-cart section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<table class="table shopping-summery">
					<thead>
						<tr class="main-hading">
							<th>PRODUK</th>
							<th>NAMA</th>
							<th class="text-center">HARGA</th>
							<th class="text-center">JUMLAH</th>
							<th class="text-center">TOTAL</th>
							<th class="text-center"><i class="ti-trash remove-icon"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php for ($i = 0; $i < 4; $i++) { ?>
							<tr>
								<td class="image" data-title="No"><img src="https://via.placeholder.com/100x100" alt="#"></td>
								<td class="product-des" data-title="Description">
									<p class="product-name">
										<a href="detail-barang.php" target="_blank">Women Dress</a>
									</p>
								</td>
								<td class="price" data-title="Price"><span>Rp. <?= rand(1, 999); ?>.000</span></td>
								<td class="qty" data-title="Qty">
									<div class="input-group">
										<div class="button minus">
											<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
												<i class="ti-minus"></i>
											</button>
										</div>
										<input type="text" name="quant[1]" class="input-number" data-min="1" data-max="100" value="1">
										<div class="button plus">
											<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
												<i class="ti-plus"></i>
											</button>
										</div>
									</div>
								</td>
								<td class="total-amount" data-title="Total"><span>Rp. <?= rand(10, 999); ?>.000</span></td>
								<td class="action" data-title="Remove"><a href="#"><i class="ti-trash remove-icon"></i></a></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="total-amount">
					<div class="row">
						<div class="col-lg-4 col-md-7 col-12 ml-auto">
							<div class="right">
								<ul>
									<li>Subtotal<span>Rp. <?= rand(10, 999); ?>.000</span></li>
								</ul>
								<div class="button5">
									<a href=" {{ route('ecommerce.payment') }}" class="btn">Checkout</a>
									<a href="{{ route('ecommerce.index') }}" class="btn">Lanjutkan Belanja</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection