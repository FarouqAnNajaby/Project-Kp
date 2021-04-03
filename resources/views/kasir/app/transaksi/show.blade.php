@extends('admin.layout.app')

@section('content')

<!-- Main Content -->

<section class="section">
    <x-admin-breadcrumb backBtn=true title="Detail Transaksi" url="{{ route('kasir.transaksi.index') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item"><a href="{{ route('kasir.transaksi.index') }}">Transaksi</a></div>
            <div class="breadcrumb-item">Detail Transaksi</div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card card card-light">
                    <div class="row mb-3 mt-3 mr-3">
                        <div class="col-md-6 col-12 text-right ml-auto">
                            <button href="#" class="btn btn-success" data-toggle="tooltip" title="Terima"><i class="fas fa-check"></i></button>
                            <button href="#" class="btn btn-danger" data-toggle="tooltip" title="Tolak"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <h4>Detail Pembelian</h4>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-right">{{ $data->formatted_tanggal }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div>
                                            <p>Nama : {{ $data->User->nama }}</p>
                                            <p>Nomer Telp : {{ $data->User->nomor_telepon }}</p>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="p-0 text-center">No</th>
                                                        <th class="p-0 text-center">Nama Barang</th>
                                                        <th class="p-0 text-center">Jumlah</th>
                                                        <th class="p-0 text-center">Harga</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data->TransaksiBarang as $item)
                                                    <tr>
                                                        <td class="p-0 text-center">
                                                            {{ $loop->iteration }}
                                                        </td>
                                                        <td>
                                                            {{ $item->Barang->nama }}
                                                        </td>
                                                        <td class="p-0 text-center">
                                                            {{ $item->jumlah }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $item->rp_harga }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <h4>Bukti Transfer</h4>
                                <div class="gallery gallery-md">
                                    <div class="gallery-item" data-image="{{ asset('assets/admin/img/tf.jpeg') }}" data-title="Image 1"></div>
                                </div>
                            </div>
                            <div class="col-lg-4 text-right d-flex flex-column justify-content-center">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Total</div>
                                    <h4>{{ $data->rp_total }}</h4>
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

@push('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/admin/chocolat/dist/css/chocolat.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/admin/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush