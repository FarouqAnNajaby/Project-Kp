<?php
include('layout/head.php');
?>
<link rel="stylesheet" href="assets/modules/chocolat/dist/css/chocolat.css">
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <?php
		include('layout/navbar.php');
		?>
        <?php
		include('layout/sidebar.php');
		?>

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Transaksi</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                        <div class="breadcrumb-item">Transaksi</div>
                    </div>
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Pembeli</h4>
                                    </div>
                                    <div class="card-body">
                                        1
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card card-light">
                                <div class="card-header">
                                    <h4>Nama Pembeli</h4>
                                    <div class="card-header-action">
                                        <a href="#" class="btn btn-primary">Terima</a>
                                        <a href="#" class="btn btn-danger">Tolak</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-6">
                                                <h6>081-xxx-xxx</h6>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="text-right">20/02/2021</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Detail Pembelian</h4>
                                                </div>
                                                <div class="card-body p-0">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <tr>
                                                                <th class="p-0 text-center">No</th>
                                                                <th>Name Barang</th>
                                                                <th class="p-0 text-center">Jumlah</th>
                                                                <th class="text-center">Harga</th>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-0 text-center">
                                                                    1
                                                                </td>
                                                                <td>
                                                                    KUNYIT ASAM ANANDA
                                                                </td>
                                                                <td class="p-0 text-center">
                                                                    1
                                                                </td>
                                                                <td class="text-right">
                                                                    Rp. 5.000
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-0 text-center">
                                                                    2
                                                                </td>
                                                                <td>
                                                                    COKLAT TURQY
                                                                </td>
                                                                <td class="p-0 text-center">
                                                                    1
                                                                </td>
                                                                <td class="text-right">
                                                                    Rp. 7.000
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="p-0 text-center">
                                                                    3
                                                                </td>
                                                                <td>
                                                                    LE MINERAL 600 ML
                                                                </td>
                                                                <td class="p-0 text-center">
                                                                    1
                                                                </td>
                                                                <td class="text-right">
                                                                    Rp. 3.000
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <h4>Bukti Transfer</h4>
                                            <div class="gallery gallery-md">
                                                <div class="gallery-item" data-image="assets/image/tf.jpeg" data-title="Image 1"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 text-right d-flex flex-column justify-content-center">
                                            <div class="invoice-detail-item">
                                                <div class="invoice-detail-name">Total</div>
                                                <h4>Rp. 15.000</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
		include('layout/footer.php');
		?>
    </div>
</div>
<?php
include('layout/js.php');
?>
