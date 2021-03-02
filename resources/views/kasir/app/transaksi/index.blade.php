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
                                    <th class="p-0 text-center">Kode Transaksi</th>
                                    <th class="p-0 text-center">Nama</th>
                                    <th class="p-0 text-center">Tanggal</th>
                                    <th class="p-0 text-center">Total Pembelian</th>
                                    <th class="p-0 text-center">Action</th>
                                </tr>
                                <tr>
                                    <td class="p-0 text-center">
                                        1
                                    </td>
                                    <td class="p-0 text-center">
                                        AS001
                                    </td>
                                    <td>
                                        Dwi Kumara Widyatna
                                    </td>
                                    <td class="p-0 text-center">
                                        20/02/2021
                                    </td>
                                    <td class="p-0 text-right">
                                        Rp. 20.000
                                    </td>
                                    <td class="p-0 text-center">
                                        <a href="{{ route('kasir.transaksi.show') }}" class="btn btn-secondary" data-toggle="tooltip" title="Lihat"><i class="fas fa-eye"></i></a>
                                        <button href="#" class="btn btn-success" data-toggle="tooltip" title="Terima"><i class="fas fa-check"></i></button>
                                        <button href="#" class="btn btn-danger" data-toggle="tooltip" title="Tolak"><i class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0 text-center">
                                        2
                                    </td>
                                    <td class="p-0 text-center">
                                        AS002
                                    </td>
                                    <td>
                                        Farouq An Najaby
                                    </td>
                                    <td class="p-0 text-center">
                                        20/02/2021
                                    </td>
                                    <td class="p-0 text-right">
                                        Rp. 20.000
                                    </td>
                                    <td class="p-0 text-center">
                                        <a href="{{ route('kasir.transaksi.show') }}" class="btn btn-secondary" data-toggle="tooltip" title="Lihat"><i class="fas fa-eye"></i></a>
                                        <button href="#" class="btn btn-success" data-toggle="tooltip" title="Terima"><i class="fas fa-check"></i></button>
                                        <button href="#" class="btn btn-danger" data-toggle="tooltip" title="Tolak"><i class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0 text-center">
                                        3
                                    </td>
                                    <td class="p-0 text-center">
                                        AS003
                                    </td>
                                    <td>
                                        Wildan Jerry
                                    </td>
                                    <td class="p-0 text-center">
                                        20/02/2021
                                    </td>
                                    <td class="p-0 text-right">
                                        Rp. 20.000
                                    </td>
                                    <td class="p-0 text-center">
                                        <a href="{{ route('kasir.transaksi.show') }}" class="btn btn-secondary" data-toggle="tooltip" title="Lihat"><i class="fas fa-eye"></i></a>
                                        <button href="#" class="btn btn-success" data-toggle="tooltip" title="Terima"><i class="fas fa-check"></i></button>
                                        <button href="#" class="btn btn-danger" data-toggle="tooltip" title="Tolak"><i class="fas fa-times"></i></button>
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
