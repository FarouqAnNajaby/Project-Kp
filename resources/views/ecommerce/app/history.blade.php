<?php include('layouts/head.php'); ?>
<?php include('layouts/navbar.php'); ?>
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li>
							<a href="/index.php">Home<i class="ti-arrow-right"></i></a>
						</li>
						<li class="active">
							<a href="/history.php">Riwayat Pembelian</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="shopping-cart section bg-white">
	<div class="container">
		<div class="row">
			<?php include_once('layouts/sidebar.php'); ?>
			<div class="col-lg-9 col-sm-9 col-12">
				<div class="table-responsive">
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th class="text-center">KODE TRANSAKSI</th>
								<th class="text-center">JUMLAH BARANG</th>
								<th class="text-center">TOTAL</th>
								<th class="text-center">TANGGAL TRANSAKSI</th>

							</tr>
						</thead>
						<tbody>
							<?php for ($i = 0; $i < 4; $i++) { ?>
								<tr>
									<td class="product-des" data-title="Kode Transaksi">#GYAASDJIOC</td>
									<td class="text-center" data-title="Jumlah"><?= rand(1, 10); ?></td>
									<td class="total-amount" data-title="Total"><span>Rp. <?= rand(10, 999); ?>.000</span></td>
									<td class="text-center" data-title="Tanggal Transaksi">
										<?= date('D, d F Y H:i'); ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('layouts/footer.php'); ?>
<?php include('layouts/javascript.php'); ?>