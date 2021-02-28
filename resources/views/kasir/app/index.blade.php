@extends('admin.layout.app')

@push('stylesheet')
<link rel="stylesheet" href="assets/modules/chocolat/dist/css/chocolat.css">
@endpush

@section('content')

<section class="section">
    <x-admin-breadcrumb title="Transaksi">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item">Transaksi</div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row">
            <div class="col-sm">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Pending</h4>
                        </div>
                        <div class="card-body">
                            10
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Selesai</h4>
                        </div>
                        <div class="card-body">
                            42
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Transaksi</h4>
                        </div>
                        <div class="card-body">
                            1,201
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Transaksi</h4>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th class="p-0 text-center">No</th>
                                    <th class="p-0 text-center">Nama</th>
                                    <th class="p-0 text-center">Tanggal</th>
                                    <th class="p-0 text-center">Nomer WA</th>
                                    <th class="p-0 text-center">Alamat</th>
                                    <th class="p-0 text-center">Action</th>
                                </tr>
                                <tr>
                                    <td class="p-0 text-center">
                                        1
                                    </td>
                                    <td>
                                        Dwi Kumara Widyatna
                                    </td>
                                    <td class="p-0 text-center">
                                        20/02/2021
                                    </td>
                                    <td class="p-0 text-center">
                                        081330179352
                                    </td>
                                    <td>
                                        Perumahan Jetis Indah Blok C Nomer 4 Lamongan
                                    </td>
                                    <td>
                                        <button href="#" class="btn btn-primary">Lihat</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0 text-center">
                                        2
                                    </td>
                                    <td>
                                        Farouq An Najaby
                                    </td>
                                    <td class="p-0 text-center">
                                        20/02/2021
                                    </td>
                                    <td class="p-0 text-center">
                                        081330179352
                                    </td>
                                    <td>
                                        Perumahan Graha Indah Lamongan
                                    </td>
                                    <td>
                                        <button href="#" class="btn btn-primary">Lihat</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0 text-center">
                                        3
                                    </td>
                                    <td>
                                        Wildan Jerry
                                    </td>
                                    <td class="p-0 text-center">
                                        20/02/2021
                                    </td>
                                    <td class="p-0 text-center">
                                        081330179352
                                    </td>
                                    <td>
                                        Perumahan Made Karyo Lamongan
                                    </td>
                                    <td>
                                        <button href="#" class="btn btn-primary">Lihat</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
