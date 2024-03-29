@extends('admin.layout.app')

@section('content')
<section class="section">
    <x-admin-breadcrumb backBtn=true title="Detail Laporan Transaksi" backUrl="{{ route('kasir.laporan.index') }}">
        <x-slot name="breadcrumbItem">
            <div class="breadcrumb-item"><a href="{{ route('kasir.laporan.index') }}">Laporan Transaksi</a></div>
            <div class="breadcrumb-item">
                <a href="{{ route('kasir.laporan.show', $data->uuid) }}">Detail Laporan Transaksi</a>
            </div>
        </x-slot>
    </x-admin-breadcrumb>
    <div class="section-body">
        <div class="row mb-3">
            <div class="col-md-6 col-12 text-right ml-auto">
                <a class="btn btn-icon btn-info icon-left" href="{{ route('kasir.laporan.print', $data->uuid) }}" target="_blank">
                    <i class="fas fa-print"></i> Print
                </a>
            </div>
        </div>
        <div class="invoice">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h4>Transaksi</h4>
                            <div class="invoice-number">#{{ $data->kode }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Jenis Transaksi:</strong><br>
                                    {{ ucfirst($data->jenis) }}
                                </address>
                                @if($data->uuid_user)
                                <address>
                                    <strong>Pemesan:</strong><br>
                                    {{ $data->User->nama }}<br>
                                    {{ $data->User->email }}<br>
                                    {{ $data->User->nomor_telepon }}
                                </address>
                                @endif
                            </div>
                            <div class="col-md-6 ml-auto text-md-right">
                                <address>
                                    <strong>Tanggal Transaksi:</strong><br>
                                    {{ $data->formatted_tanggal_ecommerce }}
                                </address>
                                <address>
                                    <strong>Status:</strong><br>
                                    {{ ucfirst($data->status) }}
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">Daftar Barang</div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->TransaksiBarang as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}.</td>
                                        <td>
                                            {{ $item->Barang->nama }}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->rp_harga }}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->jumlah }}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->total }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-4">
                            @if($data->uuid_user)
                            <div class="col-lg-8 col-md-8 col-12">
                                <div class="section-title">
                                    Bukti Transfer
                                </div>
                                <div class="chocolat-parent">
                                    <a href="{{ asset('storage/bukti-transfer/' . $data->foto_bukti) }}" class="chocolat-image" title="Transaksi #{{ $data->kode }}">
                                        <div>
                                            <img alt="image" src="{{ asset('storage/bukti-transfer/' . $data->foto_bukti) }}" class="img-thumbnail" width="200px">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endif
                            <div class="col-lg-4 col-md-4 col-12 ml-auto text-right">
                                <hr class="mb-2">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Total</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg">{{ $data->rp_total }}</div>
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
<link rel="stylesheet" href="{{ asset('assets/modules/chocolat/dist/css/chocolat.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
@endpush