@extends('admin.layout.app')

@section('content')
<section class="section">
    <x-admin-breadcrumb title="Laporan Transaksi">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">Laporan Transaksi</div>
        </x-slot>
    </x-admin-breadcrumb>

    <div class="section-body">
        <div class="row mb-3">
            <div class="col-md-6 col-12 text-right ml-auto">
                <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-sm-8">
                            <h4>Laporan Transaksi</h4>
                        </div>
                        <div class="col-sm-4 text-right">
                            <h6>20/02/2021</h6>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th data-width="40">No</th>
                                    <th>Nama Barang</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-right">Total</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>KUNYIT ASAM ANANDA</td>
                                    <td class="text-center">Rp. 5.000</td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">Rp. 5.000</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>COKLAT TURQY</td>
                                    <td class="text-center">Rp. 7.000</td>
                                    <td class="text-center">3</td>
                                    <td class="text-right">Rp. 21.000</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>LE MINERAL 600 ML</td>
                                    <td class="text-center">Rp. 3.000</td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">Rp. 3.000</td>
                                </tr>
                            </table>
                        </div>
                        <div class="row mt-4">

                            <div class="col-lg-4 text-right ml-auto">

                                <div class="invoice-detail-item mt-4">
                                    <h4>Total</h4>
                                    <h4>Rp. 29.000</h4>
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

@push('javascript')
<script src="assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
@endpush
